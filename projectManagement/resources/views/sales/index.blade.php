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
                                <tr>
                                    <td colspan="4" class="text-center">Records Not Found</td>
                                </tr>
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
                                <tr>
                                    <td colspan="4" class="text-center">Records Not Found</td>
                                </tr>
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
                                <tr>
                                    <td colspan="4" class="text-center">Records Not Found</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
