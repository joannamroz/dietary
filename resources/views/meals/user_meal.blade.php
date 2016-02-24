
@extends('app')
@section('title')
{{$title}}

@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <h3>Meals for {{$now->format('d')}} {{$now->format('F')}} {{$now->format('Y')}} </h3>
 
    @if ( !$meals->count() )
      <h4 style="font-weight:bold">Consumed: - </h4><br/>

    @else
      <h4 style="font-weight:bold">Consumed:</h4>
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

            <th title="{{ $meal->food->name }}">{{$string}}</th>
            <td>{{ $meal->weight }}g</td>
            <td>{{ $meal->weight * $meal->kcal / 100}}</td>
            <td>{{ $meal->weight * $meal->proteins / 100 }}</td>
            <td>{{ $meal->weight * $meal->carbs / 100 }}</td>
            <td>{{ $meal->weight * $meal->fats / 100 }}</td>
            <td>{{ $meal->weight * $meal->fibre / 100 }} </td>
            <td class="tdCenter"><i class="fa fa-comment" title="{{ $meal->comment }}"></i></td>
            <td class="tdCenter"><a href="{{ url('meal/edit/'.$meal->meal_id)}}"><i class="fa fa-pencil"></i> </a></td>
            
          </tr>
          <?php $suma_kcal += $meal->weight * $meal->food->kcal / 100; ?>
          @endforeach

          <tr>
            <th class="tdCenter">Total : </th>
            <td>{{ $totals['sum_weight'] }}g </td>
            <td>{{ $totals['sum_kcal'] }}</td>
            <td>{{ $totals['sum_proteins'] }}</td>
            <td>{{ $totals['sum_carbs'] }}</td>
            <td>{{ $totals['sum_fats'] }}</td>
            <td>{{ $totals['sum_fibre'] }}</td>
            <td></td>
           
          </tr>
        </table> 
      <h5 style="color:red; font-weight:bold">Total kcal:{{ number_format($suma_kcal, 1) }}</h5>               
    @endif

  </div> <!-- class="col-md-8" id='meals-content' -->
</div>
 
@endsection
 

