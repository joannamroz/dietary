@extends('app')
@section('title')
	
@endsection

@section('content')

<div class = "row">
	<div class = "col-md-12">

	@if( isset($userMeasure[0]) )

	<?php  
		$now = new \DateTime(); 
		$measurementsInArray = $userMeasure->toArray();
		$latest = $measurementsInArray[0];
	?>

		<div class = "row">
			<div class = "col-md-12">
				<div style = "width:50%; margin-bottom:20px; border:solid lightgrey 1px;padding:5px;border-radius:5px">
					<h4>Body Measurements</h4>
					<span>Height </span><span style="float:right">{{ $userHeight }} cm</span><br/>
					<span>Weight </span><span style="float:right">{{ $userWeight }} kg</span><br/>
					<span>Body Fat </span><span style="float:right">{{ $userBodyFat }} %</span>
				</div>
			</div>
		</div>
	
		<div class = "row">
			<div class = "col-md-9">
				<table class = "table table-striped bodyMeasurement">
					<tr>
						<th>Date</th><th>Weight</th><th>Body fat %</th><th>Body water %</th><th>Muscle %</th><th>BMI</th><th>Internal fat %</th><th>Waist</th><th>Chest</th><th>Neck</th><th>Hips</th><th>Biceps</th><th>Bust</th><th>Thigh</th><th>Upper arm</th><th>Delete</th>	
					</tr>
					@foreach($userMeasure as $measure)
					<tr>
						<td>{{ $measure->date }}</td>
						<td>{{ $measure->weight }}</td>	
						<td>{{ $measure->body_fat }}</td>
						<td>{{ $measure->water }}</td>
						<td>{{ $measure->muscle }}</td>
						<td>{{ $measure->bmi }}</td>
						<td>{{ $measure->internal_fat }}</td>
						<td>{{ $measure->waist }}</td>
						<td>{{ $measure->chest }}</td>
						<td>{{ $measure->neck }}</td>
						<td>{{ $measure->hips }}</td>
						<td>{{ $measure->biceps }}</td>
						<td>{{ $measure->bust }}</td>
						<td>{{ $measure->thigh }}</td>
						<td>{{ $measure->upper_arm }}</td>
						<td><a href = "{{  url('measurement/delete/'.$measure->id.'?_token='.csrf_token()) }}" >Delete</a></td>
					</tr>
					<tr>
						<th>Comment: </th>
						<td colspan = '16'>{{ $measure->comment }}</td>
					</tr>						
					@endforeach
				</table>	
				<button class = "btn" style = "float: right" id = "addMeasure">Add new measure</button><br/>
			</div>

			<div class = "col-md-3">
				<form action = "/new-measure" method = "post" id = "measureForm" class = "form-horizontal">
				  <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Weight (kg)</label>
			        <div class = "col-sm-5">
			         
				    	<input required = "required" value = "@if(!old('weight')){{$latest['weight']}}@endif{{ old('weight') }}" type = "text" name = "weight" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Height (cm)</label>
			        <div class = "col-sm-5">
				    	<input required = "required" value = "@if(!old('height')){{$latest['height']}}@endif{{ old('height') }}" type = "text" name = "height" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Body fat (%)</label>
			        <div class = "col-sm-5">
				    	<input required = "required" value = "@if(!old('body_fat')){{$latest['body_fat']}}@endif{{ old('body_fat') }}" type = "text" name = "body_fat" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Body water (%)</label>
			        <div class = "col-sm-5">
				    	<input required = "required" value = "@if(!old('water')){{$latest['water']}}@endif{{ old('water') }}" type = "text" name = "water" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Muscle (%)</label>
			        <div class = "col-sm-5">
				    	<input required = "required" value = "@if(!old('muscle')){{$latest['muscle']}}@endif{{ old('muscle') }}" type="text" name = "muscle" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">BMI</label>
			        <div class = "col-sm-5">
				    	<input required = "required" value = "@if(!old('bmi')){{ $latest['bmi']}}@endif{{ old('bmi') }}" type = "text" name = "bmi" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Internal fat (%)</label>
			        <div class = "col-sm-5">
				    	<input required = "required" value = "@if(!old('internal_fat')){{$latest['internal_fat']}}@endif{{ old('internal_fat') }}" type = "text" name = "internal_fat" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Waist (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('waist')){{$measurementsInArray[0]['waist']}}@endif{{ old('waist') }}" type = "text" name = "waist" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Chest (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('chest')){{$latest['chest']}}@endif{{ old('chest') }}" type = "text" name = "chest" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Neck (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('neck')){{$latest['neck']}}@endif{{ old('neck') }}" type = "text" name = "neck" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Hips (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('hips')){{$latest['hips']}}@endif{{ old('hips') }}" type = "text" name = "hips" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Biceps (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('biceps')){{$latest['biceps']}}@endif{{ old('biceps') }}" type = "text" name = "biceps" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Bust (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('bust')){{$latest['bust']}}@endif{{ old('bust') }}" type = "text" name = "bust" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Thigh (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('thig')){{$latest['thigh']}}@endif{{ old('thigh') }}" type = "text" name = "thigh" class ="form -control" />
				    </div>
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Upper arm (cm)</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('upper_arm')){{$latest['upper_arm']}}@endif{{ old('upper_arm') }}" type = "text" name = "upper_arm" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				    <input required = "required" value = "{{$now->format('Y-m-d')}}" type = "hidden" name = "date" class = "form-control" />
				  </div>

				  <div class = "form-group">
				  	<label class = "col-sm-7 control-label">Comment</label>
			        <div class = "col-sm-5">
				    	<input value = "@if(!old('comment')){{$latest['comment']}}@endif{{ old('comment') }}" type = "text" name = "comment" class = "form-control" />
				    </div>
				  </div>

				  <div class = "form-group">
				    <div class = "col-sm-offset-7 col-sm-5">
				      <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/>
				    </div>
				  </div>
				</form>
				
			</div>
		</div>
	@else
		There is't measurements added by you! Add one!
	@endif
	</div>
</div>
		
@endsection