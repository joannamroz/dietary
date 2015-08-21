@extends('app')

@section('title')
Edit Brand
@endsection

@section('content')

<div class = "row">
  <div class = "col-md-6" >
	<form method = "post" action = '{{ url("brand/update") }}' class = "form-horizontal">
	  <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
	  <input type = "hidden" name = "brand_id" value = "{{ $brand->id }}{{ old('brand_id') }}">
	  <div class = "form-group">
	  	<label class = "col-sm-4 control-label">Brand name</label>
	    <div class = "col-sm-8">
	    	<input required = "required" type = "text" name = "name" class = "form-control" value = "@if(!old('name')){{$brand->name}}@endif{{ old('name') }}"/>
	 	</div>
	  </div>
	  <div class = "form-group">
        <div class = "col-sm-offset-4 col-sm-8">
          <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/>
          <a href = "{{  url('brand/delete/'.$brand->id.'?_token='.csrf_token()) }}" class = "btn btn-danger">Delete</a>
        </div>
      </div>
	</form>
  </div>
</div>
@endsection
