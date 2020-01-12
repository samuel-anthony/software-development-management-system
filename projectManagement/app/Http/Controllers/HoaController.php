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
    private $prefix = '/hoa';
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
        $divisions = division::all();
        for($c = 0; $c < count($requestAdmins); $c++){
            $requestAdmins[$c]->data = json_decode($requestAdmins[$c]->data);
            $requestAdmins[$c]->data->div_name = $divisions[$requestAdmins[$c]->data->div_id-1]->div_name;
        }
        if($this->Hoa)
            return view('hoa.index',[
                'allMenu'=> $this->allMenu,
                'requestAdmins'=>$requestAdmins,
                'prefix'=>$this->prefix]);
        else
            return redirect('home');
        
    }
    public function report(){
        $this->getRole();
        $requestAdmins = requestAdmin::all();
        for($c = 0; $c < count($requestAdmins); $c++){
            $requestAdmins[$c]->data = json_decode($requestAdmins[$c]->data);
        }
        if($this->Hoa)
            return view('hoa.report',[
                'allMenu'=> $this->allMenu,
                'requestAdmins'=>$requestAdmins,
                'prefix'=>$this->prefix]);
        else
            return redirect('home');
    }
    public function detail($param){
        $detail = requestAdmin::find($param);
        //dd($detail);
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
    public function userApprove(Request $request){
        $detail = requestAdmin::find(request('id'));
        $detail->data = json_decode($detail->data);
        if(request('type')=='edit_user'){
            
        }
        else if(request('type')=='add_user'){

        }
        requestAdmin::find(request('id'))->delete();
        return redirect('home')->with('alertSuccess','data successfully approved');
    }
    public function userDisapprove(Request $request){
        requestAdmin::find(request('id'))->delete();
        return redirect('home');
    }
}
