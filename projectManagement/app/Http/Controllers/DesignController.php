<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\project;
use App\client;
use App\progress;
use Validator;
use Illuminate\Support\Facades\DB;

class DesignController extends Controller
{
    private $prefix = '/design';
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function getRole(){
        $this->Design = User::find(auth()->id())['div_id'] == 5;       
        $this->allMenu = DB::table('role_menus')->join('menus','role_menus.menu_id','=','menus.menu_id')->join('users','role_menus.div_id','=','users.div_id')->where('users.id',auth()->id())->get();
    }
    public function index(){
        $this->getRole();
        $todos = project::whereIn('status_id',[4,8])->whereHas('progresses',function($query){$query->where('assignee_id',auth()->id());})->get();
        $progresses = project::whereIn('status_id',[5,9])->whereHas('progresses',function($query){$query->where('assignee_id',auth()->id());})->get();
        $dones = project::whereNotIn('status_id',[4,5,8,9])->whereHas('progresses',function($query){$query->where('assignee_id',auth()->id());})->get();
        if($this->Design)
            return view('design.index',[
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
        $index = 0;
        foreach($todo->progresses as $task){
            if($task->assignee_id == auth()->id()){
                break;
            }
            $index++;
        }
        if($this->Design)
            return view('design.todo',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'todo'=>$todo,
                'index'=>$index]);
        else
            return redirect('home');
        
    }
    public function progress($param){
        $this->getRole();
        $progress = project::whereProjId($param)->first();
        $index = 0;
        foreach($progress->progresses as $task){
            if($task->assignee_id == auth()->id()){
                break;
            }
            $index++;
        }
        if($this->Design)
            return view('design.progress',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'progress'=>$progress,
                'index'=>$index]);
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
        if($this->Design)
            return view('design.done',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'done'=>$done,
                'index'=>$index]);
        else
            return redirect('home');
    }
    public function approve(){
        $progress = progress::whereProgressId(request('id'))->first();
        $progress->project->status_id = 5;
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
        $validator = Validator::make(request()->file(), [
			'file' => 'required|file|mimes:jpg,jpeg,png|max:1024'
        ],[
            'file.mimes' => 'the upload must be in format of jpg, jpeg, png'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $project = project::whereProjId(request('project_id'))->first();
        $path = request()->file('file')->getRealPath();
        $image = file_get_contents($path);
        $base64 = base64_encode($image);
        $project->media = $base64;
        $project->media_type = $_FILES['file']['type'];
        $project->status_id = 6;
        $project->save();

        $progress = new progress;
        $progress->proj_id = $project->proj_id;
        $progress->reporter_id = auth()->id();
        $progress->assignee_id = $project->progresses[0]->reporter_id;
        $progress->comment = request('comment');
        $progress->save();
        return redirect('sendMessage/'.$project->progresses[0]->reporter_id."/5");
    }

    
    public function revise(){
        $progress = project::whereProjId(request('id'))->first();
        $progress->status_id = 9;
        $progress->save();
        return redirect('design/progress/'.request('id'));
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
