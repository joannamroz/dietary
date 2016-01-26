@extends('app')


@section('content')


<h3> Add New Training </h3>


<h4> Name </h4>
<input id='name' placeholder='Name' type='text' />
<input id='id' type='hidden' value='12'/>
<button class='btn btn-success saveTraining'> Save </button>

<hr>





<div> 
<h4>Exercises </h4>
	<select> 
		<option> przysiad </option>
		<option> pompka </option>
	</select>
	<input type='text' placeholder='series' />
	<input type='text' placeholder='reps' />    <button class='btn btn-success addExerciseToTraining'> +  </button>

</div>

<script>



</script>


@endsection