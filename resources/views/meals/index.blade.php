@extends('app')


@section('content')

<div class = "row">
  <div class = "col-md-8" id = 'meals-content'>

    @if ( !$meals->count() )
      <span style = "font-size:19px;font-weight:bold">There is no meals for {{$now->format('d')}} {{$now->format('F')}} {{$now->format('Y')}}</span>
      <br/>

    @else
      <span style = "font-size:19px;font-weight:bold">Meals for {{$now->format('d')}} {{$now->format('F')}} {{$now->format('Y')}}</span>
      <?php $suma_kcal = 0; ?>
     
        <div class = "list-group">
          <div class = "list-group-item">
            <table class = "table table-bordered">
              <tr>
                <th>Name</th><th>Weight</th><th>kcal</th><th>Protein</th><th>Carbohydrate</th><th>Fat</th><th>Fibre</th><th>Comment</th><th>Edit</th>
              </tr>
              @foreach( $meals as $meal )
              <tr>
              <?php 
                $name = $meal->food->name;
                $string = (strlen($name) > 15) ? substr($name,0,15).'...' : $name; ?>

                <th title = "{{ $meal->food->name }}">{{$string}}</th>
                <td>{{ $meal->weight }}g</td>
                <td>{{ $meal->weight * $meal->kcal / 100}}</td>
                <td>{{ $meal->weight * $meal->proteins / 100 }}</td>
                <td>{{ $meal->weight * $meal->carbs / 100 }}</td>
                <td>{{ $meal->weight * $meal->fats / 100 }}</td>
                <td>{{ $meal->weight * $meal->fibre / 100 }} </td>
                <td class = "tdCenter"><i class = "fa fa-comment" title = "{{ $meal->comment }}"></i></td>
                <td class = "tdCenter"><a href = "{{ url('meal/edit/'.$meal->meal_id)}}"><i class = "fa fa-pencil"></i> </a></td>
                
              </tr>
              <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
              @endforeach

              <tr>
                <th class = "tdCenter">Total : </th>
                <td>{{ $totals['sum_weight'] }}g </td>
                <td>{{ $totals['sum_kcal'] }}</td>
                <td>{{ $totals['sum_proteins'] }}</td>
                <td>{{ $totals['sum_carbs'] }}</td>
                <td>{{ $totals['sum_fats'] }}</td>
                <td>{{ $totals['sum_fibre'] }}</td>
                <td></td>
               
              </tr>
            </table>                
          </div> <!-- list-group-item -->
        </div> <!-- list-group -->
    <h4 style = "float:right; color:red; font-weight:bold">Total kcal:{{ $suma_kcal }}</h4>
    @endif

    @if ( !$meals_planed->count() )
      <span style = "font-size:19px;font-weight:bold">There is no planed meals for {{$now->format('d')}} {{$now->format('F')}} {{$now->format('Y')}}</span>
      <br/>
    @else
      <span style = "font-size:19px;font-weight:bold">Meals planed for {{$now->format('d')}} {{$now->format('F')}} {{$now->format('Y')}}</span>
      <?php $suma_kcal = 0; ?>
     
        <div class = "list-group">
          <div class = "list-group-item">
            <table class = "table table-bordered">
              <tr>
                <th>Name</th><th>Weight</th><th>kcal</th><th>Protein</th><th>Carbohydrate</th><th>Fat</th><th>Fibre</th><th>Comment</th><th>Edit</th><th>Planed</th>
              </tr>
              @foreach( $meals_planed as $meal )
              <tr>
              <?php 
                $name = $meal->food->name;
                $string = (strlen($name) > 15) ? substr($name,0,15).'...' : $name; ?>

                <th title = "{{ $meal->food->name }}">{{ $string}}</th>
                <td>{{ $meal->weight }}g</td>
                <td>{{ $meal->weight * $meal->kcal / 100}}</td>
                <td>{{ $meal->weight * $meal->proteins / 100 }}</td>
                <td>{{ $meal->weight * $meal->carbs / 100 }}</td>
                <td>{{ $meal->weight * $meal->fats / 100 }}</td>
                <td>{{ $meal->weight * $meal->fibre / 100 }} </td>
                <td class = "tdCenter"><i class = "fa fa-comment" title = "{{ $meal->comment }}"></i></td>
                <td class = "tdCenter"><a href = "{{ url('meal/edit/'.$meal->meal_id)}}"><i class = "fa fa-pencil"></i> </a></td>
                <td class = "tdCenter">@if($meal->planed==1)<i class = "fa fa-flag kupka" data-meal-id = "{{ $meal->meal_id }}"></i>@endif</td>
              </tr>
              <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
             @endforeach


              <tr>
                <th class = "tdCenter">Total : </th>
                <td>{{ $totals_planed['sum_weight'] }}g </td>
                <td>{{ $totals_planed['sum_kcal'] }}</td>
                <td>{{ $totals_planed['sum_proteins'] }}</td>
                <td>{{ $totals_planed['sum_carbs'] }}</td>
                <td>{{ $totals_planed['sum_fats'] }}</td>
                <td>{{ $totals_planed['sum_fibre'] }}</td>
                <td></td>
                <td></td>
              </tr>
            </table>                
          </div>
      </div>
      <h4 style = "float:right; color:red; font-weight:bold">Total kcal:{{ $suma_kcal }}</h4>
      @endif
  </div> <!-- class="col-md-8" id='meals-content' -->
  <div class = "col-md-4">

    <h3 class = "smallHeader">{{$now->format('F')}} {{$now->format('Y')}}</h3>


      {!!$calendar!!}
     
      <form action = "/new-meal" method = "post" class = "ajax">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
        <input type = "hidden" value = "{{$today}}" name = "thisDay">
        <input type = "hidden" value = "{{$now->format('d')}}" name = 'day' id = "selectedDay"/>
        <input type = "hidden" value = "{{$now->format('m')}}" name = 'month' id = "selectedMonth"/>
        <input type = "hidden" value = "{{$now->format('Y')}}" name = 'year' id = "selectedYear"/> 
        <input required = "required" value = "{{$now->format('Y-m-d')}}" type = "hidden" name = "date" class = "form-control" />     
        <div class = "form-group noMarginBottom">
          <label class = "control-label"></label>
            <select class = "use-select2-food" name = "food_id" placeholder = 'Select food'>
              <option value = ""></option>
              @foreach ($foods as $food)
             <option value = "{{$food->id}}" >{{$food->name}}</option>
            @endforeach
           
          </select>
           
        </div>
        <div class = "form-group noMarginBottom">
          <label class = "control-label short">Planed </label>
          <input type = 'checkbox' value = "0" name = "planed_food" class = 'planed_food' style = "margin-left:60px" /> 
        </div>
        <div class = "form-group noMarginBottom">
          <label class = "control-label short">Weight (g)</label>
          <input required = "required" value = "{{ old('weight') }}" placeholder = "Enter weight (in grams)" type = "text" name = "weight"class = "form-control short" />
        </div>
        <div class = "form-group noMarginBottom">
          <label class = "control-label short">Comment</label>
          <input value = "{{ old('comment') }}" placeholder = "Enter comment" type = "text" name = "comment" class = "form-control short" />
        </div>
        <div class = "form-group noMarginBottom">
          <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/><a href = "{{ url('food/new-food') }}"  class = "btn btn-success" id = "addNewFood"> + </a>
        </div>
      </form>
  </div>
</div>          

@endsection
 

