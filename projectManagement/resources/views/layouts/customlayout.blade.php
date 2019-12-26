<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Brand Advertising Management System</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
    <link href="/assets/css/main.css" rel="stylesheet" />

    @if(is_null($allMenu ?? null))  
      <style>
        html,
        body {
          height: 100%;
        }

        body {
          display: -ms-flexbox;
          display: flex;
          -ms-flex-align: center;
          align-items: center;
          padding-top: 40px;
          padding-bottom: 40px;
          background-color: #f5f5f5;
        }

        .form-signin {
          width: 100%;
          max-width: 330px;
          padding: 15px;
          margin: auto;
        }
        .form-signin .checkbox {
          font-weight: 400;
        }
        .form-signin .form-control {
          position: relative;
          box-sizing: border-box;
          height: auto;
          padding: 10px;
          font-size: 16px;
        }
        .form-signin .form-control:focus {
          z-index: 2;
        }
        .form-signin input[type="email"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
    </style>
    @endif
</head>

<body>
    @if(!is_null($allMenu ?? null))
      <div class="wrapper">
          <div class="sidebar" data-color="blue">
              <div class="logo">
                  <a href="/home" class="simple-text logo-normal">Home</a>
              </div>
              <div class="sidebar-wrapper" id="sidebar-wrapper">
                  <ul class="nav">
                      @for($counter = 0; $counter < count($allMenu); $counter++)
                      <li>
                        <a href="{{$prefix ?? null}}/{{$allMenu[$counter]->menu_name}}">
                            <i class="now-ui-icons design_app"></i>
                            <p>{{$allMenu[$counter]->menu_name}}</p>
                        </a>
                      </li>
                      @endfor
                  </ul>
              </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-md-block">{{Auth::user()->first_name}}</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/user/detail user/{{Auth::user()->id}}">Edit Profile</a>
                  <a class="dropdown-item" href="{{ route('logout') }}" 
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </div>
      </div>
    @else
      <div class="container">
          <div class="text-center">@yield('content')</div>
      </div>
    @endif

    <script src="/assets/js/core/jquery.min.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    <script src="/assets/js/plugins/bootstrap-notify.js"></script>
    <script src="/assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
</body>
</html>
