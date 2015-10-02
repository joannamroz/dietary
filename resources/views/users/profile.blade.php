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
			<div class = "col-md-3">
				<div style = " margin-bottom:20px; border:solid lightgrey 1px;padding:5px;border-radius:5px">
					<h4 style="text-align:center;font-weight:bold">Body Measurements</h4>
					<span>Your weight range</span><span style="float:right"> {{$userBMIrange}}</span><br/>
					<span>Height </span><span style="float:right">{{ $userHeight }} cm</span><br/>
					<span>Weight </span><span style="float:right">{{ $userWeight }} kg</span><br/>
					<span>Body Fat </span><span style="float:right">{{ $userBodyFat }} %</span>
					<p><strong><span>Your BMI is </span><span  class="{{ strtolower(str_replace(' ', '-',$userBMIrange))}}" style="float:right">{{ $userBMI.' ' }}<button id="showRanges"> <i class="fa fa-search"></i></button></span></strong></p> <br/>
					<div id="rangesInfo">
						<span>Starvation </span><span class="starvation" >Less - 16 </span><br/>
						<span>Emaciation </span><span class="emaciation">16,0–17,0 </span><br/>
						<span>Underweight </span><span class="underweight" >17–18,5 </span><br/>
						<span>Healthy </span><span class="healthy" >18,5–25,0 </span><br/>
						<span>Overweight </span><span class="overweight" >25,0–30,0 </span><br/>
						<span>First stage of obesity </span><span class="first-stage-of-obesity">30,0–35,0 </span><br/>
						<span>Second stage of obesity </span><span class="second-stage-of-obesity">35,0–40,0  </span><br/>
						<span>Second stage of obesity </span><span class="third-stage-of-obesity">40 - more  </span><br/>
					</div>	
				</div>
			</div>
		</div>	
		<div class = "row">
			<div class = "col-md-10">
				<table class = "table table-striped bodyMeasurement">
					<tr>
						<th>Date</th><th>Weight</th><th>Body fat %</th><th>Body water %</th><th>Muscle %</th><th>BMI</th><th>Internal fat %</th><th>Waist</th><th>Chest</th><th>Neck</th><th>Hips</th><th>Biceps</th><th>Bust</th><th>Thigh</th><th>Upper arm</th><th>Delete</th>	
					</tr>
					@foreach($userMeasure as $measure)
					<tr>
						<td>{{ date("d/m/Y", strtotime($measure->date)) }}</td>
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

			<div class = "col-md-2">
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
				    	<input value = "@if(!old('thig')){{$latest['thigh']}}@endif{{ old('thigh') }}" type = "text" name = "thigh" class ="form-control" />
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
		<h3>There is't measurements added by you! Add one!</h3>
		<button class = "btn" style = "float: right" id = "addMeasure">Add new measure</button><br/>
	@endif
	<div class = "col-md-3">
				<h4 style="text-align:center;font-weight:bold">Calculate BMI</h4>
				
 					<div class="form-group">
				  		<label class="col-sm-6 control-label">Weight (kg)</label>
			        	<div class="col-sm-6">
				    		<input required="required" value="{{ isset($userWeight) ? $userWeight : ""  }}" id="weightBMI" type="text" name="weight" class="form-control" />
				    	</div>
				  	</div>
				  	<div class="form-group">
				  		<label class="col-sm-6 control-label">Height (cm)</label>
			        	<div class="col-sm-6">
				    		<input required="required" value="{{ isset($userHeight) ? $userHeight : "" }}" id="heightBMI" type="text" name="height" class="form-control" />
				    	</div>
				  	</div>
				  	<div class="form-group" id="resultInputBMI">
				  		<label class="col-sm-6 control-label">Result</label>
			        	<div class="col-sm-6">
				    		<input  value="" type="text" id="resultBMI" name="result" class="form-control" />
				    	</div>
				  	</div>
				  	<div class="form-group">
				  		<label class="col-sm-6 control-label"></label>
					    <div class="col-sm-offset-6 col-sm-6">
					      <input type="submit" name='save' class="btn btn-success" id="calculateBMIBtn" value="Calculate"/>
					    </div>
				  </div>	
			</div>
			<div class="col-md-6">
				<h4 style="text-align:center;font-weight:bold">Calculate BMR</h4>
						<div class="form-group">
					  		<label class="col-sm-3 control-label">Sex</label>
					  		<div class = "col-sm-3">
						  		<select class="select2 form-control" name="sexBMR" id="sexBMR">
						  			<option value=""></option>
						  			<option value="female" @if($userData->sex == "female") selected=selected @endif>Female</option>
						  			<option value="male" @if($userData->sex == "male") selected=selected @endif>Male</option>
						  		</select>
						  	</div>
					  	</div>
					  	
						<div class="form-group">
					  		<label class="col-sm-3 control-label">Weight (kg)</label>
				        	<div class="col-sm-3">
					    		<input required="required" value="{{ isset($userWeight) ? $userWeight : ""  }}" id="weightBMR" type="text" name="weight" class="form-control" />
					    	</div>
					  	</div>

					  	<div class="form-group">
					  		<label class="col-sm-3 control-label">Height (cm)</label>
				        	<div class="col-sm-3">
					    		<input required="required" value="{{ isset($userHeight) ? $userHeight : "" }}" id="heightBMR" type="text" name="height" class="form-control" />
					    	</div>
					  	</div>
					  
					  	<div class="form-group">
					  		<label class="col-sm-3 control-label">Age</label>
				        	<div class="col-sm-3">
					    		<input required="required" value="{{ isset($age) ? $age : "" }}" id="ageBMR" type="text" name="age" class="form-control" />
					    	</div>
					  	</div>

					  	<div class="form-group">
					  		<label class="col-sm-3 control-label">Activity</label>
					  		<div class = "col-sm-9">
						  		<select class="select2 form-control" name="activityBMR" id="activityBMR">
						  			<option value=""></option>
						  			<option value="1.2">Little or no exercise</option>
						  			<option value="1.375">Light exercise (1-3 times/week)</option>
						  			<option value="1.55">Moderate exercise (3-5 days/week)</option>
						  			<option value="1.725">Heavy exercise (6-7 days/week)</option>
						  			<option value="1.9">Very heavy exercise (physical job or exercise twice a day)</option>
						  		</select>
						  	</div>
					  	</div>

					  	<div class="form-group" id="resultInputBMR">
					  		<label class="col-sm-9 control-label">Result</label>
				        	<div class="col-sm-3">
					    		<input  value="" type="text" id="resultBMR" name="result" class="form-control" />
					    	</div>
					  	</div>
					  	<div class="form-group">
					  		<label class="col-sm-6 control-label"></label>
						    <div class="col-sm-offset-6 col-sm-6">
						      <input type="submit" name='save' class="btn btn-success" id="calculateBMRBtn" value="Calculate"/>
						    </div>
					  </div>	
			</div>
	</div>
</div>
		
@endsection