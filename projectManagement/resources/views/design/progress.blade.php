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
                        <label class="col-md-8 col-form-label">: {{$progress->client->cl_email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Reporter</label>
                        <label class="col-md col-form-label">: {{$progress->progresses[0]->reporter->first_name}} {{$progress->progresses[0]->reporter->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Assignee</label>
                        <div>
                            <label class="col-md col-form-label">: 1. {{$progress->progresses[0]->assignee->first_name}} {{$progress->progresses[0]->assignee->last_name}}</label>
                            <label class="col-md col-form-label">&nbsp; 2. {{$progress->progresses[$index]->assignee->first_name}} {{$progress->progresses[$index]->assignee->last_name}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label class="col-md-8 col-form-label">: {{$progress->requirement}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Content</label>
                        <label class="col-md-8 col-form-label">: {{$progress->content}}</label>
                    </div>
                    <form method="POST" action="{{$prefix}}/submitProgress" enctype="multipart/form-data">
                        @csrf
                        <input type="text"style="display:none" name="project_id" value="{{$progress->proj_id}}">
                        <div class="row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Media</label>
                            <input type="file" class="col-md-8 form-control-file @error('file') is-invalid @enderror" id="file" for="file" name="file">
                            @error('file')
                                <span class="invalid-feedback col-md-4 col-form-label" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Comment</label>
                            <textarea class="col-md-5 form-control" rows="4" cols="50" name="comment"
                                style="border: solid 1px #ccc; border-radius: 20px;"></textarea>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    <form>
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
