@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center"><h3 class="font-weight-bold">Detail Profile</h3></div>
                <div class="card-body">
                    <form method="GET" action="/user/edit user/{{$user->id}}" id="edit-user">
                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <div class="form-group">
                                    <label>User ID</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Company" value="{{$user->id}}">
                                </div>
                            </div>
                            <div class="col-md-5 px-1">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Username" value="{{$user->user_name}}">
                                </div>
                            </div>
                            <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Telegram ID</label>
                                        <input class="form-control  @error('telegram_id') is-invalid @enderror" value="{{$user->telegram_id ?? 'Not Set'}}" disabled>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Company" value="{{$user->first_name}}">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Last Name" value="{{$user->last_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" disabled="" placeholder="E-mail Address" value="{{$user->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Phone" value="{{$user->phone}}">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Role" value="{{$user->division['div_name']}}">
                                </div>
                            </div>
                        </div>
                    </form>

                            
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="submit" class="btn btn-primary align-item-center" onclick="event.preventDefault();document.getElementById('edit-user').submit();">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@endsection
