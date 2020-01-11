<?php

namespace App\Http\Controllers;

use Validator;
use App\menu;
use App\division;
use App\User;
use App\requestAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{   
    private $parentId = 1;
    private $prefix = '/user';
    private $menuName = 'user';
    private $allMenu;
    private $isAdmin;
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    public function getRole(){
        $this->isAdmin = User::find(auth()->id())['div_id'] == 1;
        if($this->isAdmin)
            $this->allMenu = menu::parentMenuId($this->parentId)->get();
        else
            $this->allMenu = DB::table('role_menus')->join('menus','role_menus.menu_id','=','menus.menu_id')->join('users','role_menus.div_id','=','users.div_id')->where('users.id',auth()->id())->get();
    }
    public function index(){
        $this->getRole();
        if($this->isAdmin){
            $users = User::paginate(1);
            return view('/user/index',[
                'users'=>$users,
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
        $this->getRole();
        $allRole = division::all();
        return view('/user/register',[
            'allRole' => $allRole,
            'allMenu'=> $this->allMenu,
            'prefix'=>$this->prefix,
            'menuName'=>$this->menuName
         ]);
    }


    public function detail($param1){
        $this->getRole();
        if($this->isAdmin || $param1 == auth()->id()){
            if($param1 != auth()->id() && !$this->isAdmin)
                return redirect()->action('HomeController@index');
            else
                $user = User::find($param1);
            return view('/user/detail',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'menuName'=>$this->menuName,
                'user' => $user
            ]);
        }
        else{
            return redirect()->action('HomeController@index');
        }
    }

    public function viewedit($param1){
        $this->getRole();
        if($this->isAdmin || $param1 == auth()->id()){
            $allRole = division::all();
            if($param1 != auth()->id() && !$this->isAdmin)
                return redirect()->action('HomeController@index');
            else
                $user = User::find($param1);
            return view('/user/edit',[
                'allRole' => $allRole,
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'menuName'=>$this->menuName,
                'user' => $user
            ]);
        }else{
            return redirect()->action('HomeController@index');
        }
    }

    public function editUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|unique:users,id,'.$request->input('user_id').'|min:8|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,id,'.$request->input('user_id')
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }

        $user = User::find($request->get('user_id'));
        $user->user_name = $request->get('user_name');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->div_id = $request->get('role');
        
        $requestAdmin = new requestAdmin;
        $requestAdmin->data = json_encode($user->getAttributes());
        $requestAdmin->type = 'edit_user';
        $requestAdmin->save();
        return redirect('/user');
    }

    public function addUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|unique:users|min:8|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }

        $user = new User;
        $user->user_name = $request->get('user_name');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->div_id = $request->get('role');
        $user->password = bcrypt($request->get('role'));
        $requestAdmin = new requestAdmin;
        $requestAdmin->data = json_encode($user->getAttributes());
        $requestAdmin->type = 'add_user';
        $requestAdmin->save();
        return redirect('/user');
    }
}
