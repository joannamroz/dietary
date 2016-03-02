
@extends('app')

@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Meals for {{$now->format('d/m/Y')}}  ({{ $now->format('l') }})</h3>
      </div>
      <div class="panel-body">
 
        @if ( !$meals->count() )
          <h4 class="panel-title">Consumed: - </h4><br/>

        @else
          <h4 class="panel-title">Consumed:</h4>
          <?php $suma_kcal = 0; ?>
         
          <div class="scrollable scrollbar-macosx">
            <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
              <tr>
                <th>Name</th><th>Weight</th><th>kcal</th><th>Protein</th><th>Carbohydrate</th><th>Fat</th><th>Fibre</th><th>Comment</th><th>Edit</th>
              </tr>
              @foreach( $meals as $meal )
              <tr>
              <?php 
                $name = $meal->food->name;
                $string = (strlen($name) > 15) ? substr($name,0,15).'...' : $name; ?>

                <th title="{{ $meal->food->name }}">{{$string}}</th>
                <td>{{ number_format($meal->weight, 1) }}</td>
                <td>{{ number_format($meal->weight * $meal->kcal / 100, 1) }}</td>
                <td>{{ number_format($meal->weight * $meal->proteins / 100, 1) }}</td>
                <td>{{ number_format($meal->weight * $meal->carbs / 100, 1) }}</td>
                <td>{{ number_format($meal->weight * $meal->fats / 100, 1) }}</td>
                <td>{{ number_format($meal->weight * $meal->fibre / 100, 1) }} </td>
                <td class="tdCenter"><i class="fa fa-comment" title="{{ $meal->comment }}"></i></td>
                <td class="tdCenter"><a href="{{ url('meal/edit/'.$meal->meal_id)}}"><i class="fa fa-pencil"></i> </a></td>
                
              </tr>
              <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
              @endforeach

              <tr class="total-row">
                <td>Total : </td>
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

          <h5 class="panel-title" style="color:red">Total kcal:{{ number_format($suma_kcal, 1) }}</h5>  
        @endif 
      </div>
    </div>
  </div> <!-- class="col-md-12" ' -->
</div>
 
@endsection
 

