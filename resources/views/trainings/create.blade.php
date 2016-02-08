@extends('app')


@section('content')
<!-- Training template -->
<div class="row">
	<div class="col-md-7">
		<h3> Add New Training Template</h3>

		<form action="/new-training-template" method="post" class='ajax-training' >
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <div class="form-group">
		      <label class="col-sm-3 control-label">Name</label>
		      <div class="col-sm-7">
		        <input value="{{ old('name') }}" required="required" type ="text" name ="name" class="form-control" />

		        <input type="hidden" value id='training_template_id' name='id'>
		      </div>  
		    </div>
		    <div class="form-group">
		      <div class="col-sm-2">
		        <input type="submit" name='save' class="btn" value="Save"/>
		      </div>
		    </div>
		</form>
	</div>
	<div class="col-md-7">

		
		<h3>Exercises </h3>

		<div id='exercises-container'> 
			<form action="/new-training-template" method="post" class='ajax-training' >
		    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    	<div class="form-group">
		      	<label class="col-sm-6 control-label">Name</label>
		      	<label class="col-sm-2 control-label">Series</label>
		      	<label class="col-sm-2 control-label">Repeats</label>
		      	<label class="col-sm-2 control-label">Time</label>
		      </div> 
		      <div class="form-group">
			      <div class="col-sm-2">
			        <input type="submit" name='save' class="btn" value="Save"/>
			      </div>
			    </div>   
		   </form>

		</div>
		
		<span class='btn btn-default col-sm-2 col-sm-offset-10' id='add-exercise'> Add Exercise </span>

		
	</div>
</div>

<script>



</script>


@endsection