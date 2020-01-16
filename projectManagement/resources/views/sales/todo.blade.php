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
                        <label class="col-md-8 col-form-label">: {{$todo->requirement}}</label>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">Media</label>
                        <label class="col-form-label" style="margin-left: 15px;">:&nbsp;</label>
                        <img src="https://yt3.ggpht.com/a/AGF-l78F-aj-xBbqKTkXIujt_cBy5YMc3BnhYIn46w=s900-c-k-c0xffffffff-no-rj-mo" data-toggle="modal" data-target="#previewMedia" width="200px" height="100px">
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Assignee</label>
                        <div>
                            <label class="col-md col-form-label">: 1. {{$todo->progresses[0]->assignee->first_name}} {{$todo->progresses[0]->assignee->last_name}}</label>
                            <label class="col-md col-form-label">&nbsp; 2. {{$todo->progresses[$index]->assignee->first_name}} {{$todo->progresses[$index]->assignee->last_name}}</label>
                        </div>    
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="submit" class="btn btn-success" onclick="event.preventDefault();document.getElementById('revise').submit();">Review</button>
                            <button type="submit" class="btn btn-success" onclick="event.preventDefault();document.getElementById('done').submit();">Done</button>
                        </div>
                    </div>
                    <form method="POST" action="{{$prefix}}/review" id="revise">
                        @csrf
                        <input type="text" name="proj_id" style="display:none" value="{{$todo->proj_id}}">
                    </form>
                    <form method="POST" action="{{$prefix}}/finishProject" id="done">
                        @csrf
                        <input type="text" name="proj_id" style="display:none" value="{{$todo->proj_id}}">
                    </form>
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
        <img src="https://yt3.ggpht.com/a/AGF-l78F-aj-xBbqKTkXIujt_cBy5YMc3BnhYIn46w=s900-c-k-c0xffffffff-no-rj-mo" data-toggle="modal" data-target="#previewMedia">
        <div class="text-center">
            <a href="" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('download').submit();">DOWNLOAD</a>
            <form id="download" action="{{$prefix}}/download" method="POST" style="display: none;">@csrf<input type="text" name="id" value="{{$todo->proj_id}}" style="display:none"></form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
