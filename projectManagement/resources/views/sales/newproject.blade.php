@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Create New Project</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{$prefix}}/submitNewProject">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Start Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker3" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{old('start_date')}}">
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>End Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker4" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{old('due_date')}}">
                                @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Client</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control @error('cl_name') is-invalid @enderror" name="cl_name" value="{{old('cl_name')}}">  
                                @error('cl_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>E-mail</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="" class="form-control @error('cl_email') is-invalid @enderror" name="cl_email" value="{{old('cl_email')}}">
                                @error('cl_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Assignee</label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control custom-select @error('user_id') is-invalid @enderror" name="user_id">
                                    <option value="">Choose</option>
                                    @foreach($marketings as $marketing)
                                        <option value="{{$marketing->id}}">{{$marketing->first_name}} {{$marketing->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Requirement</label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="col-md-5 form-control @error('requirement') is-invalid @enderror" rows="4" cols="50" name="requirement" style="border: solid 1px #ccc; border-radius: 20px;">{{old('requirement')}}</textarea>
                                @error('requirement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Comment</label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="col-md-5 form-control" rows="4" cols="50" name="comment" style="border: solid 1px #ccc; border-radius: 20px;max-height:120px;">{{old('comment')}}</textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
