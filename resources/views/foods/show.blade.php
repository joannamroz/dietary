@extends('app')

@section('content')

<div class = "row">
  <div class = "col-md-8">
  	<h4>Name : {{ $food->name}}</h4>
	<p>Kcal:  {{ $food->kcal}} / 100g</p>
	<table class = "table table bordered">
		<tr>
			<th>Name</th><th>Brand</th><th>Weight</th><th>Kcal</th><th>Proteins</th><th>Carbs</th><th>Fats</th><th>Fibre</th>
		</tr>
		
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
		
	  	<tr>
	  		<th>Total</th><td>-</td><td>{{ $totalWeight }}g</td><td>{{ $totalKcal }}</td><td>{{ $totalProteins }}</td><td>{{ $totalCarbs }}</td><td>{{ $totalFats }}</td><td>{{ $totalFibre }}</td>
	  	</tr>
	  </table>

	  	


	

  </div>          
</div>

@endsection
 