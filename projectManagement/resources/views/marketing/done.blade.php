@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">{{$done->client->cl_name}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">Start</label>
                        <label class="col-md-8 col-form-label">: {{$done->start_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">End</label>
                        <label class="col-md-8 col-form-label">: {{$done->due_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">Finished</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <label class="col-md-8 col-form-label">: {{$done->client->cl_email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Assignee</label>
                        <div>
                            <label class="col-md col-form-label">: 1. {{$done->progresses[0]->assignee->first_name}} {{$done->progresses[0]->assignee->last_name}}</label>
                            @if($done->status_id >4)
                            <label class="col-md col-form-label">&nbsp; 2. {{$done->progresses[$index]->assignee->first_name}} {{$done->progresses[$index]->assignee->last_name}}</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label class="col-md-8 col-form-label">: {{$done->requirement}}</label>
                    </div>
                    @if(!is_null($done->content))
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Content</label>
                        <label class="col-md-8 col-form-label">: {{$done->content}}</label>
                    </div>
                    @endif
                    @if(!is_null($done->media))
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Media</label>
                        <div class="col-md-8">: <a href=""onclick="event.preventDefault();document.getElementById('download').submit();">attachment</a></div>
                        <form id="download" action="{{$prefix}}/download" method="POST" style="display: none;">@csrf<input type="text" name="id" value="{{$done->proj_id}}" style="display:none"></form>
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
                                @if(count($done->progresses)>0)
                                    @php($num = 1)
                                    @foreach($done->progresses as $progress)
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
