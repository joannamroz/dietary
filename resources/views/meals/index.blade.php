@extends('app')

@section('content')

<div class="row">
  <div class="col-md-7" id='meals-content'>
    <h3>Meals for {{$now->format('d')}} {{$now->format('F')}} {{$now->format('Y')}}</h3>

    @if ( !$meals->count() )

      <h4 style="font-weight:bold">Consumed: - </h4><br/>

    @else

      <h4 style = "font-weight:bold">Consumed:</h4>

      <?php $suma_kcal = 0; ?>
      <table class="table table-bordered">
        <tr>
          <th>Name</th><th>Weight</th><th>kcal</th><th>Protein</th><th>Carbohydrate</th><th>Fat</th><th>Fibre</th><th>Comment</th><th>Edit</th>
        </tr>
        @foreach( $meals as $meal )
        <tr>
        <?php 
          $name = $meal->food->name;
          $string = (strlen($name) > 15) ? substr($name,0,15).'...' : $name; ?>

          <th title="{{ $meal->food->name }}">{{$string}}</th>
          <td>{{ $meal->weight }}g</td>
          <td>{{ number_format(($meal->weight * $meal->kcal / 100), 1) }}</td>
          <td>{{ number_format(($meal->weight * $meal->proteins / 100), 1) }}</td>
          <td>{{ number_format(($meal->weight * $meal->carbs / 100), 1) }}</td>
          <td>{{ number_format(($meal->weight * $meal->fats / 100), 1) }}</td>
          <td>{{ number_format(($meal->weight * $meal->fibre / 100), 1) }} </td>
          <td class="tdCenter"><i class="fa fa-comment" title="{{ $meal->comment }}"></i></td>
          <td class="tdCenter"><a href="{{ url('meal/edit/'.$meal->meal_id)}}"><i class="fa fa-pencil"></i></a></td>
          
        </tr>
        <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
        @endforeach

        <tr class="total-row">
          <th class="tdCenter">Total : </th>
          <td>{{ $totals['sum_weight'] }}g </td>
          <td>{{ number_format($totals['sum_kcal'], 1) }}</td>
          <td>{{ number_format($totals['sum_proteins'], 1) }}</td>
          <td>{{ number_format($totals['sum_carbs'], 1) }}</td>
          <td>{{ number_format($totals['sum_fats'], 1) }}</td>
          <td>{{ number_format($totals['sum_fibre'], 1) }}</td>
        </tr>
      </table>                
       
    <h5 style="color:red; font-weight:bold">Total kcal:{{ number_format($suma_kcal, 1) }}</h5>
    @endif

    @if ( !$meals_planed->count() )
      <h4 style="font-weight:bold">Planed: -</h4><br/>
      
    @else
      <h4 style="font-weight:bold">Planed:</h4>

      <?php $suma_kcal = 0; ?>
        <table class="table table-bordered">
          <tr>
            <th>Name</th><th>Weight</th><th>kcal</th><th>Protein</th><th>Carbohydrate</th><th>Fat</th><th>Fibre</th><th>Comment</th><th>Edit</th><th>Planed</th>
          </tr>
          @foreach( $meals_planed as $meal )
          <tr>
          <?php 
            $name = $meal->food->name;
            $string = (strlen($name) > 15) ? substr($name,0,15).'...' : $name; ?>

            <th title="{{ $meal->food->name }}">{{ $string}}</th>
            <td>{{ $meal->weight }}g</td>
            <td>{{ number_format(($meal->weight * $meal->kcal / 100), 1 ) }}</td>
            <td>{{ number_format(($meal->weight * $meal->proteins / 100), 1) }}</td>
            <td>{{ number_format(($meal->weight * $meal->carbs / 100), 1) }}</td>
            <td>{{ number_format(($meal->weight * $meal->fats / 100), 1) }}</td>
            <td>{{ number_format(($meal->weight * $meal->fibre / 100), 1) }} </td>
            <td class="tdCenter"><i class="fa fa-comment" title="{{ $meal->comment }}"></i></td>
            <td class="tdCenter"><a href="{{ url('meal/edit/'.$meal->meal_id)}}"><i class="fa fa-pencil"></i> </a></td>
            <td class="tdCenter">@if($meal->planed_food==1)<i class="fa fa-flag" data-meal-id="{{ $meal->meal_id }}"></i>@endif</td>
          </tr>
          <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
         @endforeach
          <tr class="total-row">
            <th class="tdCenter">Total : </th>
            <td>{{ $totals_planed['sum_weight'] }}g </td>
            <td>{{ number_format($totals_planed['sum_kcal'], 1) }}</td>
            <td>{{ number_format($totals_planed['sum_proteins'], 1) }}</td>
            <td>{{ number_format($totals_planed['sum_carbs'], 1) }}</td>
            <td>{{ number_format($totals_planed['sum_fats'], 1) }}</td>
            <td>{{ number_format($totals_planed['sum_fibre'], 1) }}</td>
          </tr>
        </table>                
      <h5 style="color:red; font-weight:bold">Total kcal:{{ number_format($suma_kcal, 1) }}</h5>
      @endif
  </div> <!-- class="col-md-8" id='meals-content' -->
  <div class="col-md-5">
    <div class="row" id="calendar-controls">
      <div class="col-xs-3 col-md-1">
        <i class="fa fa-chevron-left fa-lg prev" id="prevMonth"></i>
      </div>
      <div class="col-xs-6 col-md-offset-1 col-md-8" id="calendar-month"> {{$now->format('F')}} {{$now->format('Y')}}</div>
      <div class="col-xs-3 col-md-1">
        <i class="fa fa-chevron-right fa-lg next" id="nextMonth"></i>
      </div>
    </div>
    <div class="row" id="calendar-container">
       <div class="col-xs-12 col-md-12" >
          {!!$calendar!!}
       </div>
    </div>
    
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalMeal">
     New meal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalMeal" tabindex="-1" role="dialog" aria-labelledby="modalMealLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalMealLabel">Add meal</h4>
          </div>
          <div class="modal-body">
            <div class = "row">
              <div class = "col-md-12">
                <form action = "/new-meal" method ="post" class="ajax form-horizontal">
                  <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
                  <input type = "hidden" value = "{{$today}}" name = "thisDay">
                  <input type = "hidden" value = "{{$now->day}}" name = 'day' id = "selectedDay"/>
                  <input type = "hidden" value = "{{$now->month}}" name = 'month' id = "selectedMonth"/>
                  <input type = "hidden" value = "{{$now->year}}" name = 'year' id = "selectedYear"/> 
                  <input required = "required" value = "{{$now->toDateString()}}" type = "hidden" name = "date" class = "form-control" />     
                  <div class="form-group">
                    <label class="col-sm-5 control-label">Select food:</label>
                    <div class="col-sm-7">
                      <select class="use-select2-food" name="food_id" placeholder='Select food'>
                        <option value=""></option>
                        @foreach ($foods as $food)
                          <option value="{{$food->id}}" >{{$food->name}}</option>
                        @endforeach 
                      </select>  
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-10 control-label">Planed </label>
                    <div class="col-sm-2">
                      <input type='checkbox' value="0" name="planed_food" class='planed_food' />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label">Weight (g)</label>
                    <div class="col-sm-7">
                      <input required="required" value="{{ old('weight') }}" placeholder="Enter weight (in grams)" type="text" name = "weight" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class ="col-sm-5 control-label">Comment</label>
                    <div class="col-sm-7">
                      <input value = "{{ old('comment') }}" placeholder="Enter comment" type="text" name="comment" class="form-control" />
                    </div>
                  </div>
                  @if($permissions->count())
                  <div class="form-group">
                    <label class="col-xs-5 control-label">Add as other user</label>
                    <div class="col-sm-7">
                      <select class="use-select2-addFoodForUser" name="user_id" placeholder='Select user'>
                      <option value=""></option>
                      @foreach ($permissions as $permission)
                        <option value="{{$permission->user[0]['id']}}" >{{$permission->user[0]['name']}}</option>
                      @endforeach
                     </select>
                    </div>
                  </div>
                  @endif
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="submit" name="save" class="btn btn-success" value="Save"/><a href="{{ url('food/new-food') }}"  class="btn btn-success" id="addNewFood"> + </a>
                    </div>
                  </div>
                </form>
              </div> <!-- col-md-12 -->
            </div> <!-- row -->
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>

  </div>
</div>          

@endsection
     