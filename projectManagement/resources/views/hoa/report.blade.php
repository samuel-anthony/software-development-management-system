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
                    <form method="POST" action="">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Start Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker1" class="form-control" name="" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>End Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker2" class="form-control" name="" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Client</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control custom-select" for="" name="">
                                    <option value="1">Satu</option>
                                    <option value="2">Dua</option>
                                    <option value="3">Tiga</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Division</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control custom-select" for="" name="">
                                    <option value="1">Satu</option>
                                    <option value="2">Dua</option>
                                    <option value="3">Tiga</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Status</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control custom-select" for="" name="">
                                    <option value="1">Satu</option>
                                    <option value="2">Dua</option>
                                    <option value="3">Tiga</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Assigne</label>
                            </div>
                            <div class="col-md-7">
                                <input name="" type="text" class="form-control @error('') is-invalid @enderror" name=""
                                    required autocomplete="" autofocus value="">
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
                                <th>Clien</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Assignee</th>
                                <th>Division</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @if(count($requestAdmins)>0)
                                @php($num = 1)
                                @foreach ($requestAdmins as $requestAdmin)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$requestAdmin->type}}</td>
                                    <td>Username : {{$requestAdmin->data->user_name}}, email :
                                        {{$requestAdmin->data->email}}</td>
                                    <td class="text-center">
                                        <a href='{{$prefix}}/detail/{{$requestAdmin->id}}'><button type="submit"
                                                class="btn btn-primary">View</button></a>
                                    </td>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
