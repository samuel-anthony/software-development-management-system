@extends('layouts.customlayout')

@section('content')
<div class="container">
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Detail Division</h5>
              </div>
              <div class="card-body">
                <form method="GET" action="/division/edit division/{{$division->div_id}}">
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Division ID</label>  
                        <input type="text" class="form-control" disabled value="{{$division->div_id}}">
                      </div>
                    </div>
                    <div class="col-md-5 px-1">
                      <div class="form-group">
                        <label>Division Name</label>
                        <input type="text" class="form-control" disabled value="{{$division->div_name}}">
                      </div>
                    </div>

                  </div> 
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Menu Granted</label><br>
                        <ul>
                        @for($counter = 0;$counter < count($grantedMenus); $counter++)
                          <li><label>{{$grantedMenus[$counter]['menu_name']}}</label></li>
                        @endfor
                        </ul>
                      </div>
                    </div>
                  </div> 
                  <button type="submit" class="btn btn-primary">Edit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      
</div>
@endsection
