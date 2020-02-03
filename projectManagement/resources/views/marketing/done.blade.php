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
                        @if(!is_null($done->finished_date))
                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">Finished</label>
                            <label class="col-md-8 col-form-label">: {{$done->finished_date}}</label>
                        </div>
                        @endif
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
                            <label class="col-form-label" style="margin-left: 15px;">:&nbsp;</label>
                            <img src="data:image/png;base64,{{$done->media}}" data-toggle="modal" data-target="#previewMedia" width="200px" height="100px" alt="">                        </div>
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
    </div>

    <div class="modal fade" id="previewMedia" tabindex="-1" role="dialog" aria-labelledby="previewMedia" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewMedia">Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="data:image/png;base64,{{$done->media}}" data-toggle="modal" data-target="#previewMedia" alt="">
                    <div class="text-center">
                        <a href="" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('download').submit();">DOWNLOAD</a>
                        <form id="download" action="{{$prefix}}/download" method="POST" style="display: none;">@csrf<input type="text" name="id" value="{{$done->proj_id}}" style="display:none"></form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
