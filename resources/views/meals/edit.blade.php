@extends('app')

@section('title')
Edit meal
@endsection

@section('content')


<form method = "post" action = '{{ url("meal/update") }}' id = "editMealForm" class = "form-horizontal">
  <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
  <input type = "hidden" name = "meal_id" value = "{{ $meal->id }}{{ old('meal_id') }}">
  <input type = "hidden" name = "planed_food" value = "{{ $meal->planed }}{{ old('planed_food') }}">
  <input required="required"  type="hidden" name = "date" class = "form-control" value = "@if(!old('date')){{$meal->date}}@endif{{ old('date') }}"/>

  <div class = "form-group noMarginBottom">
   <label class = "col-sm-2 control-label">Select food from list:</label>
    <div class = "col-sm-10">
      <select class = "select2" name = "food_id">
       
        @foreach ($foods as $food) 
        <option value = "{{ $food->id }}" @if( $meal->food_id == $food->id ) {{ 'selected=selected' }} @endif >{{$food->name}}</option>
        @endforeach
     
      </select>
    </div>
  </div>
  <div class = "form-group noMarginBottom">
    <label class = "col-sm-2 control-label">Weight (g)</label>
     <div class = "col-sm-10">
        <input required = "required"  type = "text" name = "weight" class = "form-control" value = "@if(!old('weight')){{$meal->weight}}@endif{{ old('weight') }}"/>
      </div>
  </div> 
  <div class = "form-group">
    <label class = "col-sm-2 control-label">Comment</label>
     <div class = "col-sm-10">
        <input type = "text" name = "comment" class = "form-control" value = "@if(!old('comment')){{$meal->comment}}@endif{{ old('comment') }}"/>
    </div>
  </div>
  <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/>
  <a href = "{{  url('meal/delete/'.$meal->id.'?_token='.csrf_token()) }}" class = "btn btn-danger">Delete</a>
  <a href = "{{ url('food/new-food') }}"  class = "btn btn-success" id = "addNewFood"> + </a>
</form>
@endsection
