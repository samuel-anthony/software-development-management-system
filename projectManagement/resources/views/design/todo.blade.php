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
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">Reporter</label>
                        <label class="col-md-8 col-form-label">: {{$todo->progresses[$index]->reporter->first_name}} {{$todo->progresses[$index]->reporter->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <label class="col-md-8 col-form-label">: {{$todo->client->cl_email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label>
                        <textarea class="col-md-5 form-control" rows="4" cols="50" name="content" disabled style="border: solid 1px #ccc; border-radius: 20px;">{{$todo->requirement}}</textarea>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Content</label>
                        <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label>
                        <textarea class="col-md-5 form-control" rows="4" cols="50" name="content" disabled style="border: solid 1px #ccc; border-radius: 20px;">{{$todo->content}}</textarea>
                    </div>
                    @if($todo->status_id != 8)
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Reason To Reject</label>
                        <label style="margin-left: 14px; padding-top: 8px;">:</label>
                        <div class="col-md-4">
                            <textarea id="input-reason"class="form-control @error('reason')is-invalid @enderror" style="border: solid 1px #ccc; border-radius: 20px;">{{old('reason')}}</textarea>
                            @error('reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="approve" class="btn btn-success" onclick="event.preventDefault();document.getElementById('user-approve').submit();">Approve</button>
                            <button type="reject" class="btn btn-danger" onclick="event.preventDefault();$('#reason').val($('#input-reason').val());document.getElementById('user-reject').submit();">Decline</button>
                            <form id="user-approve" action="{{$prefix}}/approve" method="POST" style="display: none;">@csrf<input name="id" value="{{$todo->progresses[0]->progress_id}}" style="display:none"></form>
                            <form id="user-reject" action="{{$prefix}}/disapprove" method="POST" style="display: none;">@csrf<input name="id" value="{{$todo->progresses[0]->progress_id}}" style="display:none"><input id="reason" name="reason" style="display:none"></form>
                        </div>
                    </div>
                    @else
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="approve" class="btn btn-success" onclick="event.preventDefault();document.getElementById('revise').submit();">Revise</button>
                            <form id="revise" action="{{$prefix}}/revise" method="POST" style="display: none;">@csrf<input name="id" value="{{$todo->proj_id}}" style="display:none"></form>
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
                                <tr>
                                    <td colspan="3" class="text-center">Records Not Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
