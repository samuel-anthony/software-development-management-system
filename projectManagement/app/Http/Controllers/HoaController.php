<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\division;
use App\requestAdmin;
use Illuminate\Support\Facades\DB;
class HoaController extends Controller
{
    //
    private $prefix = 'hoa';
    private $parentId = 2;
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function getRole(){
        $this->Hoa = User::find(auth()->id())['div_id'] == 2;       
        $this->allMenu = DB::table('role_menus')->join('menus','role_menus.menu_id','=','menus.menu_id')->join('users','role_menus.div_id','=','users.div_id')->where('users.id',auth()->id())->get();
    }
    public function index(){
        $this->getRole();
        $requestAdmins = requestAdmin::all();
        for($c = 0; $c < count($requestAdmins); $c++){
            $requestAdmins[$c]->data = json_decode($requestAdmins[$c]->data);
        }
        if($this->Hoa)
            return view('hoa.index',[
                'allMenu'=> $this->allMenu,
                'requestAdmins'=>$requestAdmins,
                'prefix'=>$this->prefix]);
        else
            return redirect('home');
        
    }
    public function detail($param){
        $detail = requestAdmin::find($param);
        $detail->data = json_decode($detail->data);
        $detail->data->division = division::whereDivId($detail->data->div_id)->first()->div_name;
        $oldData = User::find($detail->data->id);
        $this->getRole();
        return view('hoa.detail',[
            'allMenu'=> $this->allMenu,
            'detail'=>$detail,
            'oldData'=>$oldData,
            'prefix'=>$this->prefix]);
    }
}