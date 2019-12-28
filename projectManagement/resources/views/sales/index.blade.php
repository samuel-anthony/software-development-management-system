@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Your Target This Month is: 45</h3>
                </div>
                <div class="card-body">
                    <h4 class="text-center">To Do</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No.</th>
                                <th>Client</th>
                                <th>Start</th>
                                <th>End</th>
                            </thead>
                            <tbody>
                                @if(count($todos)>0)
                                    @php($num = 1)
                                    @foreach($todos as $task)
                                        <tr>
                                            <td>{{$num}}.</td>
                                            <td><a href="{{$prefix}}/todo/{{$task->progress_id}}">{{$task->project->client->cl_name}}</a></td>
                                            <td>{{$task->project->start_date}}</td>
                                            <td>{{$task->project->due_date}}</td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Records Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <h4 class="text-center mt-5">In Progress</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No.</th>
                                <th>Client</th>
                                <th>Start</th>
                                <th>End</th>
                            </thead>
                            <tbody>
                                @if(count($progresses)>0)
                                    @php($num = 1)
                                    @foreach($progresses as $task)
                                        <tr>
                                            <td>{{$num}}.</td>
                                            <td><a href="{{$prefix}}/progress/{{$task->progress_id}}">{{$task->project->client->cl_name}}</a></td>
                                            <td>{{$task->project->start_date}}</td>
                                            <td>{{$task->project->due_date}}</td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Records Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <h4 class="text-center mt-5">Done</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No.</th>
                                <th>Client</th>
                                <th>Start</th>
                                <th>End</th>
                            </thead>
                            <tbody>
                                @if(count($dones)>0)
                                    @php($num = 1)
                                    @foreach($dones as $task)
                                        <tr>
                                            <td>{{$num}}.</td>
                                            <td><a href="{{$prefix}}/done/{{$task->progress_id}}">{{$task->project->client->cl_name}}</a></td>
                                            <td>{{$task->project->start_date}}</td>
                                            <td>{{$task->project->due_date}}</td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">Records Not Found</td>
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
@endsection
