<h3>Meals for {{ $selectedDate }}</h3>
@if ( !$meals->count() )
  <h4 style="font-weight:bold">Consumed: - </h4><br/>
 
@else

  <h4 style = "font-weight:bold">Consumed:</h4>
  <?php $suma_kcal = 0; ?>
    
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
        <td>{{ number_format(($meal->weight * $meal->kcal / 100), 1)}}</td>
        <td>{{ number_format(($meal->weight * $meal->proteins / 100), 1) }}</td>
        <td>{{ number_format(($meal->weight * $meal->carbs / 100), 1) }}</td>
        <td>{{ number_format(($meal->weight * $meal->fats / 100), 1) }}</td>
        <td>{{ number_format(($meal->weight * $meal->fibre / 100), 1) }} </td>
        <td class = "tdCenter"><i class = "fa fa-comment" title = "{{ $meal->comment }}"></i></td>
        <td class = "tdCenter"><a href = "{{ url('meal/edit/'.$meal->meal_id)}}"><i class = "fa fa-pencil"></i> </a></td>
          
      </tr>
      <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
     @endforeach

      <tr class="total-row">
        <th class = "tdCenter">Total:</th>
        <td>{{ $totals['sum_weight'] }}g</td>
        <td>{{ number_format($totals['sum_kcal'], 1) }}</td>
        <td>{{ number_format($totals['sum_proteins'], 1) }}</td>
        <td>{{ number_format($totals['sum_carbs'], 1) }}</td>
        <td>{{ number_format($totals['sum_fats'], 1) }}</td>
        <td>{{ number_format($totals['sum_fibre'], 1) }}</td>
      </tr>

    </table> 
  <h5 style="color:red; font-weight:bold">Total kcal:{{ number_format($suma_kcal, 1) }}</h5>               

@endif
<!-- if date is older we don't need to see planed food -->
@if ($now < $selectedDate) 
      
  @if ( !$meals_planed->count() )
    <h4 style="font-weight:bold">Planed: -</h4><br/>

  @else

  <h4 style="font-weight:bold">Planed:</h4>
  <?php $suma_kcal = 0; ?>
      
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
      <td>{{ $meal->weight * $meal->kcal / 100 }}</td>
      <td>{{ number_format(($meal->weight * $meal->proteins / 100), 1) }}</td>
      <td>{{ number_format(($meal->weight * $meal->carbs / 100), 1) }}</td>
      <td>{{ number_format(($meal->weight * $meal->fats / 100), 1) }}</td>
      <td>{{ number_format(($meal->weight * $meal->fibre / 100), 1) }} </td>
      <td class = "tdCenter"><i class = "fa fa-comment" title = "{{ $meal->comment }}"></i></td>
      <td class = "tdCenter"><a href = "{{ url('meal/edit/'.$meal->meal_id)}}"><i class = "fa fa-pencil"></i> </a></td>
      <td class = "tdCenter">@if($meal->planed_food==1)<i class="fa fa-flag" data-meal-id = "{{ $meal->meal_id }}"></i>@endif</td>
      
    </tr>
    <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
   @endforeach

    <tr class="total-row">
      <th class = "tdCenter">Total:</th>
      <td>{{ $totals_planed['sum_weight'] }}g</td>
      <td>{{ number_format($totals_planed['sum_kcal'], 1) }}</td>
      <td>{{ number_format($totals_planed['sum_proteins'], 1) }}</td>
      <td>{{ number_format($totals_planed['sum_carbs'], 1) }}</td>
      <td>{{ number_format($totals_planed['sum_fats'], 1) }}</td>
      <td>{{ number_format($totals_planed['sum_fibre'], 1) }}</td>   
    </tr>

  </table>                
  <h5 style="color:red; font-weight:bold">Total kcal:{{ number_format($suma_kcal, 1) }}</h5>
  @endif
          
@endif

