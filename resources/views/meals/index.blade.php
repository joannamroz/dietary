@extends('app')

@section('content')

<div class="row">
  <div class="col-md-7" id='meals-content'>
    @include('meals.ajax_meal')
  </div> 

  <div class="col-md-5">
    <div class='panel panel-success'>
      <div class='panel-heading'>
        <h3 class='panel-title'> Calendar </h3>
      </div>

      <div class='panel-body'>

        <div class="row">
          <div class="col-md-10" style="padding:1%" >
            <center><b id="calendar-month" class="panel-title">{{$now->format('F')}} {{$now->format('Y')}}</b></center>
          </div>
        </div>
        <div class="row">
          <div class="col-md-1">
          <i class="fa fa-chevron-left fa-lg monthChange"></i>
          </div>
          <div class="col-md-8" id="calendar-container">
            {!!$calendar!!}
          </div>
          <div class="col-md-1">
            <i class="fa fa-chevron-right fa-lg monthChange next"></i>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <center>
              @include('meals.meals_form')
            </center>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>          

@endsection
     