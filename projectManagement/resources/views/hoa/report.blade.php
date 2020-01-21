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
                    <form method="POST" action="/hoa/report">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Start Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker1" class="form-control" name="start_date" value="{{$strt_dt ?? old('start_date')}}">
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
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Status</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control custom-select" for="" name="status">
                                    <option value="">No filter</option>
                                    @if(!is_null($status_old))
                                    @foreach($statuses as $status)
                                        <option value="{{$status->status_id}}">{{$status->status_name}}</option>
                                    @endforeach
                                    @else
                                    @foreach($statuses as $status)
                                        @if($status == $status_old)
                                        <option value="{{$status->status_id}}" selected>{{$status->status_name}}</option>
                                        @else
                                        <option value="{{$status->status_id}}">{{$status->status_name}}</option>
                                        @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
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
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@php($labelClient = [])
@php($clientProject = [])
@foreach($clients as $client)
    @php(array_push($labelClient,$client->cl_name))
    @php(array_push($clientProject,count($client->projects)))
@endforeach
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script>
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
                datasets: [{
                    label: '# of Votes',
                    data: @json($clientProject),
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
    </script>
@endsection
