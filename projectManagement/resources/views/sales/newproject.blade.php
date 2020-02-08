@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Create New Project</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{$prefix}}/submitNewProject">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label><b>Start Date</b></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker3"
                                    class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                    value="{{old('start_date')}}">
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label><b>End Date</b></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker4"
                                    class="form-control @error('due_date') is-invalid @enderror" name="due_date"
                                    value="{{old('due_date')}}">
                                @error('due_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label><b>Client</b></label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="clientName" class="form-control @error('cl_name') is-invalid @enderror"
                                    name="cl_name" value="{{old('cl_name')}}">
                                @error('cl_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-1 p-0">
                                <button type="button" class="btn btn-sm btn-info my-1 mx-0" data-toggle="modal"
                                    data-target="#listOfClient">
                                    ...
                                </button>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label><b>E-mail</b></label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="clientEmail" class="form-control @error('cl_email') is-invalid @enderror"
                                    name="cl_email" value="{{old('cl_email')}}">
                                @error('cl_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Client's Address</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="clientAddress" class="form-control @error('cl_address') is-invalid @enderror"
                                    name="cl_address" value="{{old('cl_address')}}">
                                @error('cl_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Client's Phone Number</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="clientPhone" class="form-control @error('cl_telp') is-invalid @enderror"
                                    name="cl_telp" value="{{old('cl_telp')}}">
                                @error('cl_telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label><b>Assignee</b></label>
                            </div>
                            <div class="col-md-7">
                                <select class="form-control custom-select @error('user_id') is-invalid @enderror"
                                    name="user_id">
                                    <option value="">Choose</option>
                                    @foreach($marketings as $marketing)
                                    <option value="{{$marketing->id}}">{{$marketing->first_name}}
                                        {{$marketing->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label><b>Requirement</b></label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="col-md-5 form-control @error('requirement') is-invalid @enderror"
                                    rows="4" cols="50" name="requirement"
                                    style="border: solid 1px #ccc; border-radius: 20px;">{{old('requirement')}}</textarea>
                                @error('requirement')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Comment</label>
                            </div>
                            <div class="col-md-7">
                                <textarea class="col-md-5 form-control" rows="4" cols="50" name="comment"
                                    style="border: solid 1px #ccc; border-radius: 20px;max-height:120px;">{{old('comment')}}</textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="listOfClient" tabindex="-1" role="dialog" aria-labelledby="listOfClientTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listOfClientTitle">List Of Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Client</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($clients)>0)
                            @php($num = 1)
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$num}}.</td>
                                    <td><a class="getValue" href="" data-client="{{$client->cl_name}}" data-email="{{$client->cl_email}}" data-address="{{$client->cl_address}}" data-phone="{{$client->cl_telp}}" data-dismiss="modal">{{$client->cl_name}}</a></td>
                                    <td>{{$client->cl_email}}</td>
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
@endsection
