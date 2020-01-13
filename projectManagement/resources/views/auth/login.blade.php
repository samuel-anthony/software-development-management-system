@extends('layouts.customlayout')

@section('content')
    <div class="container">
       <img src="https://pngimage.net/wp-content/uploads/2018/06/tribunnews-logo-png-1.png" alt="Logo Tribunnews"> <br><br>
        <h1>Task Management System</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><i class="now-ui-icons users_single-02"></i>&nbsp;&nbsp;{{ __('Login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/customLogin">
                            @csrf
                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right isRequired">Username</label>
                                <div class="col-md-6">
                                    <input id="user_name" type="user_name" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                                    @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right isRequired">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
