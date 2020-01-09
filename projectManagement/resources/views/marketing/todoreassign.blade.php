@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">{{$todo->client->cl_name}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">Start</label>
                        <label class="col-md-8 col-form-label">: {{$todo->start_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">End</label>
                        <label class="col-md-8 col-form-label">: {{$todo->due_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <label class="col-md-8 col-form-label">: {{$todo->client->cl_email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label><textarea disabled class="col-md-4 form-control" style="border: solid 1px #ccc; border-radius: 20px;">{{$todo->requirement}}</textarea>
                    </div>
                    <form method="POST" action="{{$prefix}}/reassign" id="reassign">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Assignee</label>
                            <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label>
                            <select class="col-md-3 form-control custom-select @error('user_id') is-invalid @enderror" name="user_id">
                                <option value="">Choose</option>
                                @foreach($desginers as $designer)
                                    <option value="{{$designer->id}}">{{$designer->first_name}} {{$designer->last_name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="text" name="proj_id" value="{{$todo->proj_id}}" style="display:none">
                    </form>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="submit" class="btn btn-success" onclick="event.preventDefault();document.getElementById('reassign').submit();">Re-Assign</button>
                            <button type="submit" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('back').submit();">Close</button>
                            <form action="{{$prefix}}" id="back" style="display:none"></form>
                        </div>
                    </div>
                    <div class="table-responsive mt-5">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No.</th>
                                <th>User</th>
                                <th>Comment</th>
                            </thead>
                            <tbody>
                                @if(count($todo->progresses)>0)
                                    @php($num = 1)
                                    @foreach($todo->progresses as $progress)
                                        <tr>
                                            <td>{{$num}}.</td>
                                            <td>{{$progress->reporter->first_name}} {{$progress->reporter->last_name}}@if($progress->reporter->id == Auth::user()->id) (Me)@endif</td>
                                            <td>{{$progress->comment}}</td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">Records Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
