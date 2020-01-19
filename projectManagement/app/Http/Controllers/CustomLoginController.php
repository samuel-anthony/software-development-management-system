<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\menu;
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
        if(Auth::attempt([
            'user_name'=>request('user_name'),
            'password'=>request('password')
        ])){
            return redirect('home');
        }
        else{
            //return redirect('login')->with(['alert'=>'alertError','message'=>'wrong credential please try again']);
        } 
    }
}
