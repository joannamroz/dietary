@extends('app')

@section('title')
<h3>Edit this exercise</h3>
@endsection

@section('content')

<div class="row">
  <div class="col-md-6" >
	<form method="post" action='{{ url("exercise/update") }}' class="form-horizontal">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <input type="hidden" name="exercise_id" value="{{ $exercise->id }}{{ old('exercise_id') }}">
	  <div class="form-group">
	  	<label class="col-sm-3 control-label">Exercise name</label>
	    <div class="col-sm-9">
	    	<input required="required" type="text" name="name" class="form-control" value="@if(!old('name')){{$exercise->name}}@endif{{ old('name') }}"/>
	 	</div>
	  </div>
	  <div class="form-group">
        <label class="col-sm-3 control-label">Description</label>
        <div class="col-sm-9">
         <textarea name="description" rows="4" cols="50" class="form-control" >@if(!old('description')){{$exercise->description}}@endif{{ old('description') }}</textarea><span class='remainingC'></span>
        </div>  
      </div>
	  <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" name='save' class="btn btn-success" value="Save"/>
          <a href="{{  url('exercise/delete/'.$exercise->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
        </div>
      </div>

	</form>
  </div>
</div>
@endsection
