@extends('app')

@section('title')
Add New Brand Position
@endsection

@section('content')
<div class = "row">
  <div class = "col-md-6" >
	<form action = "/new-brand" method = "post" class = "form-horizontal">
	  <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
	  <div class = "form-group">
	    <label class = "col-sm-4 control-label">Brand name</label>
	    <div class = "col-sm-8">
	      <input required = "required" value = "{{ old('name') }}" type = "text" name = "name" class = "form-control" />
	    </div>
	  </div>
	  <div class = "form-group">
	    <div class = "col-sm-offset-4 col-sm-8">
	      <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/>
	    </div>
	  </div>
	</form>
  </div>
</div>
@endsection