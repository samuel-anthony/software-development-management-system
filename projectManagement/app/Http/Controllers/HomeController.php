<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\menu;
use App\role_menu;
use App\User;

use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$allMenu = menu::where('parent_menu_id','=',$param1)->get();
        $allMenu = DB::table('role_menus')->join('menus','role_menus.menu_id','=','menus.menu_id')->join('users','role_menus.div_id','=','users.div_id')->where('users.id',auth()->id())->get();
        return view('/home',[
            'allMenu' => $allMenu,
      ]);
    }
    
}
