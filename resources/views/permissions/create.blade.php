@extends('app')

@section('content')

<div class="row">
  <div class="col-md-6">
  	<div class="panel panel-success">
  		<div class="panel-heading">
  			@if($userReadPermission == 1) 
  			<h3 class="panel-title"><span style="font-weight:bold; color:red">{{$userData->name }}</span> has permission to read
  				@if($userWritePermission==1)
 	  				and write 
 	  			@endif
 	  				your positions
  			</h3>
  			@endif
  			<h3 class="panel-title">* add or change permissions for : <span style="color:red"> {{ $userData->name }} </span></h3>
  		</div>
  		<div class="panel-body">
  			<form action="/add-permission" method="post" class="form-inline" id="permissionsForm">
			  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			    <input type="hidden" name="user_id" value="{{ $user_id }}">
					<label class="checkbox-inline">
						<input type="checkbox" name="check_list[]" value="read_permission" @if( $userReadPermission == 1) checked=checked @endif>Read
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" name="check_list[]" value="write_permission" @if( $userWritePermission == 1) checked=checked @endif>Write
					</label>
					<label class="checkbox-inline">
						<input type="submit" name='save' class="btn btn-success" value="Save"/>
					</label>
			  </form> 
			 	</br>
			 	<div>
					<span><strong>Read</strong> -giving permission to view your foods and meals positions.</span></br>
					<span><strong>Write</strong> - giving permission to add/change your foods and meals positions.</span>
  			</div>
  		</div>	
  	</div>
  </div>
</div>

@endsection
 