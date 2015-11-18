<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Add new measure
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Measurements</h4>
      </div>
      <div class="modal-body">
      	<div class = "row">
		<div class = "col-md-12">
			<form action = "/new-measure" method = "post" class = "form-horizontal">
			  <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">

			  <?php $fields = [
			  			['label'=> 'Weight (kg)', 'name' => 'weight', 'type' => 'text', 'value'=> '', 'required'=>'required'],
			  			['label'=> 'Height (cm)', 'name' => 'height', 'type' => 'text', 'value'=> '', 'required'=>'required'],
			  			['label'=> 'Body fat (%)', 'name' => 'body_fat', 'type' => 'text', 'value'=> '', 'required'=>'required'],
			  			['label'=> 'Body water (%)', 'name' => 'water', 'type' => 'text', 'value'=> '', 'required'=>'required'],
			  			['label'=> 'Muscle mass (%)', 'name' => 'muscle', 'type' => 'text', 'value'=> '', 'required'=>'required'],
			  			['label'=> 'BMI', 'name' => 'bmi', 'type' => 'text', 'value'=> '', 'required'=>'required'],
			  			['label'=> 'Internal fat (%)', 'name' => 'internal_fat', 'type' => 'text', 'value'=> '', 'required'=>'required'],
			  			['label'=> 'Waist (cm)', 'name' => 'waist', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Chest (cm)', 'name' => 'chest', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Neck (cm)', 'name' => 'neck', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Hips (cm)', 'name' => 'hips', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Biceps (cm)', 'name' => 'biceps', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Bust (cm)', 'name' => 'bust', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Thigh (cm)', 'name' => 'thigh', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Upper arm (cm)', 'name' => 'upper_arm', 'type' => 'text', 'value'=> '', 'required'=>''],
			  			['label'=> 'Comment', 'name' => 'comment', 'type' => 'text', 'value'=> '', 'required'=>'']

			  		];
			  		//- temporarly we use only now, at some point we will let user pick the date
					$now = new \DateTime(); 

			  	?>
				@foreach($fields as $field)
				<div class="form-group">
					<label class="col-sm-7 control-label"> {{ $field['label'] }}</label>
				<div class = "col-sm-5">
					<input value="{{ $field['value'] }}" type="{{ $field['type'] }}" name="{{ $field['name'] }}" class="form-control" />
				</div>
				</div>
				@endforeach

			  <div class = "form-group">
			    <input required = "required" value = "{{$now->format('Y-m-d')}}" type = "hidden" name = "date" class = "form-control" />
			  </div>

			  <div class = "form-group">
			    <div class = "col-sm-offset-7 col-sm-5">
			      <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/>
			    </div>
			  </div>
			</form>
			
		</div>
		</div> <!-- row -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>