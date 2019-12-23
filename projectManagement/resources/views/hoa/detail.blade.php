@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">Old data</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                        <label class="col-md-8 col-form-label">{{$oldData->user_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-8 col-form-label">{{$oldData->first_name}}</label>
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
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">{{$oldData->email}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-8 col-form-label">{{$oldData->phone}}</label>
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
                    </div>
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->first_name}}</label>
                    </div>
                    
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->last_name}}</label>
                       
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->division}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <label class="col-md-8 col-form-label">{{$detail->data->email}}</label>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone No</label>
                        <label class="col-md-4 col-form-label">{{$detail->data->phone}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
        Action :
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <button type="approve" class="btn btn-primary" style="background:green">Approve</button>   
        </div>
        <div class="col-md-2">
            <button type="reject" class="btn btn-primary"   style="background:red">Reject</button>
                        
        </div>
    </div>
</div>
@endsection
