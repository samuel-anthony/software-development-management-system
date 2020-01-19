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
    public function sendTelegramMessage($userID,$senderDivision){
        $user = User::find($userID);
        if(!is_null($user->telegram_id)){
            $token = "934290314:AAEzTr2xI7hIsYiw62gLjpY1rYaOtTniLGQ";
            if($user->div_id != 3)
                $message = "You have a new task, please check your Task Management to do it.";
            else
                $message = "Your project already done by the assignee, kindly please check your Task Management to review.";
            $requestParam = [
                'chat_id' => $user->telegram_id,
                'text' => $message
            ];
            $requestUrl = "https://api.telegram.org/bot".$token."/sendMessage?".http_build_query($requestParam);
            file_get_contents($requestUrl);
        }
        if($senderDivision == 3)
            return redirect('home')->with(['alert'=>'alertSuccess','message'=>'successfully assign task to assignee']);
        else{
            if($user->div_id == 3)
            return redirect('home')->with(['alert'=>'alertSuccess','message'=>'successfully done task please wait sales to review it']);
            else
            return redirect('home')->with(['alert'=>'alertSuccess','message'=>'successfully assign task to assignee']);
        }  
    }
    
    public function sendTelegramMessageReject($userID){
        $user = User::find($userID);
        if(!is_null($user->telegram_id)){
            $token = "934290314:AAEzTr2xI7hIsYiw62gLjpY1rYaOtTniLGQ";
            $message = 'Your task is being rejected. Please check your "To Do" to assign new user';
            $requestParam = [
                'chat_id' => $user->telegram_id,
                'text' => $message
            ];
            $requestUrl = "https://api.telegram.org/bot".$token."/sendMessage?".http_build_query($requestParam);
            file_get_contents($requestUrl);
        }
        return redirect('home')->with(['alert'=>'alertError','message'=>'successfully reject task']);  
    }
    
    public function index(){
        $this->getRole();
        if($this->isAdmin){
            $users = User::paginate(10);
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
        $allRole = division::whereNotIn('div_id',[1,2])->get();
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
            $ownProfile = $param1 == auth()->id();
            if($param1 != auth()->id() && !$this->isAdmin)
                return redirect()->action('HomeController@index');
            else
                $user = User::find($param1);
            return view('/user/edit',[
                'allRole' => $allRole,
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'menuName'=>$this->menuName,
                'user' => $user,
                'ownProfile' => $ownProfile
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
            'email' => 'required|email|unique:users,id,'.$request->input('user_id'),
            'telegram_id' => request('telegram_id') != null ? 'regex:/^[0-9]*$/' : '',
            'phone' => request('phone') != null ? 'regex:/(0)[0-9]*$/' : ''
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
        return redirect('/user')->with('alertSuccess','successfully requested to edit user');
    }

    public function editOwn(){
        $validator = Validator::make(request()->input(), [
            'password' => request('password') != null ? 'required|min:8' : '',
            'password_confirmation' => (request('password') != null)||(request('password_confirmation') != null) ? 'required_with:password|same:password' : '',
            'telegram_id' => request('telegram_id') != null ? 'regex:/^[0-9]*$/' : '',
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        
        $user = user::find(request('user_id'));
        if(!is_null(request('password')))
        $user->password = bcrypt($request->get('password'));
        if(!is_null(request('telegram_id')))
        $user->telegram_id = request('telegram_id');
        $user->save();
        return redirect('/home')->with(['alert'=>'alertSuccess','message'=>'successfully edit own account']);
    }
    
    public function addUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|unique:users|min:8|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password',
            'telegram_id' => request('telegram_id') != null ? 'regex:/^[0-9]*$/' : '',
            'phone' => request('phone') != null ? 'regex:/(0)[0-9]*$/' : ''
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
        $user->password = bcrypt($request->get('password'));
        $user->telegram_id = request('telegram_id');
        $requestAdmin = new requestAdmin;
        $requestAdmin->data = json_encode($user->getAttributes());
        $requestAdmin->type = 'add_user';
        $requestAdmin->save();
        return redirect('/user')->with('alertSuccess','successfully requested to add new user');
    }

    public function delete(Request $request){
        //dd(request()->input());
        $user = User::find(request('user_id'));
        $requestAdmin = new requestAdmin;
        $requestAdmin->data = json_encode($user->getAttributes());
        $requestAdmin->type = 'delete_user';
        $requestAdmin->save();
        return redirect('/user')->with('alertSuccess','successfully requested to delete user');
    }
}
