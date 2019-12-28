@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">"Client Name"</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">Start</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">End</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">E-mail</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label class="col-md-8 col-form-label">: </label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Media</label>
                        <div class="col-md-8">: <img src="" width="200" height="200" alt="Images 1"></div>
                    </div>
                    <form method="POST" action="">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Assignee</label>
                            <select class="col-md-3 form-control custom-select" for="" name="">
                                <option value="1">Satu</option>
                                <option value="2">Dua</option>
                                <option value="3">Tiga</option>
                            </select>
                        </div>
                        <div class="row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Content</label>
                            <input type="file" class="col-md-8 form-control-file" id="file" for="file" name="file">
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Comment</label>
                            <textarea class="col-md-5 form-control" rows="4" cols="50" name="comment" form="usrform"
                                style="border: solid 1px #ccc; border-radius: 20px;"></textarea>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-success">Re-Assign</button>
                                <button type="submit" class="btn btn-danger">Close</button>
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
                                @if(count($progress->project->progresses)>0)
                                    @php($num = 1)
                                    @foreach($progress->project->progresses as $progress)
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
