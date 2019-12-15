@extends('layouts.customlayout')

@section('content')
<div class="container">
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Detail Profile</h5>
              </div>
              <div class="card-body">
                <form method="POST" action="/division/edit division">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Division ID</label>  
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="{{$division->div_id}}">
                      </div>
                    </div>
                    <div class="col-md-5 px-1">
                      <div class="form-group">
                        <label>Division Name</label>
                        <input type="text" name="div_name "class="form-control" value="{{$division->div_name}}">
                      </div>
                    </div>

                  </div> 
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Menu Granted</label><br>
                        @php($num = 0)
                        @for($counter = 0;$counter < count($availableMenus); $counter++)
                          @if($availableMenus[$counter]['menu_id']!=$grantedMenus[$num]['menu_id'])
                            <label><input type="checkbox" name="menu[]" for="menu[]" value="{{$availableMenus[$counter]['menu_id']}}">{{$availableMenus[$counter]['menu_name']}}</label>
                          @else
                            @php($num++)
                            <label><input type="checkbox" name="menu[]" for="menu[]" value="{{$availableMenus[$counter]['menu_id']}}" checked>{{$availableMenus[$counter]['menu_name']}}</label>  
                          @endif
                          </br>
                        @endfor
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
