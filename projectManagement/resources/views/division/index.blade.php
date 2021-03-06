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
                        Division ID
                      </th>
                      <th>
                        Division Name
                      </th>
                      <th class="text-center">
                        Action
                      </th>
                    </thead>
                    <tbody>
                    @foreach ($divisions as $division)
                        <tr>
                            <td>{{$division->div_id}}</td>
                            <td>{{$division->div_name}}</td>
                            <td class="text-center">
                              <a href='{{$prefix}}/detail division/{{$division->div_id}}'><button type="submit" class="btn btn-primary">View</button></a>
                              <a href='{{$prefix}}/edit division/{{$division->div_id}}'><button type="submit" class="btn btn-primary">Edit</button></a>
                            </td>
                        </tr>    
                    @endforeach
                      
                    </tbody>
                  </table>

                  {{ $divisions->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
</div>
@endsection
