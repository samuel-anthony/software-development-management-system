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
                        <label class="col-md-8 col-form-label">: {{$progress->progresses[0]->reporter->first_name}} {{$progress->progresses[0]->reporter->last_name}}@if($progress->progresses[0]->reporter->id == Auth::user()->id) (Me)@endif</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Requirement</label>
                        <label class="col-md-8 col-form-label">: {{$progress->requirement}}</label>
                    </div>
                    @if($progress->status_id !=7)        
                    <form method="GET" action="{{$prefix}}">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Assignee</label>
                            <label class="col-md-8 col-form-label">: {{$progress->progresses[0]->assignee->first_name}} {{$progress->progresses[0]->assignee->last_name}}@if($progress->progresses[0]->assignee->id == Auth::user()->id) (Me)@endif</label>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn">back</button>
                            </div>
                        </div>
                    </form>
                    @else
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Assignee</label>
                            <div>
                                <label class="col-md-8 col-form-label">: {{$progress->progresses[0]->assignee->first_name}} {{$progress->progresses[0]->assignee->last_name}}@if($progress->progresses[0]->assignee->id == Auth::user()->id) (Me)@endif</label>
                                <label class="col-md-8 col-form-label">: {{$progress->progresses[$index]->assignee->first_name}} {{$progress->progresses[$index]->assignee->last_name}}@if($progress->progresses[0]->assignee->id == Auth::user()->id) (Me)@endif</label>
                            </div>
                        </div>
                        <form method="POST" action="{{$prefix}}/revision" id="review"><input type="text" style="display:none" value="{{$progress->proj_id}}" name="proj_id">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"><b>Ask Revision to</b></label>
                                <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label>
                                <div class="col-md-5">
                                    <select class="form-control custom-select @error('assignee_id') is-invalid @enderror" name="assignee_id" id="">
                                        <option value="">Choose</option>
                                        @foreach($progress->assignee as $assignee)
                                            <option value="{{$assignee->id}}">{{$assignee->first_name}} {{$assignee->last_name}}</option>
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
                                <label for="role" class="col-md-4 col-form-label text-md-right"><b>Comment</b></label>
                                <label style="margin-left: 14px; padding-top: 8px;">:&ensp;</label>
                                <div class="col-md-5">
                                    <textarea class="form-control" rows="4" cols="50" name="comment"
                                        style="border: solid 1px #ccc; border-radius: 20px;">{{old('comment')}}</textarea>
                                </div>
                            </div>
                        </form>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-success" onclick="event.preventDefault();document.getElementById('review').submit();">Ask to Revise</button>
                                <button type="submit" class="btn" onclick="event.preventDefault();document.getElementById('back').submit();">back</button>
                            </div>
                        </div>
                    <form method="GET" action="{{$prefix}}" id="back"></form>
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
