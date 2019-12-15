@extends('layouts.customlayout')

@section('content')
<div class="container">
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Detail Profile</h5>
              </div>
              <div class="card-body">
                <form method="GET" action="/user/edit user/{{$user->id}}">
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
                        <input type="text" class="form-control" disabled="" placeholder="Role" value="{{$user->divisions[0]['div_name']}}">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      
</div>
@endsection
