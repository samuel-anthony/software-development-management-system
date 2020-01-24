@extends('layouts.customlayout')

@section('content')
<div class="container">
    @if($detail->type=="edit_user")    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Old Data</h3>
                    <h6 class="font-weight-bold">(Edit User)</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                        <label class="col-md-8 col-form-label">: {{$oldData->user_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-8 col-form-label">: {{$oldData->first_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <label class="col-md-8 col-form-label">: {{$oldData->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                        <label class="col-md-8 col-form-label">: {{$oldData->division->div_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">: {{$oldData->email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-8 col-form-label">: {{$oldData->phone}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Telegram ID</label>
                        <label class="col-md-4 col-form-label">: {{$oldData->telegram_id}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Inactive User</label>
                        <label class="col-md-4 col-form-label">: {{$oldData->isInactive == 0 ? 'false' : 'true'}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">New Data</h3>
                    <h6 class="font-weight-bold">(Edit User)</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->user_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->first_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->division}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">: {{$detail->data->email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->phone}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Telegram ID</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->telegram_id}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Inactive User</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->isInactive == 0 ? 'false' : 'true'}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif($detail->type=="add_user")
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">New Data</h3>
                    <h6 class="font-weight-bold">(Add User)</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->user_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->first_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->division}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">: {{$detail->data->email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->phone}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif($detail->type=="delete_user")
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Old data</h3>
                    <h6 class="font-weight-bold">(Delete User)</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->user_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->first_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->division}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">: {{$detail->data->email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-4 col-form-label">: {{$detail->data->phone}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md text-center">
            <button type="approve" class="btn btn-success"
                onclick="event.preventDefault();document.getElementById('user-approve').submit();">Approve</button>
            <button type="reject" class="btn btn-danger"
                onclick="event.preventDefault();document.getElementById('user-reject').submit();">Reject</button>
        </div>
    </div>
    <div class="row justify-content-center">
        <form id="user-reject" action="/hoa/user/disapprove" method="POST" style="display: none;">
            @csrf
            <input type="text" style="display:none" name="type" value="{{$detail->type}}">
            <input type="text" style="display:none" name="id" value="{{$detail->id}}">
        </form>
        <form id="user-approve" action="/hoa/user/approve" method="POST" style="display: none;">
            @csrf
            <input type="text" style="display:none" name="type" value="{{$detail->type}}">
            <input type="text" style="display:none" name="id" value="{{$detail->id}}">
        </form>
    </div>
</div>
@endsection
