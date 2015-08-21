@extends('app')

@section('title')
Add New Meal
@endsection

@section('content')

<?php 
$now = new \DateTime();
?>
<form action = "/new-meal" method = "post">
  <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
  <div class = "form-group">Select food position from list:
    <select class = "select2" name = "food_id">
    	<option value = ""></option>
    	@foreach ($foods as $food)
		 <option value = "{{$food->id}}" >{{ $food->name}}</option>
		@endforeach
	 
	</select><a href = "{{ url('food/new-food') }}"> Add new food position </a>
  </div>
  <div class = "form-group">
    <input required = "required" value = "{{ old('weight') }}" placeholder = "Enter weight (in grams)" type = "text" name = "weight"class="form-control" />
  </div>
  <div class = "form-group">
    <input required = "required" value = "{{$now->format('Y-m-d')}}" type = "hidden" name = "date" class = "form-control" />
  </div>
  <div class = "form-group">
    <input value = "{{ old('comment') }}" placeholder = "Enter comment" type = "text" name = "comment" class = "form-control" />
  </div>
  <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/>
</form>
@endsection