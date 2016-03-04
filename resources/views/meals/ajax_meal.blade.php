<div class='panel panel-success'>
  <div class='panel-heading'>
    <h3 class='panel-title'> Meals for {{ $date }} </h3>
  </div>

  <div class='panel-body'>

    @if ( !$meals->count() )
      <h3 class="panel-title">Consumed: - </h3><br/>
    @else
      <h3 class="panel-title">Consumed:</h3>

    <?php $suma_kcal = 0; ?>
    <div class="scrollable scrollbar-macosx">
      <table id="" class="table table_sortable {sortlist: [[0,0]]} table-meals" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Weight</th>
            <th>kcal</th>
            <th>Protein</th>
            <th>Carbohydrate</th>
            <th>Fat</th>
            <th>Fibre</th>
            <th>Comment</th>
            <th>Edit</th>
          </tr>
        </thead>
          
        @foreach( $meals as $meal )
        <tr>
        <?php 
          $name = $meal->food->name;
          $string = (strlen($name) > 15) ? substr($name,0,15).'...' : $name; ?>

          <td title="{{ $meal->food->name }}">{{$string}}</td>
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
          <td >Total : </td>
          <td>{{ $totals['sum_weight'] }}g </td>
          <td>{{ number_format($totals['sum_kcal'], 1) }}</td>
          <td>{{ number_format($totals['sum_proteins'], 1) }}</td>
          <td>{{ number_format($totals['sum_carbs'], 1) }}</td>
          <td>{{ number_format($totals['sum_fats'], 1) }}</td>
          <td>{{ number_format($totals['sum_fibre'], 1) }}</td>
          <td></td>
          <td></td>
        </tr>
      </table>                
    </div>     
    <!-- <h5 class="panel-title" style="color:#ed4949; text-align:right">Total kcal:{{ number_format($suma_kcal, 1) }}</h5> -->
    <div class="progress">
      <div role="progressbar" aria-valuenow="{{  number_format(($suma_kcal/$bmr*100), 1) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{  number_format(($suma_kcal/$bmr*100), 1) }}%; font-weight:bold" class="progress-bar progress-bar-danger progress-bar-striped active">Total kcal:{{ number_format($suma_kcal, 1) }}</div>
    </div>
  @endif

  @if ( !$meals_planed->count() )
    <h3 class="panel-title" style="margin-top:50px">Planed: - </h3><br/>
    
  @else
    <h3 class="panel-title" style="margin-top:50px">Planed:</h3>

    <?php $suma_kcal = 0; ?>
    <div class="scrollable scrollbar-macosx">
      <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
        <tr>
          <th>Name</th><th>Weight</th><th>kcal</th><th>Protein</th><th>Carbohydrate</th><th>Fat</th><th>Fibre</th><th>Comment</th><th>Edit</th><th>Planed</th>
        </tr>
        @foreach( $meals_planed as $meal )
        <tr>
        <?php 
          $name = $meal->food->name;
          $string = (strlen($name) > 15) ? substr($name,0,15).'...' : $name; ?>

          <td title="{{ $meal->food->name }}">{{ $string}}</td>
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
          <td>Total : </td>
          <td>{{ $totals_planed['sum_weight'] }}g </td>
          <td>{{ number_format($totals_planed['sum_kcal'], 1) }}</td>
          <td>{{ number_format($totals_planed['sum_proteins'], 1) }}</td>
          <td>{{ number_format($totals_planed['sum_carbs'], 1) }}</td>
          <td>{{ number_format($totals_planed['sum_fats'], 1) }}</td>
          <td>{{ number_format($totals_planed['sum_fibre'], 1) }}</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table> 
    </div>               
    <h5 class="panel-title" style="color:#ed4949; text-align:right">Total kcal:{{ number_format($suma_kcal, 1) }}</h5>

    @endif

    @include('trainings.training_done')
    
  </div>
</div>