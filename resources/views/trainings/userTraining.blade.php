@extends('app')

@section('title')
@endsection

@section('content')

<div class="row">
	<div class="col-md-6">
		<h2>Yours last added trainings</h2>

		@foreach ($trainings as $training)

			@if(count($training->exercises)) 
			<table class="table table-bordered">
				<caption><p>{{ $training->name }}</p></caption>
				<tr>
					<th>Exercise name</th>
					<th>Repeats</th>
					<th>Series</th>
				</tr>
			    @foreach ($training->exercises as $value) 
			    <tr>
			    	<td>{{ $value->name }}</td>
			    	<td>{{ $value->pivot->num_of_exercises }}</td>
			    	<td>{{ $value->pivot->num_of_series }}</td>
			    </tr>
			    @endforeach
			</table>
			@endif
		@endforeach
	</div>
	<div class="col-md-6">
		<!-- <h3>Planed trenings</h3> -->
		<div class="col-md-12"></div>
		<h4>Add future training</h4>
		<div class="col-md-12">
			<form action="/future-training" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="form-group">
	              <label class="col-sm-4 control-label">Select training</label>
	              <div class="col-sm-8">
	                <select class="use-select2 form-control"  id="trainingSelect" required="required" name="training">
	                 <option value="" disabled selected style="display:none;"></option>
	                  @foreach ($trainings as $training)
	                  <?php $json_exercises = json_encode($training->exercises); ?>
	                  <option value="{{$training->id}}" data-exercises="{{ $json_exercises }}" >{{$training->name}}</option>
	                  @endforeach
	                </select>
	              </div>
	              <div id="listExercise"></div>
	              <div class="form-group">
	              	<label  class="col-sm-4 control-label">Select date</label>
	              	<div class="col-sm-8">
    					<input type="date" name="date" class="form-control" value="{{ old('date') }}">
    				</div>
	              </div>
	              <div class="form-group">
	              	<label  class="col-sm-4 control-label">Finished?</label>
	              	<div class="col-sm-8">
    					<input type="checkbox" name="done" class="form-control" value="{{ old('done') }}">
    				</div>
	              </div>
	              <div class="form-group">
		              <div class="col-sm-1">
		                <input type="submit" name='save' class="btn" value="Save"/>
		              </div>
		           </div>
	            </div>
			</form>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered">
				<tr>
					<th>Nazwa</th>
					<th>Date</th>
					<th>Done</th>
				</tr>
			
				@foreach ($activities as $activity) 	
					<tr>
						<td>{{ $activity->training->name }}</td>
						<td>{{ $activity->date }}</td>
						<td>{{ $activity->done }}</td>
					
					</tr>
					
				@endforeach
			</table>

		</div>

	</div>
</div>

@endsection