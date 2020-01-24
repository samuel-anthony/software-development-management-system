@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center"><h3 class="font-weight-bold">Edit Profile</h3></div>
                <div class="card-body">
                        @if(!($ownProfile))
                        <form method="POST" action="/user/edit user">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <input class="form-control" disabled value="{{$user->id}}">
                                        <input name="user_id" value="{{$user->id}}" style="display:none">
                                    </div>
                                </div>
                                <div class="col-md-5 px-1">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input name="user_name" type="text"
                                            class="form-control @error('user_name') is-invalid @enderror"
                                            name="user_name" required autocomplete="user_name" autofocus
                                            value="{{$user->user_name}}">
                                        @error('user_name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Telegram ID</label>
                                        <input class="form-control  @error('telegram_id') is-invalid @enderror" value="{{$user->telegram_id}}" placeholder="ex:12345678" name="telegram_id">
                                        @error('telegram_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" type="text" class="form-control" value="{{$user->first_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control" value="{{$user->last_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="text" class="form-control" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text" class="form-control" value="{{$user->phone}}">
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control custom-select" id="role" name="role">
                                            @for($counter = 0;$counter < count($allRole); $counter++)
                                              @if($user->div_id == $counter+1)
                                                <option value="{{$allRole[$counter]['div_id']}}" selected>{{$allRole[$counter]['div_name']}}</option>
                                              @else
                                                <option value="{{$allRole[$counter]['div_id']}}">{{$allRole[$counter]['div_name']}}</option>
                                              @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Inactive User</label>
                                        @if($user->isInactive == 0)
                                        <input type="checkbox" name="isInactive">
                                        @else
                                        <input type="checkbox" name="isInactive" checked>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6 text-center">
                                  <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <form method="POST" action="/user/edit own">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <input class="form-control" disabled value="{{$user->id}}">
                                        <input name="user_id" value="{{$user->id}}" style="display:none">
                                    </div>
                                </div>
                                <div class="col-md-5 px-1">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input name="user_name" type="text"
                                            class="form-control @error('user_name') is-invalid @enderror"
                                            name="user_name" required autocomplete="user_name" autofocus
                                            value="{{$user->user_name}}" disabled>
                                        @error('user_name')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Telegram ID</label>
                                        <input class="form-control  @error('telegram_id') is-invalid @enderror" value="{{$user->telegram_id}}" placeholder="ex:12345678" name="telegram_id">
                                        @error('telegram_id')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" type="text" class="form-control" value="{{$user->first_name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control" value="{{$user->last_name}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" type="text" class="form-control" value="{{$user->email}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text" class="form-control" value="{{$user->phone}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control custom-select" id="role" name="role" disabled>
                                            @for($counter = 0;$counter < count($allRole); $counter++)
                                              @if($user->div_id == $counter+1)
                                                <option value="{{$allRole[$counter]['div_id']}}" selected>{{$allRole[$counter]['div_name']}}</option>
                                              @else
                                                <option value="{{$allRole[$counter]['div_id']}}">{{$allRole[$counter]['div_name']}}</option>
                                              @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 px-1">
                                <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control  @error('password') is-invalid @enderror" placeholder="minimum 8 character" name="password">
                                        @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 px-1">
                                <div class="form-group">
                                        <label>Password Confirmation</label>
                                        <input class="form-control  @error('password_confirmation') is-invalid @enderror" placeholder="has to be the same with password" name="password_confirmation">
                                        @error('password_confirmation')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6 text-center">
                                  <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                        @endif  
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
