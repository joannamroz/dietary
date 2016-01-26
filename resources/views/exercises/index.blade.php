@extends('app')


@section('content')

@if ( !$exercises->count() )
  <h3>There is no exercises till now. Add one </h3>
@else
<a class="btn btn-danger" style="margin-bottom:1%; padding:15px" href="../training/userTraining">View your planed/finished trainings</a>
<div class="row">

  <div class="col-md-4" id="exercises_div">
  <h3>Exercises</h3>
    <table class="table table-bordered">
     <tr>
      <th>Exercise name</th>
      <th>How to do</th>
      <th>Edit</th>
     </tr>
    @foreach( $exercises as $exercise )
    <tr>
      <td>{{ $exercise->name }}</td>
      <td>{{ $exercise->description }}</td>
      <td><a href="{{ url('exercise/edit/'.$exercise->id)}}"><i class="fa fa-pencil"></i></a></td>
    </tr>
    @endforeach
    </table>   
@endif
    <button type="button" class="btn square-button" id="newExercise">+</button>
    <form action="/new-exercise" method="post" id="newExerciseForm">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label class="col-sm-5 control-label">Exercise name</label>
        <div class="col-sm-7">
          <input required="required" value="{{ old('name') }}" placeholder="Enter name" type ="text" name ="name" class="form-control" />
        </div>  
      </div>
      <div class="form-group">
        <label class="col-sm-5 control-label">Description</label>
        <div class="col-sm-7">
         <!--  <input required="required" value="{{ old('description') }}" placeholder="Enter name" type ="text" name ="description" class="form-control" /> -->
         <textarea name="description" rows="4" cols="50" class="form-control" value="{{ old('description') }}"></textarea><span class='remainingC'></span>
        </div>  
      </div>
      <div class="form-group">
        <div class="col-sm-1 col-sm-offset-9">
          <input type="submit" name='save' class="btn" value="Save"/>
        </div>
      </div>
    </form>
  </div>

  <div class="col-md-8" id="training_div">
    <h3>Add new training in 2 steps!</h3>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-2"><b>Step 1</b></div>
        <div class="col-md-10">
          <h4>Add new training</h4>
          <hr>
          <form action="/new-training" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-sm-4 control-label">Name</label>
              <div class="col-sm-8">
                <input value="{{ old('name') }}" required="required" type ="text" name ="name" class="form-control" />
              </div>  
            </div>
            <div class="form-group">
              <div class="col-sm-1">
                <input type="submit" name='save' class="btn" value="Save"/>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-2"><b>Step 2</b></div>
        <div class="col-md-10">
          <h4>Choose training and add exercise to it</h4>
          <hr>
          <form action="/new-exercise-training" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-sm-4 control-label">Select training</label>
              <div class="col-sm-8">
                <select class="use-select2 form-control"  required="required" name="training">
                  <!-- <option value=""></option> -->
                  @foreach ($trainings as $training)
                  <option value="{{$training->id}}" >{{$training->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Select exercise</label>
              <div class="col-sm-8">
                <select class="use-select2 form-control"  required="required" name="exercise[]" multiple="multiple">
                  <!-- <option value=""></option> -->
                  @foreach ($exercises as $exercise)
                  <option value="{{$exercise->id}}" >{{$exercise->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Series</label>
              <div class="col-sm-2 col-sm-offset-6">
                <input required="required" type ="text" value="3" name ="num_of_series" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Repeats</label>
              <div class="col-sm-2 col-sm-offset-6">
                <input required="required" type ="text" value="20" name ="num_of_exercises" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-1">
                <input type="submit" name='save' class="btn" value="Save"/>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-12">
          <h3>Trainings</h3>
          <table class="table table-bordered">
           <tr>
            <th>Training name</th>
            <th>Edit</th>
           </tr>
            @foreach( $trainings as $training )
            <tr>
              <td>{{ $training->name }}</td>
              <td><a href="{{ url('training/edit/'.$training->id)}}"><span class="glyphicon glyphicon-search"></span></a></td>
            </tr>
          @endforeach
          </table> 
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->


@endsection