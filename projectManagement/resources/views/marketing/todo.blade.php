@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">{{$todo->project->client->cl_name}}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">Start</label>
                        <label class="col-md-8 col-form-label">: {{$todo->project->start_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">End</label>
                        <label class="col-md-8 col-form-label">: {{$todo->project->due_date}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-right">Reporter</label>
                        <label class="col-md-8 col-form-label">: {{$todo->reporter->first_name}} {{$todo->reporter->last_name}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <label class="col-md-8 col-form-label">: {{$todo->project->client->cl_email}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label><textarea disabled class="col-md-4 form-control" style="border: solid 1px #ccc; border-radius: 20px;">{{$todo->project->requirement}}</textarea>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="approve" class="btn btn-success" onclick="event.preventDefault();document.getElementById('user-approve').submit();">Approve</button>
                            <button type="reject" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('user-reject').submit();">Decline</button>
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
