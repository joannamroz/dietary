@extends('app')

@section('content')

@if ( !$exercises->count() )

  <h3>There is no exercises till now. Add one </h3>
@else
<a class="btn btn-danger" style="margin-bottom:1%; padding:15px" href="../training/userTraining">View your planed/finished trainings</a>
<div class="row">
  <div class="col-md-6" id="exercises_div">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Exercises</h3>
      </div>
      <div class="panel-body">
        <div class="scrollable scrollbar-macosx">
          <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Exercise name</th>
                <th>How to do</th>
                <th>Edit</th>
              </tr>
            </thead>
            @foreach( $exercises as $exercise )
            <tr>
              <td>{{ $exercise->name }}</td>
            <!--   <?php $description = wordwrap($exercise->description, 10, '\n',false); ?> -->
              <td>{{ $exercise->description}}</td>
              <td><a href="{{ url('exercise/edit/'.$exercise->id)}}"><i class="fa fa-pencil"></i></a></td>
            </tr>
            @endforeach
        </table>
      </div>
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
            <label class="col-sm-5 control-label">Time *</label>
            <div class="col-sm-7">
              <input type="checkbox" name="time" class="form-control">
            </div> 
            <span class="col-sm-12" style="color:red; font-size:10px">*Can you express this exercise only in units of time( i.e. 30 min)?</span> 
          </div>
          <div class="form-group">
            <div class="col-sm-1 col-sm-offset-9">
              <input type="submit" name='save' class="btn" value="Save"/>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Trainings</h3>
      </div>
      <div class="panel-body">
         <div class="scrollable scrollbar-macosx">
            <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Training name</th>
                  <th>Edit</th>
                </tr>
              </thead>
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