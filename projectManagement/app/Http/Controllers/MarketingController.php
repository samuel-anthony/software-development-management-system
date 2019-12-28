<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\project;
use App\client;
use App\progress;
use Illuminate\Support\Facades\DB;
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
        $todos = progress::where([['assignee_id',auth()->id()],['status_id',2]])->orWhere([['assignee_id', auth()->id()],['status_id','6']])->get();
        $progresses = progress::where([['reporter_id',auth()->id()],['status_id',2]])->get();
        $dones = progress::where([['reporter_id',auth()->id()],['status_id',3]])->get();
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
        $todo = progress::whereProgressId($param)->first();
        if($this->Marketing)
            return view('marketing.todo',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'todo'=>$todo]);
        else
            return redirect('home');
    }
    public function progress(){
        $this->getRole();
        if($this->Marketing)
            return view('marketing.progress',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix]);
        else
            return redirect('home');
    }
}
