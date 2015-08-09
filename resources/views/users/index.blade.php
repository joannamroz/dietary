@extends('app')

@section('title')
{{$title}}
@endsection

@section('content')

@if ( !$users->count() )
We don't have users yet!:D:D:D
@else
<div class="row">
  <div class="col-md-6">   
    <div class="list-group">
      <div class="list-group-item">
      <table class="table table-bordered">
       <tr>
       	 <th>Nr </th>
         <th>Name </th>
         <th>Email</th>  
         <th>Permissions</th>      
        
       </tr>
       <?php $nr=1; ?>
       
       @foreach( $users as $user )
       <tr>
         <td>{{ $nr }}</td>
         <td>{{ $user->name }}</td>
         <td>{{ $user->email }}  </td>

         <td><a href="{{ url('permission/add-permission/'.$user->id)}}" ><i class="fa fa-lock fa-lg"></i> </td>
          
          <!-- <td>
          	<label class="radio-inline">
  				<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Read
			</label>
		  </td>
		  <td>
			<label class="radio-inline">
  				<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Write
			</label>
		  </td> -->
         
       </tr>
       <!-- <tr>
            <td></td>
        	<td colspan = '2'>
        		
			</td>
        </tr> -->
       <?php  $nr+=1;?>
      @endforeach
      </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
  	
  </div>
</div>
@endif
<!--   -->
@endsection
