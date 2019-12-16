<?php

namespace App\Http\Controllers;

use Validator;
use App\menu;
use App\division;
use App\role_menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{   
    private $parentId = 4;
    private $prefix = '/division';
    private $menuName = 'division';
    private $allMenu;
    private $isAdmin;
    public function __construct()
    {
        
        $this->middleware('auth');
        $this->isAdmin = User::find(1)['div_id'] == 1;
        if($this->isAdmin)
            $this->allMenu = menu::parentMenuId($this->parentId)->get();
        else
            $this->allMenu = DB::table('role_menus')->join('menus','role_menus.menu_id','=','menus.menu_id')->join('users','role_menus.div_id','=','users.div_id')->where('users.id',auth()->id())->get();
        //asume nilai 1 adalah useradmin
    }

    public function index(){
        if($this->isAdmin){
            $division = division::paginate(5);
            return view('/division/index',[
                'divisions'=>$division,
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'menuName'=>$this->menuName
            ]);
        }
        else{
            return redirect()->action('HomeController@index');
        }
    }
    public function registerNew(){
        return view('/division/register',[
            'allMenu'=> $this->allMenu,
            'prefix'=>$this->prefix,
            'menuName'=>$this->menuName
         ]);
    }
    public function detail($param1){
        if($this->isAdmin){
            $division = division::find($param1);
            $menugrantedId = role_menu::divId($param1)->get('menu_id');
            $grantedMenus = menu::find($menugrantedId);
            return view('/division/detail',[
                'allMenu'=> $this->allMenu,
                'grantedMenus'=> $grantedMenus,
                'prefix'=>$this->prefix,
                'menuName'=>$this->menuName,
                'division' => $division
            ]);
        }
        else{
            return redirect()->action('HomeController@index');
        }
    }
    public function viewEdit($param1){
        if($this->isAdmin){
            $division = division::find($param1);
            $availableMenus = menu::parentMenuId(NULL)->get();
            $menugrantedId = role_menu::divId($param1)->get('menu_id');
            $grantedMenus = menu::find($menugrantedId);
            return view('/division/edit',[
                'allMenu'=> $this->allMenu,
                'availableMenus'=> $availableMenus,
                'grantedMenus'=> $grantedMenus,
                'prefix'=>$this->prefix,
                'menuName'=>$this->menuName,
                'division' => $division
            ]);
        }
        else{
            return redirect()->action('HomeController@index');
        }
    }
    public function editDivision(Request $request){
        dd($request->input());
    }
}
