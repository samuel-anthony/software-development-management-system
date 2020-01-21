<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\division;
use App\requestAdmin;
use App\client;
use App\project;
use App\status;
use Illuminate\Support\Facades\DB;
use Validator;
use DateTime;
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
        $clients = client::all();
        $projects = project::all();
        $status = status::all();
        if($this->Hoa)
            return view('hoa.report',[
                'allMenu'=> $this->allMenu,
                'requestAdmins'=>$requestAdmins,
                'prefix'=>$this->prefix,
                'clients'=>$clients,
                'projects'=>$projects,
                'statuses'=>$status]);
        else
            return redirect('home');
    }
    public function detail($param){
        $detail = requestAdmin::find($param);
        //dd($detail);
        $detail->data = json_decode($detail->data);
        $detail->data->division = division::whereDivId($detail->data->div_id)->first()->div_name;
        if($detail->type=="edit_user")
            $oldData = User::find($detail->data->id);
        else
            $oldData = new User;
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
            $user = User::find($detail->data->id);
            $user->first_name = $detail->data->first_name;
            $user->last_name = $detail->data->last_name;
            $user->user_name = $detail->data->user_name;
            $user->email = $detail->data->email;
            $user->phone = $detail->data->phone;
            $user->div_id = $detail->data->div_id;
            $user->save();
        }
        else if(request('type')=='add_user'){
            $user = new User;
            $user->first_name = $detail->data->first_name;
            $user->last_name = $detail->data->last_name;
            $user->user_name = $detail->data->user_name;
            $user->email = $detail->data->email;
            $user->phone = $detail->data->phone;
            $user->div_id = $detail->data->div_id;
            $user->password = $detail->data->password;
            $user->save();    
        }
        requestAdmin::find(request('id'))->delete();
        return redirect('home')->with('alertSuccess','data successfully approved');
    }
    public function userDisapprove(Request $request){
        requestAdmin::find(request('id'))->delete();
        return redirect('home');
    }
    public function reportsearch(){
        $validator = Validator::make(request()->input(), [
            'due_date'=> !is_null(request('start_date')) &&  !is_null(request('due_date'))? 'date|after:start_date' : ''
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        if(!is_null(request('start_date'))){
            $date = explode('/',request('start_date'));
            $start_date = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        }
        else{
            $start_date = '1900-01-01';
        }
        if(!is_null(request('due_date'))){
            $date = explode('/',request('due_date'));
            $due_date = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        }
        else{
            $due_date = '3000-12-31';
        }
        if(is_null(request('status'))){
            $report = project::where('start_date','>=',$start_date)->where('due_date','<=',$due_date)->get();
        }
        else{
            $report = project::where('start_date','>=',$start_date)->where('due_date','<=',$due_date)->whereStatusId(request('status'))->get();
        }
        $this->getRole();
        $listClient = [];
        foreach($report as $project){
            array_push($listClient,$project->cl_id);
        }
        $clients = client::whereIn('cl_id',$listClient)->get();
        $status = status::all();
        return view('hoa.report',[
                'allMenu'=> $this->allMenu,
                'prefix'=>$this->prefix,
                'clients'=>$clients,
                'projects'=>$report,
                'statuses'=>$status,
                'strt_dt'=>request('start_date'),
                'due_dt'=>request('due_date'),
                'status_old'=>request('status')]);
    }

}
