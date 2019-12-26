<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

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
        if($this->Sales)
            return view('sales.index',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix]);
        else
            return redirect('home');
        
    }
}
