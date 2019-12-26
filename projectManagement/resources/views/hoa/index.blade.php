@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">New User Request</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Division</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @if(count($requestAdmins)>0)
                                @php($num = 1)
                                @foreach ($requestAdmins as $requestAdmin)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$requestAdmin->type}}</td>
                                    <td>Username : {{$requestAdmin->data->user_name}}, email :
                                        {{$requestAdmin->data->email}}
                                    </td>
                                    <td class="text-center">
                                        <a href='{{$prefix}}/detail user/{{$user->id}}'><button type="submit" class="btn btn-primary">View</button></a>
                                        <a href='{{$prefix}}/detail/{{$requestAdmin->id}}'><button type="submit" class="btn btn-primary">View</button></a>
                                    </td>
                                    @php($num++)
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">Records Not Found</td>
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
