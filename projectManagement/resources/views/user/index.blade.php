@extends('layouts.customlayout')

@section('content')
<div class="container">
    
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Simple Table</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        User
                      </th>
                      <th>
                        Email
                      </th>
                      <th>
                        Division
                      </th>
                      <th class="text-center">
                        Action
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->divisions[0]['div_name']}}</td>
                            <td class="text-center">
                              <a href='{{$prefix}}/detail user/{{$user->id}}'><button type="submit" class="btn btn-primary">View</button></a>
                              <a href='{{$prefix}}/edit user/{{$user->id}}'><button type="submit" class="btn btn-primary">Edit</button></a>
                            </td>
                        </tr>    
                    @endforeach
                      
                    </tbody>
                  </table>

                  {{ $users->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
</div>
@endsection
