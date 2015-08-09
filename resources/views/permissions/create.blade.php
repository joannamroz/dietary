@extends('app')

@section('content')

 @if($userReadPermission == 1) 
 	<h3><span style="font-weight:bold; color:red">{{$userData->name }}</span> has permission to read
 	 @if($userWritePermission==1)
 	   and write 
 	  @endif
 	  your positions</h3>
@endif
<h5>* add or change permissions for {{$userData->name}}</h5>
<div class="row">
  <div class="col-md-8">
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
@endsection
 