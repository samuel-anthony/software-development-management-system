<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\menu;
use App\User;

class CustomLoginController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function loginview(){
        return view('auth.login');
    }
    public function login(){
        $user = User::where('user_name',request('user_name'))->get();
        if(count($user)>0){
            if(Auth::attempt([
                'user_name'=>request('user_name'),
                'password'=>request('password')
            ])){
                if($user[0]->isInactive == 0)
                    return redirect('home');
                else
                    return view('auth.loginerror',[
                        'user_name' => request('user_name'),
                        'error_message' => 'User is Inactive'
                    ]);
            }
            else{
                return view('auth.loginerror',[
                    'user_name' => request('user_name'),
                    'error_message' => 'The Credential Doesn\'t Match'
                ]);
            }
        }
        else{
            return view('auth.loginerror',[
                'user_name' => request('user_name'),
                'error_message' => 'User Not Found'
            ]);
        }
    }
}
