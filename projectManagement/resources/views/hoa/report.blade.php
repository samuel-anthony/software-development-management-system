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
                                <button type="submit" class="btn btn-primary" id="buttonClient">Search By Client</button>
                                
                                <button type="submit" class="btn btn-primary"id="buttonStatus">Search By Status</button>
            
                                <button type="submit" class="btn btn-primary" id="buttonDivision">Search By Division</button>
                            </div>
                        </div>
                    <form method="POST" action="/hoa/report" id="client">
                        @csrf
                        <input type="text" name="start_date" id="startdateClient" style="display:none">
                        <input type="text" name="due_date" id="duedateClient" style="display:none">
                        <input type="text" name="type" id="" value="client" style="display:none">
                    </form>
                    <form method="POST" action="/hoa/report" id="status">
                        @csrf
                        <input type="text" name="start_date" id="startdateStatus" style="display:none">
                        <input type="text" name="due_date" id="duedateStatus" style="display:none">
                        <input type="text" name="type" id="" value="status" style="display:none">
                    </form>
                    <form method="POST" action="/hoa/report" id="division">
                        @csrf
                        <input type="text" name="start_date" id="startdateDivision" style="display:none">
                        <input type="text" name="due_date" id="duedateDivision" style="display:none">
                        <input type="text" name="type" id="" value="division" style="display:none">
                    </form>
                    <div class="table-responsive mt-5">
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
                    </div>
                    @php($labelClient = [])
                    @php($todos = [])
                    @php($inprogresses = [])
                    @php($dones = [])
                    @php($lates = [])
                    
                    @if(($type ?? '')=='status')
                    <div class="row">
                        <div class="col-6">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="col-6">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                    
                    @elseif(($type ?? '')=='client')
                    <div class="row">
                        <div class="col-6">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    @foreach($clients as $client)
                        @php($todo = 0)
                        @php($inprogress = 0)
                        @php($done = 0)
                        @php($doneLate = 0)
                        @foreach($client->projects as $project)
                            @if($project->status_id == 1)
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
                    
                    <div class="row">
                        <div class="col-6">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                    
                        @foreach($clients as $client)
                            @php($todo = 0)
                            @php($inprogress = 0)
                            @php($done = 0)
                            @foreach($client->projects as $project)
                                @if($project->status_id == 1)
                                    @php($todo++)
                                @elseif($project->status_id == 12 || $project->status_id==13)
                                    @php($done++)
                                @else
                                    @php($inprogress++)
                                @endif
                            @endforeach
                            @php(array_push($labelClient,$client->cl_name))
                            @php(array_push($todos,$todo))
                            @php(array_push($inprogresses,$inprogress))
                            @php(array_push($dones,$done))
                        @endforeach
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
        $("#buttonStatus").on("click", function(){
            event.preventDefault();
            var start_date = $("#datepicker1").val();
            var due_date = $("#datepicker2").val();
            $("#startdateStatus").val(start_date);
            $("#duedateStatus").val(due_date);
            document.getElementById('status').submit();
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
@endsection
