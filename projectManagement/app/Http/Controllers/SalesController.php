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
        $todos = progress::where([['reporter_id',auth()->id()],['assignee_id',null]])->orWhere([['assignee_id', auth()->id()],['status_id','=','6']])->get();
        $progresses = progress::where([['reporter_id',auth()->id()],['status_id',2]])->get();
        $dones = progress::where([['reporter_id',auth()->id()],['status_id',3]])->get();
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
        $marketings = User::whereDivId(4)->get();
        $todo = progress::whereProgressId($param)->first();
        if($this->Sales){
            return view('sales.todoreassign',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'marketings'=>$marketings,
                'todo'=>$todo]);
        }
        else
            return redirect('home');
    }
    public function progress($param){
        $this->getRole();
        $progress = progress::whereProgressId($param)->first();
        if($this->Sales)
            return view('sales.progress',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'progress'=>$progress]);
        else
            return redirect('home');
    }
    public function done(){
        $this->getRole();
        if($this->Sales)
            return view('sales.done',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix]);
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
        $project->save();

        $progress = new progress;
        $progress->proj_id = $project->proj_id;
        $progress->reporter_id = auth()->id();
        $progress->assignee_id = request('user_id');
        $progress->status_id = 2;
        $progress->comment = request('comment');
        $progress->save();

        return redirect('sales')->with('alert','successfully add new project');
    }
}
