<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dietary | Joanna & Matt</title>

    <!-- <link href=" //asset('/css/app.css') " rel="stylesheet"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('/js/mainscript.js') }}"></script>
    <script src="{{ asset('/js/training.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

  </head>
  <body>
 
    <nav class="navbar navbar-default">

      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"> Foods </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="{{ url('/food/index') }}">Home</a></li>
            <li><a href="{{ url('/brand/index') }}">Brands</a></li>
            <li><a href="{{ url('/meal/index') }}">Meals</a></li>
            <li><a href="{{ url('/exercise/index') }}">Activity</a></li>
             <li><a href="{{ url('/training') }}">Training</a></li>
            <li><a href="{{ url('/user/index') }}">Users</a></li>
             @if (Auth::guest())
              <li><a href="{{ url('/auth/login') }}">Login</a></li>
              <li><a href="{{ url('/auth/register') }}">Register</a></li>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('/user/profile/'.Auth::id()) }}">My Profile</a></li>
                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
              </ul>
            </li>
            @endif
         
          </ul>

         
           
        </div>
      </div>
    </nav>

    @if (Session::has('message'))
    <div class="flash alert-info">
      <p class="panel-body">
        {{ Session::get('message') }}
      </p>
    </div>
    @endif
    @if ($errors->any())
    <div class='flash alert-danger'>
      <ul class="panel-body">
        @foreach ( $errors->all() as $error )
        <li>
          {{ $error }}
        </li>
        @endforeach
      </ul>
    </div>
    @endif
    <div class="container">
    
      <div class="row">

        <div class="col-md-12">
          <!-- Page title -->
         @yield('title')


          @yield('title-meta')

          <!-- Page content is added here  -->
          @yield('content')
        </div> <!-- main-container -->
      </div> <!-- row -->
    </div> <!-- container -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
  </body>
</html>