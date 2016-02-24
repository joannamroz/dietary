@extends('app')

@section('content')

<div class="row">
  <div class="col-md-8">
  	<div class="panel panel-info">
  		<div class="panel-heading"> 
  			<h3 class="panel-title"> Name : {{ $food->name}}</h3> 
  			<h5 style="color:#ed4949">Kcal:  {{ $food->kcal}} / 100g</h5>
  		</div>
  		<div class="panel-body">	
				<div class="scrollable scrollbar-macosx">
	        <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
	        	<thead>
							<tr>
								<th>Name</th><th>Brand</th><th>Weight</th><th>Kcal</th><th>Proteins</th><th>Carbs</th><th>Fats</th><th>Fibre</th>
							</tr>
						</thead>
						
						@if (!$food_ingredient->isEmpty())
							<?php 
							$totalWeight = 0;
							$totalKcal = 0;
							$totalProteins = 0;
							$totalCarbs = 0;
							$totalFats = 0;
							$totalFibre = 0;?>


							@foreach ($food_ingredient as $food_one)   
							<tr>
					  		<?php 
					  		$weight = $food_one->weight;
					  		$totalWeight += $weight;
					  		$kcal = $food_one->ingredient->kcal * $weight / 100;
					  		$totalKcal += $kcal;
					  		$proteins = $food_one->ingredient->proteins * $weight / 100;
					  		$totalProteins += $proteins;
					  		$carbs = $food_one->ingredient->carbs * $weight / 100;
					  		$totalCarbs += $carbs;
					  		$fats = $food_one->ingredient->fats * $weight / 100;
					  		$totalFats += $fats;
					  		$fibre = $food_one->ingredient->fibre * $weight / 100;
					  		$totalFibre += $fibre;
					  		?>
					  		<td>{{ $food_one->ingredient->name }}</td> <!-- 'ingredient' to metoda z modelu ingredients  -->
					  		<td>{{ $food_one->ingredient->brand->name}}</td>
					  		<td>{{ $weight }}g</td>
					  		<td>{{ $kcal }}</td>
					  		<td>{{ $proteins }}</td>
					  		<td>{{ $carbs }}</td>
					  		<td>{{ $fats }}</td>
					  		<td>{{ $fibre }}</td>  		
						  </tr>
							@endforeach
						
					  <tr class="total-row">
				  		<td>Total</td><td>{{$food->brand->name}}</td><td>{{ number_format($totalWeight, 1) }}</td><td>{{ number_format($totalKcal, 1) }}</td><td>{{ number_format($totalProteins, 1) }}</td><td>{{ number_format($totalCarbs, 1) }}</td><td>{{ number_format($totalFats, 1) }}</td><td>{{ number_format($totalFibre, 1) }}</td>
				  	</tr>
				  @else 
				  	<tr class="total-row">
				  		<td>Total</td><td>{{$food->brand->name}}</td><td>100</td><td>{{ number_format($food->kcal, 1) }}</td><td>{{ number_format($food->proteins, 1) }}</td><td>{{ number_format($food->carbs, 1) }}</td><td>{{ number_format($food->fats, 1) }}</td><td>{{ number_format($food->fibre, 1) }}</td>
				  	</tr>
				  @endif
					</table>
				</div>
			</div>
		</div>
  </div>          
</div>

@endsection
 