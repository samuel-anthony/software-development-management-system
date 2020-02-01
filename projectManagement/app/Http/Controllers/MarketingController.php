<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\project;
use App\client;
use App\progress;
use Illuminate\Support\Facades\DB;
use Validator;
class MarketingController extends Controller
{
    private $prefix = '/marketing';
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function getRole(){
        $this->Marketing = User::find(auth()->id())['div_id'] == 4;       
        $this->allMenu = DB::table('role_menus')->join('menus','role_menus.menu_id','=','menus.menu_id')->join('users','role_menus.div_id','=','users.div_id')->where('users.id',auth()->id())->get();
    }
    public function index(){
        $this->getRole();
        $todos = project::whereIn('status_id',[1,2,10])->whereHas('progresses',function($query){$query->where('assignee_id',auth()->id());})->get();
        $progresses = project::whereIn('status_id',[3,4,11])->whereHas('progresses',function($query){$query->where('assignee_id',auth()->id());})->get();
        $dones = project::whereNotIn('status_id',[1,2,3,4,10,11])->whereHas('progresses',function($query){$query->where('assignee_id',auth()->id());})->get();
        if($this->Marketing)
            return view('marketing.index',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'todos'=>$todos,
                'progresses'=>$progresses,
                'dones'=>$dones]);
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
        $designers = User::whereDivId(5)->whereNotIn('id',$rejector)->get();
        if($this->Marketing)
            if($todo->status_id==1)
                return view('sales.todoreassign',[
                    'allMenu'=> $this->allMenu,
                    'prefix'=>$this->prefix,
                    'designers'=>$designers,
                    'todo'=>$todo]);
            else
                return view('marketing.todo',[
                    'allMenu'=> $this->allMenu,
                    'prefix'=>$this->prefix,
                    'todo'=>$todo]);
        else
            return redirect('home');
    }
    public function progress($param){
        $this->getRole();
        $progress = project::whereProjId($param)->first();
        $progress->reassign = count(progress::whereProjId($param)->whereReporterId(auth()->id())->whereAssigneeId(null)->get())==1;
        $desginers = User::whereDivId(5)->get();
        if($this->Marketing)
            return view('marketing.progress',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'progress'=>$progress,
                'desginers'=>$desginers]);
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
        if($this->Marketing)
            return view('marketing.done',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'done'=>$done,
                'index'=>$index]);
        else
            return redirect('home');
    }
    public function approve(){
        $progress = progress::whereProgressId(request('id'))->first();
        $progress->project->status_id = 3;
        $progress->project->save();
        return redirect('home');
    }
    public function disapprove(){
        $progress = progress::whereProgressId(request('id'))->first();
        $progress->project->status_id = 1;
        $progress->assignee_id = null;
        $progress->save();
        $progress->project->save();
        $newProgress = new progress;
        $newProgress->proj_id = $progress->proj_id;
        $newProgress->reporter_id = auth()->id();
        $newProgress->assignee_id = $progress->reporter_id;
        $newProgress->comment = 'sorry i reject';
        $newProgress->save();
        
        return redirect('sendReject/'.$progress->reporter_id);
    }
    public function submitProgress(){
        $validator = Validator::make(request()->input(), [
            'assignee_id'=>'required',
            'content'=>'required'
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $project = project::whereProjId(request('proj_id'))->first();
        $project->content = request('content');
        $project->status_id = 4;
        $project->save();
        $progress = new progress;
        $progress->proj_id = $project->proj_id;
        $progress->reporter_id = auth()->id();
        $progress->assignee_id = request('assignee_id');
        $progress->comment = request('comment');
        $progress->save();

        
        return redirect('sendMessage/'.request('assignee_id').'/4/'.$project->proj_id);
    }
    public function revise(){
        $progress = project::whereProjId(request('id'))->first();
        $progress->status_id = 11;
        $progress->save();
        return redirect('marketing/progress/'.request('id'));
    }
    
    public function submitRevision(){
        $validator = Validator::make(request()->input(), [
            'content'=>'required'
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $project = project::whereProjId(request('proj_id'))->first();
        $project->content = request('content');
        $project->status_id = 6;
        $project->save();
        $progress = new progress;
        $progress->proj_id = $project->proj_id;
        $progress->reporter_id = auth()->id();
        $progress->assignee_id = $project->progresses[0]->reporter_id;
        $progress->comment = request('comment');
        $progress->save();

    
        return redirect('sendMessage/'.$project->progresses[0]->reporter_id."/4/".$project->proj_id);
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
