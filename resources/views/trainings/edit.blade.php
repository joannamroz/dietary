@extends('app')

@section('title')
<h3>Edit this training</h3>
@endsection

@section('content')

<div class="row">
  <div class="col-md-6" >
	<form method="post" action='{{ url("training/update") }}' class="form-horizontal">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <input type="hidden" name="training_id" value="{{ $training->id }}{{ old('training_id') }}">
	  <div class="form-group">
	  	<label class="col-sm-3 control-label">Training name</label>
	    <div class="col-sm-9">
	    	<input required="required" type="text" name="name" class="form-control" value="@if(!old('name')){{$training->name}}@endif{{ old('name') }}"/>
	 	</div>
	  </div>
	  <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <input type="submit" name='save' class="btn btn-success" value="Save"/>
          <a href="{{  url('training/delete/'.$training->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
        </div>
      </div>

	</form>
  </div>
</div>
@endsection
