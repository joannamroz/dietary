@extends('app')


@section('content')
<!-- Training template -->

	<h3> Add New Training Template</h3>

	<form action="/new-training-template" method="post" class='ajax-training' >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label class="col-sm-4 control-label">Name</label>
          <div class="col-sm-7">
            <input value="{{ old('name') }}" required="required" type ="text" name ="name" class="form-control" />

            <input type="hidden" value id='training_template_id' name='id'>
          </div>  
        </div>
        <div class="form-group">
          <div class="col-sm-1">
            <input type="submit" name='save' class="btn" value="Save"/>
          </div>
        </div>
    </form>

<!-- <h4> Name </h4>
<input id='name' placeholder='Name' type='text' />
<input id='id' type='hidden' value='12'/>
<button class='btn btn-success saveTraining'> Save </button>

<hr> -->

<div> 
	<h4>Exercises </h4>

	<div id='exercises-container'> 

	</div>
		<span class='btn btn-default' id='add-exercise'> Add Exercise </span>
	<!-- <select> 
		<option> przysiad </option>
		<option> pompka </option>
	</select>
	<input type='text' placeholder='series' />
	<input type='text' placeholder='reps' />    <button class='btn btn-success addExerciseToTraining'> +  </button> -->

</div>

<script>



</script>


@endsection