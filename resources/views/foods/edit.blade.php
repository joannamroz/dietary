@extends('app')

@section('content')
<div class="row">
  <div class="col-md-6" >
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <h3 class="panel-title"> Edit </h3> 
      </div>
      <div class="panel-body">
        <form method="post" action='{{ url("food/update") }}' class='form-horizontal'>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="food_id" value="{{ $food->id }}{{ old('food_id') }}">

          <div class="form-group">
            <label class="col-sm-4 control-label">Food name</label>
            <div class="col-sm-8">
              <input required="required"  value="@if(!old('name')){{$food->name}}@endif{{ old('name') }}" type="text" name="name" class="form-control" />
            </div>
          </div>

          <div class="simple_food">
            <div class="form-group ">
              <label class="col-sm-4 control-label">Select brand from list</label>
              <div class="col-sm-8">
                <select class=" use-select2 form-control" name="brand">
                  <option value=""></option>
                  @foreach ($brands as $brand)   
                  <option value="{{ $brand->id}}" @if( $food->brand_id == $brand->id ) {{ 'selected=selected' }} @endif >{{$brand->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-4 control-label">Kcal in 100 grams</label>
            <div class="col-sm-8">
             <input required="required" type="text" name="kcal" class="form-control" value="@if(!old('kcal')){{$food->kcal}}@endif{{ old('kcal') }}"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-4 control-label">Proteins in 100 grams</label>
            <div class="col-sm-8">
             <input required="required"  type="text" name="proteins" class="form-control" value="@if(!old('proteins')){{$food->proteins}}@endif{{ old('proteins') }}"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-4 control-label">Carbohydrates in 100 grams</label>
            <div class="col-sm-8">
              <input required="required" type="text" name="carbs" class="form-control" value="@if(!old('carbs')){{$food->carbs}}@endif{{ old('carbs') }}"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-4 control-label">Fats in 100 grams</label>
            <div class="col-sm-8">
              <input required="required" type="text" name="fats" class="form-control" value="@if(!old('fats')){{$food->fats}}@endif{{ old('fats') }}"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Fibre in 100 grams</label>
            <div class="col-sm-8">
              <input required="required" type="text" name="fibre" class="form-control" value="@if(!old('fibre')){{$food->fibre}}@endif{{ old('fibre') }}"/>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <input type="submit" name='save' class="btn btn-success" value="Save"/>
              <a href="{{  url('food/delete/'.$food->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
