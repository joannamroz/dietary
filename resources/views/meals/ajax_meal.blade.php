@if ( !$meals->count() )
  <span style = "font-size:19px;font-weight:bold">There is no meals for {{ $selectedDate }}</span>
  <br/>
 
@else

  <span style = "font-size:19px; font-weight:bold">Meals for {{ $selectedDate }}</span>
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

            <th title = "{{ $meal->food->name }}">{{ $string }}</th>
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
            <th class = "tdCenter">Total:</th>
            <td>{{ $totals['sum_weight'] }}g</td>
            <td>{{ $totals['sum_kcal'] }}</td>
            <td>{{ $totals['sum_proteins'] }}</td>
            <td>{{ $totals['sum_carbs'] }}</td>
            <td>{{ $totals['sum_fats'] }}</td>
            <td>{{ $totals['sum_fibre'] }}</td>
            <td></td>
            <td></td>
          </tr>

        </table>                
      </div>
  </div>
<h4 style = "float:right; color:red; font-weight:bold">Total kcal:{{ $suma_kcal }}</h4>
@endif

@if ( !$meals_planed->count() )
  <span style = "font-size:19px;font-weight:bold">There is no meals planed for {{ $selectedDate }}</span>
  <br/>

@else

  <span style = "font-size:19px;font-weight:bold">Meals planed for {{ $selectedDate }}</span>
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

            <th title = "{{ $meal->food->name }}">{{ $string }}</th>
            <td>{{ $meal->weight }}g</td>
            <td>{{ $meal->weight * $meal->kcal / 100}}</td>
            <td>{{ $meal->weight * $meal->proteins / 100 }}</td>
            <td>{{ $meal->weight * $meal->carbs / 100 }}</td>
            <td>{{ $meal->weight * $meal->fats / 100 }}</td>
            <td>{{ $meal->weight * $meal->fibre / 100 }} </td>
            <td class = "tdCenter"><i class = "fa fa-comment" title = "{{ $meal->comment }}"></i></td>
            <td class = "tdCenter"><a href = "{{ url('meal/edit/'.$meal->meal_id)}}"><i class = "fa fa-pencil"></i> </a></td>
            <td class = "tdCenter">@if($meal->planed_food==1)<i class="fa fa-flag" data-meal-id = "{{ $meal->meal_id }}"></i>@endif</td>
            
          </tr>
          <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
         @endforeach

          <tr>
            <th class = "tdCenter">Total:</th>
            <td>{{ $totals_planed['sum_weight'] }}g</td>
            <td>{{ $totals_planed['sum_kcal'] }}</td>
            <td>{{ $totals_planed['sum_proteins'] }}</td>
            <td>{{ $totals_planed['sum_carbs'] }}</td>
            <td>{{ $totals_planed['sum_fats'] }}</td>
            <td>{{ $totals_planed['sum_fibre'] }}</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

        </table>                
      </div>
  </div>
<h4 style = "float:right; color:red; font-weight:bold">Total kcal:{{ $suma_kcal }}</h4>
@endif