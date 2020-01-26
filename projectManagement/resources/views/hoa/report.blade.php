@extends('layouts.customlayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Report</h3>
                </div>
                <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Start Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker1" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{$strt_dt ?? old('start_date')}}">
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>End Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker2" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{$due_dt??old('due_date')}}">
                                @error('due_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary" id="buttonClient">Show Chart By Client</button>
                                
                                <button type="submit" class="btn btn-primary"id="buttonUser">Show Chart By User</button>
            
                                <button type="submit" class="btn btn-primary" id="buttonDivision">Show Chart By Division</button>
                            </div>
                        </div>
                    <form method="POST" action="/hoa/report" id="client">
                        @csrf
                        <input type="text" name="start_date" id="startdateClient" style="display:none">
                        <input type="text" name="due_date" id="duedateClient" style="display:none">
                        <input type="text" name="type" id="" value="client" style="display:none">
                    </form>
                    <form method="POST" action="/hoa/report" id="user">
                        @csrf
                        <input type="text" name="start_date" id="startdateStatus" style="display:none">
                        <input type="text" name="due_date" id="duedateStatus" style="display:none">
                        <input type="text" name="type" id="" value="user" style="display:none">
                    </form>
                    <form method="POST" action="/hoa/report" id="division">
                        @csrf
                        <input type="text" name="start_date" id="startdateDivision" style="display:none">
                        <input type="text" name="due_date" id="duedateDivision" style="display:none">
                        <input type="text" name="type" id="" value="division" style="display:none">
                    </form>
                    <!--<div class="table-responsive mt-5">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No.</th>
                                <th>Client</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @if(count($projects)>0)
                                @php($num = 1)
                                @foreach ($projects as $project)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$project->client->cl_name}}</td>
                                    <td>{{$project->start_date}}</td>
                                    <td>{{$project->due_date}}</td>
                                    <td>{{$project->status->status_name}}</td>
                                    @php($num++)
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-center">Records Not Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>-->
                    @php($labelClient = [])
                    @php($progressWork = [])
                    @php($todos = [])
                    @php($inprogresses = [])
                    @php($dones = [])
                    @php($lates = [])
                    @php($counter = 1)
                    @php($userDesign)
                                    
                    @if(($type ?? '')=='user')
                    @foreach($projects as $project)
                        @php($labelUser = [])
                        @php($daySales = 1+(date_diff(date_create($project->progresses[0]->updated_at),date_create($project->progresses[0]->created_at)))->format("%d"))
                        @php($dayMarketing = 0)
                        @php($dayDesign = 0)

                        @if(is_null($project->progresses[0]->assignee_id))
                            @php(array_push($labelUser,$project->progresses[0]->reporter->first_name.' '.$project->progresses[0]->reporter->last_name))
                            @php(array_push($progressWork,[$daySales]))
                        @else
                            @php(array_push($labelUser,$project->progresses[0]->reporter->first_name.' '.$project->progresses[0]->reporter->last_name,$project->progresses[0]->assignee->first_name.' '.$project->progresses[0]->assignee->last_name))
                            @foreach($project->progresses as $progress)
                                @if($project->progresses[0]->assignee_id==$progress->reporter_id && !is_null($progress->assignee_id))
                                    @php($userDesign = $progress->assignee->id)
                                    @php(array_push($labelUser,$progress->assignee->first_name.' '.$progress->assignee->last_name))
                                @endif                                
                            @endforeach
                            <!--ini untuk cari day nya sales-->
                            @php($marker = 0)
                            @php($c = 0)
                            @foreach($project->progresses as $progress)
                                @if($progress->assignee_id == $project->progresses[0]->reporter_id)
                                    @php($marker = $c)
                                @elseif($marker!=0 && $progress->reporter_id == $project->progresses[0]->reporter_id)
                                    @php($daySales += (date_diff(date_create($project->progresses[$marker]->updated_at),date_create($progress->created_at))->format("%d")))
                                @endif
                                @php($c++)
                            @endforeach
                            
                            <!--ini untuk cari day nya marketing-->
                            @if(count($labelUser)>1)
                                @php($marker = 0)
                                @php($c = 0)
                                @foreach($project->progresses as $progress)
                                    @if($progress->assignee_id == $project->progresses[0]->assignee_id)
                                        @php($marker = $c)
                                    @elseif($progress->reporter_id == $project->progresses[0]->assignee_id)
                                        @php($dayMarketing += (date_diff(date_create($project->progresses[$marker]->updated_at),date_create($progress->updated_at))->format("%d")))
                                    @endif
                                    @php($c++)
                                @endforeach
                            @endif


                            <!--ini untuk cari day nya design-->
                            @if(count($labelUser)>2)
                                @php($marker = 0)
                                @php($c = 0)
                                @foreach($project->progresses as $progress)
                                    @if($progress->assignee_id == $userDesign)
                                        @php($marker = $c)
                                    @elseif($progress->reporter_id == $userDesign)
                                        @php($dayDesign += (date_diff(date_create($project->progresses[$marker]->updated_at),date_create($progress->updated_at))->format("%d")))
                                    @endif
                                    @php($c++)
                                @endforeach
                            @endif
                            <!--gamungkin kerja < 1 hari makanya di default lagi 1-->
                            @if($dayDesign < 1)
                                @php($dayDesign =1)
                            @endif
                            <!--gamungkin kerja < 1 hari makanya di default lagi 1-->
                            @if($dayMarketing < 1)
                                @php($dayMarketing =1)
                            @endif
                            @if(count($labelUser)>2)
                            @php(array_push($progressWork,[$daySales,$dayMarketing,$dayDesign]))
                            @else
                            @php(array_push($progressWork,[$daySales,$dayMarketing]))
                            @endif
                        @endif
                        @php(array_push($labelClient,$labelUser))
                    <div class="row justify-content-center">
                        Project : {{$project->client->cl_name}}, start date : {{$project->start_date}}, due date : {{$project->due_date}}
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <canvas id="myChartSingle{{$counter}}"></canvas>
                        </div>
                    </div>
                    
                    @php($counter++)
                    @endforeach
                    @elseif(($type ?? '')=='client')
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    @foreach($clients as $client)
                        @php($todo = 0)
                        @php($inprogress = 0)
                        @php($done = 0)
                        @php($doneLate = 0)
                        @foreach($client->projects as $project)
                            @if($project->status_id == 1 || $project->status_id == 2)
                                @php($todo++)
                            @elseif($project->status_id == 12)
                                @php($done++)
                            @elseif($project->status_id == 13)
                                @php($doneLate++)
                            @else
                                @php($inprogress++)
                            @endif
                        @endforeach
                        @php(array_push($labelClient,$client->cl_name))
                        @php(array_push($todos,$todo))
                        @php(array_push($inprogresses,$inprogress))
                        @php(array_push($dones,$done))
                        @php(array_push($lates,$doneLate))
                    @endforeach

                    @elseif(($type ?? '')=='division')
                    
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                    @php(array_push($labelClient,'Sales','Marketing','Design'))
                            
                    @php($todo = 0)
                    @php($inprogress = 0)
                    @php($done = 0)
                    
                    @foreach($projects as $project)
                        @if($project->status_id == 1 || $project->status_id == 6 )
                            @php($todo++)
                        @elseif($project->status_id == 2 || $project->status_id==7)
                            @php($inprogress++)
                        @else
                            @php($done++)
                        @endif
                    @endforeach
                    @php(array_push($todos,$todo))
                    @php(array_push($inprogresses,$inprogress))
                    @php(array_push($dones,$done))


                    @php($todo = 0)
                    @php($inprogress = 0)
                    @php($done = 0)
                    
                    @foreach($projects as $project)
                        @if($project->status_id == 1 || $project->status_id == 2 || $project->status_id == 10 )
                            @php($todo++)
                        @elseif($project->status_id == 3 || $project->status_id==4 || $project->status_id == 11)
                            @php($inprogress++)
                        @else
                            @php($done++)
                        @endif
                    @endforeach
                    @php(array_push($todos,$todo))
                    @php(array_push($inprogresses,$inprogress))
                    @php(array_push($dones,$done))



                    @php($todo = 0)
                    @php($inprogress = 0)
                    @php($done = 0)
                    
                    @foreach($projects as $project)
                        @if($project->status_id == 4 || $project->status_id == 8 )
                            @php($todo++)
                        @elseif($project->status_id == 5 || $project->status_id==9)
                            @php($inprogress++)
                        @elseif($project->status_id != 4 && $project->status_id != 5 && $project->status_id != 8 && $project->status_id != 9 && $project->status_id > 4)
                            @php($done++)
                        @endif
                    @endforeach
                    @php(array_push($todos,$todo))
                    @php(array_push($inprogresses,$inprogress))
                    @php(array_push($dones,$done))

                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/jquery-1.12.4.js"></script>
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script>
        $("#buttonClient").on("click", function(){
            event.preventDefault();
            var start_date = $("#datepicker1").val();
            var due_date = $("#datepicker2").val();
            $("#startdateClient").val(start_date);
            $("#duedateClient").val(due_date);
            document.getElementById('client').submit();
        }); 
        $("#buttonUser").on("click", function(){
            event.preventDefault();
            var start_date = $("#datepicker1").val();
            var due_date = $("#datepicker2").val();
            $("#startdateStatus").val(start_date);
            $("#duedateStatus").val(due_date);
            document.getElementById('user').submit();
        }); 
        $("#buttonDivision").on("click", function(){
            event.preventDefault();
            var start_date = $("#datepicker1").val();
            var due_date = $("#datepicker2").val();
            $("#startdateDivision").val(start_date);
            $("#duedateDivision").val(due_date);
            document.getElementById('division').submit();
        }); 
        var ctx = document.getElementById('myChart').getContext('2d');
        var clr = ['rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)']
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labelClient),
                datasets: [
                    {
                        label: "To do",
                        backgroundColor: clr[0],
                        data: @json($todos)
                    },
                    {
                        label: "In Progress",
                        backgroundColor: clr[1],
                        data: @json($inprogresses)
                    },
                    {
                        label: "Done",
                        backgroundColor: clr[2],
                        data: @json($dones)
                    }
                    ,
                    {
                        label: "Late",
                        backgroundColor: clr[3],
                        data: @json($lates)
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        
    </script>
    <script>
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var clr = ['rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)']
        
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($labelClient),
                datasets: [
                    {
                        label: "To do",
                        backgroundColor: clr[0],
                        data: @json($todos)
                    },
                    {
                        label: "In Progress",
                        backgroundColor: clr[1],
                        data: @json($inprogresses)
                    },
                    {
                        label: "Done",
                        backgroundColor: clr[2],
                        data: @json($dones)
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    
    <script>
        @php($counter = 1)
        @if(($type ?? '')=='user')
        @foreach($labelClient as $client)
        var ctx3 = document.getElementById('myChartSingle{{$counter}}').getContext('2d');
        var clr = ['rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)']
        
        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($client),
                datasets: [{
                    label: '# days of work',
                    data: @json($progressWork[$counter-1]),
                    backgroundColor: clr
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        @php($counter++)
        @endforeach
        @endif
    </script>
@endsection
