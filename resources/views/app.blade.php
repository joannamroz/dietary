<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dietary | Joanna & Matt</title>

    <!-- <link href=" //asset('/css/app.css') " rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <link href="{{ asset('css/fuchsia.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified CSS -->
   

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">


  </head>
  <body class='fuchsia'>
    <div class='wrapper'> 
      @include('elements.navbar')

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

        <div class='dashboard'>

          @include('elements/sidebar')
          <div class='main'>
            <div class="scrollable scrollbar-macosx">
              <div class="main__cont">
                <!-- <div class="main-heading">
                  <div class="main-title">
                    <ol class="breadcrumb">
                      <li class="active">Dashboard</li>
                    </ol>
                  </div>
                  <div class="main-filter">
                    <form class="main-filter__search">
                      <div class="input-group">
                        <input type="text" placeholder="Search..." class="form-control"><span class="input-group-btn">
                          <button type="button" class="btn btn-default">
                            <div class="fa fa-search"></div>
                          </button></span>
                      </div>
                    </form>
                  </div>
                </div> -->

                <div class="container-fluid half-padding">
                  <div class="pages pages_dashboard">             
                      <!-- Page title -->
                     @yield('title')

                      @yield('title-meta')

                      <!-- Page content is added here  -->
                      @yield('content')
             
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Latest compiled and minified JavaScript -->


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 

    <script src="{{ asset('/js/mainscript.js') }}"></script>
    <script src="{{ asset('/js/training.js') }}"></script>


    <script src="{{ asset('/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-tabdrop.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-datepicker.js') }}"></script>


    <script src="{{ asset('/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('/js/main-extra.js') }}"></script>
    <script src="{{ asset('/js/inputNumber.js') }}"></script>


    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>



  </body>
</html>