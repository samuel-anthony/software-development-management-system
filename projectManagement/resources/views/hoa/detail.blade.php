@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Old Data</h3>
                    <h3 class="font-weight-bold">Detail User</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                        <label class="col-md-8 col-form-label">{{$oldData->user_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-8 col-form-label">{{$oldData->first_name}}</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <label class="col-md-8 col-form-label">{{$oldData->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                        <label class="col-md-8 col-form-label">{{$oldData->division->div_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">{{$oldData->email}}</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-8 col-form-label">{{$oldData->phone}}</label>
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">Username</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <div class="card-header">New Data</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->user_name}}</label>
                        <label for="role" class="col-md-4 col-form-label text-md-right">Password</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->first_name}}</label>
                        <label for="role" class="col-md-4 col-form-label text-md-right">Division</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->last_name}}</label>
                        <label for="role" class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->division}}</label>
                        <label for="role" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">{{$detail->data->email}}</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->phone}}</label>
                    </div>
                </div>
            </div>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="approve" class="btn btn-success" onclick="event.preventDefault();document.getElementById('user-approve').submit();">Approve</button>
                            <button type="reject" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('user-reject').submit();">Reject</button>
                        </div>
    <div class="row">
        <div class="col-md-2">
            Action :
                    </div>
                </div>
    <div class="row">
        <div class="col-md-1">
            <button type="approve" class="btn btn-primary" style="background:green"
                onclick="event.preventDefault();document.getElementById('user-approve').submit();">Approve</button>
            </div>
        <div class="col-md-2">
            <button type="reject" class="btn btn-primary" style="background:red"
                onclick="event.preventDefault();document.getElementById('user-reject').submit();">Reject</button>
        </div>
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
    @endsection