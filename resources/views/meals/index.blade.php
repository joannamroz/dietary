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

      <div class='panel-body' id='calendar-container' style='padding:1px;'>

        {!!$calendar!!}

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

@endsection
     