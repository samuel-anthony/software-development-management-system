@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-4">
                <div class="card-header text-center"><h3 class="font-weight-bold">Dashboard</h3></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>You are logged in!<p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
