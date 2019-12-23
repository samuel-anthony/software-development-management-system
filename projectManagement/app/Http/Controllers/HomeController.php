<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\menu;
use App\role_menu;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $role;//role teh division
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    private function getRole(){
        $this->role = User::find(auth()->id())->division->div_name;
    }
    public function index()
    {
        $this->getRole();
        return redirect($this->role);
    }
    
}
