@extends('app')

@section('content')


<div class="row need-meals-data">
  <div class="col-md-6" >
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Add new food position: </h3>
      </div>
      <div class="panel-body">
        <form action="/new-food" method="post" class='form-horizontal'>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label class="col-sm-4 control-label">Food name</label>
            <div class="col-sm-8">
              <input required="required" value="{{ old('name') }}" type="text" name="name" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <div class="checkbox">
               <label>
                <input type='checkbox' value='1' name="compound_food" id='compound_food'  /> Compound Food
               </label>
              </div>
            </div>
          </div>

          <div class="simple_food">
            <div class="form-group ">
              <label class="col-sm-4 control-label">Select brand from list</label>
              <div class="col-sm-8">
                <select class=" use-select2 form-control" name="brand">
                	<option value=""></option>
                	@foreach ($brands as $brand)
            		  <option value="{{$brand->id}}">{{$brand->name}}</option>
            		  @endforeach
            	  </select>
              </div>
            </div>
         
            <div class="form-group">
              <label class="col-sm-4 control-label">Kcal in 100 grams</label>
              <div class="col-sm-8">
                <input required="required" value="{{ old('kcal') }}" type="text" name="kcal" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">Proteins in 100 grams</label>
               <div class="col-sm-8">
                <input required="required" value="{{ old('proteins') }}" type="text" name="proteins" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">Carbohydrates in 100 grams</label>
               <div class="col-sm-8">
                <input required="required" value="{{ old('carbs') }}" type="text" name="carbs" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label">Fats in 100 grams</label>
              <div class="col-sm-8">
                <input required="required" value="{{ old('fats') }}" type="text" name="fats" class="form-control" />
              </div>
            </div>

            <div class="form-group">
             <label class="col-sm-4 control-label">Fibre in 100 grams</label>
             <div class="col-sm-8">
              <input required="required" value="{{ old('fibre') }}" type="text" name="fibre" class="form-control" />
             </div>
            </div>

          </div> <!-- simple_food -->

         <div class='compound_food' style="display:none">
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
                <span id='add-ingredient' class="btn btn-info" onload='loadMeals()'> + Add Ingredient </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <input type="submit" name='save' class="btn btn-success" value="Save"/>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div> <!-- col-md-6 -->

  <div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Ingredients: </h3>
      </div>
      <div class="panel-body">
        <div id="divForTable"></div>
      </div>
    </div>
  </div>
</div>
@endsection