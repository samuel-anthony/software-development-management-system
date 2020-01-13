<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\project;
use App\client;
use App\progress;
use Illuminate\Support\Facades\DB;
use DateTime;
use Validator;

class SalesController extends Controller
{
    private $prefix = '/sales';
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function getRole(){
        $this->Sales = User::find(auth()->id())['div_id'] == 3;       
        $this->allMenu = DB::table('role_menus')->join('menus','role_menus.menu_id','=','menus.menu_id')->join('users','role_menus.div_id','=','users.div_id')->where('users.id',auth()->id())->get();
    }
    public function index(){
        $this->getRole();
        //project::whereHas('progresses',function($query){$query->where('assignee_id',auth());})
        $todos = project::whereIn('status_id',[1,6])->whereHas('progresses',function($query){$query->where('reporter_id',auth()->id());})->get();
        $progresses = project::whereIn('status_id',[2,7])->whereHas('progresses',function($query){$query->where('reporter_id',auth()->id());})->get();
        $dones = project::whereNotIn('status_id',[1,2,6,7])->whereHas('progresses',function($query){$query->where('reporter_id',auth()->id());})->get();
        if($this->Sales)
            return view('sales.index',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'todos'=>$todos,
                'progresses'=>$progresses,
                'dones'=>$dones]);
        else
            return redirect('home');
        
    }
    public function createNewProject(){
        $this->getRole();
        $marketings = User::whereDivId(4)->get();
        $clients = client::all();
        if($this->Sales)
            return view('sales.newproject',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'marketings'=>$marketings,
                'clients'=>$clients]);
        else
            return redirect('home');
    }
    public function todo($param){
        $this->getRole();
        $todo = project::whereProjId($param)->first();
        $rejector = [];
        foreach($todo->progresses as $progress){
            if($progress->reporter_id != auth()->id())
                array_push($rejector,$progress->reporter_id);
        }
        $index = 0;
        foreach($todo->progresses as $progress){
            if($progress->reporter == $todo->progresses[0]->assignee)
                break;
            $index++;
        }
        $marketings = User::whereDivId(4)->whereNotIn('id',$rejector)->get();
        if($this->Sales){
            if($todo->status_id==1)
                return view('sales.todoreassign',[
                    'allMenu'=> $this->allMenu,
                    'prefix'=>$this->prefix,
                    'marketings'=>$marketings,
                    'todo'=>$todo]);
            else
                return view('sales.todo',[
                    'allMenu'=> $this->allMenu,
                    'prefix'=>$this->prefix,
                    'todo'=>$todo,
                    'index'=>$index]);
        }
        else
            return redirect('home');
    }
    public function progress($param){
        $this->getRole();
        $progress = project::whereProjId($param)->first();
        $index = 0;
        $assignee = [$progress->progresses[0]->assignee];
        foreach($progress->progresses as $task){
            if($task->reporter == $progress->progresses[0]->assignee){
                array_push($assignee,$task->assignee);
                break;
            }
            $index++;
        }
        $progress->assignee = $assignee;
        if($this->Sales){
            return view('sales.progress',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'progress'=>$progress,
                'index'=>$index]);
            }
        else
            return redirect('home');
    }
    public function done($param){
        $this->getRole();
        $done = project::whereProjId($param)->first();
        $index = 0;
        foreach($done->progresses as $progress){
            if($progress->reporter == $done->progresses[0]->assignee)
                break;
            $index++;
        }
        if($this->Sales)
            return view('sales.done',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'done'=>$done,
                'index'=>$index]);
        else
            return redirect('home');
    }
    public function saveNewProject(Request $request){
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'due_date' => 'required|date|after:start_date',
            'cl_name' => 'required|max:255',
            'cl_email' => 'required|email',
            'user_id' => 'required',
            'requirement' => 'required'
        ],[
            'user_id.required' => 'assignee field is required',
            'cl_name.required' => 'client name field is required',
            'cl_email.required' => 'client email field is required',
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $client = client::whereClEmail(request('cl_email'))->first();
        if(is_null($client)){
            $client = new client;
            $client->cl_name = request('cl_name');
            $client->cl_email = request('cl_email');
            $client->save();
        }
        $project = new project;
        $date = explode('/',request('start_date'));
        $project->start_date = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('due_date'));
        $project->due_date = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $project->requirement = request('requirement');
        $project->cl_id = $client->cl_id;
        $project->status_id = 2;
        $project->save();

        $progress = new progress;
        $progress->proj_id = $project->proj_id;
        $progress->reporter_id = auth()->id();
        $progress->assignee_id = request('user_id');
        $progress->comment = request('comment');
        $progress->save();

        return redirect('sales')->with('alert','successfully add new project');
    }
    public function reassign(){
        $validator = Validator::make(request()->input(), [
            'user_id'=>'required',
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $progress = progress::whereProjId(request('proj_id'))->first();
        $progress->assignee_id = request('user_id');
        $progress->save();
        $project = project::whereProjId(request('proj_id'))->first();
        $project->status_id = 2;
        $project->save();
        return redirect('home')->with(['alert'=>'alertSuccess','message'=>'successfully reassign marketing']);
    }
    public function review(){
        $progress = project::whereProjId(request('proj_id'))->first();
        $progress->status_id = 7;
        $progress->save();
        return redirect('sales/progress/'.request('proj_id'));
    }
    public function revision(){
        $validator = Validator::make(request()->input(), [
            'assignee_id'=>'required',
        ],[
            'assignee_id.required' => 'please choose who to you want ask to revise'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $project = project::whereProjId(request('proj_id'))->first();
        $assignee = User::find(request('assignee_id'));
        if($assignee->div_id == 4){
            $project->status_id = 10;
        }
        else if($assignee->div_id == 5){
            $project->status_id = 8;
        }
        $project->save();
        $progress = new progress;
        $progress->proj_id = $project->proj_id;
        $progress->reporter_id = auth()->id();
        $progress->assignee_id = request('assignee_id');
        $progress->comment = request('comment');
        $progress->save();
        return $this->progress(request('proj_id'));
    }
    public function finishProject(){
        $progress = project::whereProjId(request('proj_id'))->first();
        $progress->status_id = 12;
        $progress->save();
        return redirect('home');    
    }
    public function download(){
        $item = project::whereProjId(request('id'))->first(); 
        $item->media = base64_decode($item->media);
        return response($item->media)
                        ->header('Cache-Control', 'no-cache private')
                        ->header('Content-Description', 'File Transfer')
                        ->header('Content-Type', $item->media_type)
                        ->header('Content-Disposition', 'attachment; filename=download.jpg' )
                        ->header('Content-Transfer-Encoding', 'binary');
    }
}
