@extends('app')
@section('title')
	
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3" style="margin-bottom:20px; border:solid lightgrey 1px; padding:5px; border-radius:5px">
				<h4 style="text-align:center; font-weight:bold">Body Measurements</h4>
				<span>Your weight range</span><span style="float:right; font-weight:bold"> {{ isset($userMeasure[0]) ? $userBMIrange : " - "  }}</span><br/>
				<span>Height </span><span style="float:right">{{ isset($userMeasure[0]) ? $userHeight : " - "  }}</span><br/>
				<span>Weight </span><span style="float:right">{{ isset($userMeasure[0]) ? $userWeight : " - "  }}</span><br/>
				<span>Body Fat </span><span style="float:right">{{ isset($userMeasure[0]) ? $userBodyFat : " - "  }}</span>
				<p><strong><span>Your BMI is </span><span  class="{{ isset($userMeasure[0]) ? strtolower(str_replace(' ', '-', $userBMIrange)) : "-"  }}" style="float:right">{{ isset($userMeasure[0]) ? $userBMI.' ' : " - " }}<button id="showRanges"> <i class="fa fa-search"></i></button></span></strong></p> <br/>
	
				<div id="rangesInfo">
					<span>Starvation </span><span class="starvation">Less - 16 </span><br/>
					<span>Emaciation </span><span class="emaciation">16,0–17,0 </span><br/>
					<span>Underweight </span><span class="underweight" >17–18,5 </span><br/>
					<span>Healthy </span><span class="healthy" >18,5–25,0 </span><br/>
					<span>Overweight </span><span class="overweight" >25,0–30,0 </span><br/>
					<span>First stage of obesity </span><span class="first-stage-of-obesity">30,0–35,0 </span><br/>
					<span>Second stage of obesity </span><span class="second-stage-of-obesity">35,0–40,0  </span><br/>
					<span>Second stage of obesity </span><span class="third-stage-of-obesity">40 - more  </span><br/>
				</div>	
			</div>
			<div class="col-md-3" style=" margin-bottom:20px; border:solid lightgrey 1px; padding:5px; border-radius:5px">
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
			<div class="col-md-6" style=" margin-bottom:20px; border:solid lightgrey 1px; padding:5px; border-radius:5px">
				<h4 style="text-align:center;font-weight:bold">Calculate BMR</h4>
				<div class="form-group">
		  		<label class="col-sm-3 control-label">Sex</label>
		  		<div class="col-sm-3">
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
		<div class="row">
			<div class="col-md-12">	
				@include('users.measurements_form', ['userData' => 'data'])
			</div>
		</div>
		@if( isset($userMeasureData[0]) )

			<?php  
				$now = new \DateTime(); 
				$measurementsInArray = $userMeasure->toArray();	
				$latest = $measurementsInArray[0];
				
			?>
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped bodyMeasurement">
						<tr>
							<th>Date</th><th>Weight</th><th>Body fat %</th><th>Body water %</th><th>Muscle %</th><th>BMI</th><th>Internal fat %</th><th>Waist</th><th>Chest</th><th>Neck</th><th>Hips</th><th>Biceps</th><th>Bust</th><th>Thigh</th><th>Upper arm</th><th>Delete</th>	
						</tr>
	
						@foreach($userMeasureData as $new_measure)
					
						<tr>
						
							<td class="{{ $new_measure['weight']}}">{{ $new_measure['weight'] }}</td>
							<td >{{ $new_measure['weight'] }}</td>	
							<td >{{ $new_measure['body_fat'] }}</td>
							<td >{{ $new_measure['water'] }}</td>
							<td >{{ $new_measure['muscle'] }}</td>
							<td >{{ $new_measure['bmi'] }}</td>
							<td >{{ $new_measure['internal_fat'] }}</td>
							<td >{{ $new_measure['waist'] }}</td>
							<td >{{ $new_measure['chest'] }}</td>
							<td >{{ $new_measure['neck'] }}</td>
							<td >{{ $new_measure['hips'] }}</td>
							<td >{{ $new_measure['biceps'] }}</td>
							<td >{{ $new_measure['bust'] }}</td>
							<td >{{ $new_measure['thigh'] }}</td>
							<td >{{ $new_measure['upper_arm'] }}</td>
							<td><a href="{{  url('measurement/delete/'.$new_measure['id'].'?_token='.csrf_token()) }}" >Delete</a></td>
						</tr>
						<tr>
							<th>Comment: </th>
							<td colspan='16'>{{ $new_measure['comment'] }}</td>
						</tr>						
						@endforeach
					</table>
				</div>	
			</div>
		</div>
		@endif
	</div>
</div>
		
@endsection