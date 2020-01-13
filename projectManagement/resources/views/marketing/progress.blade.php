@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">{{$progress->client->cl_name}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">Start</label>
                        <label class="col-md-8 col-form-label">: {{$progress->start_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">End</label>
                        <label class="col-md-8 col-form-label">: {{$progress->due_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <label class="col-md-8 col-form-label">: {{$progress->client->cl_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label class="col-md-8 col-form-label">: {{$progress->requirement}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Reporter</label>
                        <label class="col-md-8 col-form-label">: {{$progress->progresses[0]->reporter->first_name}} {{$progress->progresses[0]->reporter->last_name}}@if($progress->progresses[0]->reporter->id == Auth::user()->id)(ME)@endif</label>
                    </div>
                    @if($progress->status_id == 3 && is_null($progress->content))
                    <form method="POST" action="{{$prefix}}/submitProgress">
                        @csrf
                        <input name="proj_id" value="{{$progress->proj_id}}" style="display:none">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Assignee</label>
                            <label style="margin-left: 14px; padding-top: 8px;">:</label>
                            <div class="col-md-4">
                                <select class="form-control custom-select @error('assignee_id') is-invalid @enderror" name="assignee_id" id="">
                                    <option value="">Choose</option>
                                    @foreach($desginers as $designer)
                                    <option value="{{$designer->id}}">{{$designer->first_name}} {{$designer->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('assignee_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Content</label>
                            <label style="margin-left: 14px; padding-top: 8px;">:</label>
                            <div class="col-md-5">
                                <textarea class="form-control @error('content') is-invalid @enderror" rows="4" cols="50" name="content" style="border: solid 1px #ccc; border-radius: 20px;"></textarea>  
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Comment</label>
                            <label style="margin-left: 14px; padding-top: 8px;">:</label>
                            <div class="col-md-5">
                                <textarea class="form-control" rows="4" cols="50" name="comment"
                                    style="border: solid 1px #ccc; border-radius: 20px;"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                    @else
                    <form method="POST" action="{{$prefix}}/reassign" id="reassign">
                        @csrf
                        @if($progress->reassign)
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Assignee</label>
                            <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label>
                            <select class="col-md-3 form-control custom-select @error('assignee_id') is-invalid @enderror" name="assignee_id">
                                <option value="">Choose</option>
                                @foreach($desginers as $designer)
                                    <option value="{{$designer->id}}">{{$designer->first_name}} {{$designer->last_name}}</option>
                                @endforeach
                            </select>
                            @error('assignee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Content</label>
                            <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label>
                            <textarea class="col-md-5 form-control @error('content') is-invalid @enderror" rows="4" cols="50" name="content"
                                style="border: solid 1px #ccc; border-radius: 20px;" disabled>{{$progress->content}}</textarea>
                        </div>
                        <input type="text" name="proj_id" value="{{$progress->proj_id}}" style="display:none">
                    </form>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            @if($progress->reassign)
                            <button type="submit" class="btn btn-success" onclick="event.preventDefault();document.getElementById('reassign').submit();">Re-Assign</button>
                            @endif
                            <button type="submit" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('back').submit();">Close</button>
                            <form action="{{$prefix}}" id="back" style="display:none"></form>
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive mt-5">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No.</th>
                                <th>User</th>
                                <th>Comment</th>
                            </thead>
                            <tbody>
                                @if(count($progress->progresses)>0)
                                    @php($num = 1)
                                    @foreach($progress->progresses as $progress)
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
