<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\menu;
class test extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /*public function getMenu()
    {
        $allMenu = menu::all();
            return view('/layouts/customlayout',[
        'allMenu' => $allMenu,
      ]);
    }*/
    public function getMenu($param1,$param2)
    {
        $allMenu = menu::parentMenuId($param1)->get();
              
        return view('/layouts/customlayout',[
            'allMenu' => $allMenu,
      ]);
    }
}
