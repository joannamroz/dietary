<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalMeal">
 New meal
</button>

<!-- Modal -->
<div class="modal fade" id="modalMeal"  role="dialog" aria-labelledby="modalMealLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalMealLabel">Add meal</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form action="/new-meal" method="post" class="ajax form-horizontal">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" value="{{$date}}" name="thisDay">
              <input type="hidden" value="{{$now->day}}" name='day' id="selectedDay"/>
              <input type="hidden" value="{{$now->month}}" name='month' id="selectedMonth"/>
              <input type="hidden" value="{{$now->year}}" name='year' id="selectedYear"/> 
              <input required="required" value="{{$now->toDateString()}}" type="hidden" name="date" class="form-control" />     
              <div class="form-group">
                <label class="col-sm-5 control-label">Select food:</label>
                <div class="col-sm-7">
                  <select class="use-select2-food" name="food_id" placeholder='Select food'>
                    <option value=""></option>
                    @foreach ($foods as $food)
                      <option value="{{$food->id}}" >{{$food->name}}</option>
                    @endforeach 
                  </select>  
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-5 control-label">Planed </label>
                <div class="col-sm-7">
                  <input type='checkbox' value="0" name="planed_food" class='planed_food' />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-5 control-label">Weight (g)</label>
                <div class="col-sm-7">
                  <input required="required" value="{{ old('weight') }}" placeholder="Enter weight (in grams)" type="text" name = "weight" class="form-control"/>
                </div>
              </div>
              <div class="form-group">
                <label class ="col-sm-5 control-label">Comment</label>
                <div class="col-sm-7">
                  <input value = "{{ old('comment') }}" placeholder="Enter comment" type="text" name="comment" class="form-control" />
                </div>
              </div>
              @if($permissions->count())
              <div class="form-group">
                <label class="col-xs-5 control-label">Add as other user</label>
                <div class="col-sm-7">
                  <select class="use-select2-addFoodForUser" name="user_id" placeholder='Select user'>
                  <option value=""></option>
                  @foreach ($permissions as $permission)
                    <option value="{{$permission->user[0]['id']}}" >{{$permission->user[0]['name']}}</option>
                  @endforeach
                 </select>
                </div>
              </div>
              @endif
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="submit" name="save" class="btn btn-success" value="Save"/><a href="{{ url('food/new-food') }}"  class="btn btn-success" id="addNewFood"> + </a>
                </div>
              </div>
            </form>
          </div> <!-- col-md-12 -->
        </div> <!-- row -->
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>