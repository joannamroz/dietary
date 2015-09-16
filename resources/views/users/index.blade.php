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
         <th>View profile</th>    
        
       </tr>
       <?php $nr=1; ?>
       
       @foreach( $users as $user )
       <tr>
         <td>{{ $nr }}</td>
         <td>{{ $user->name }}</td>
         <td>{{ $user->email }}  </td>

         <td><a href="{{ url('permission/add-permission/'.$user->id)}}" ><i class="fa fa-lock fa-lg"></i> </td>
         <td><a href="{{ url('meal/user_meal/'.$user->id)}}" ><i class="fa fa-eye fa-lg"></i> </td>
          
         
       </tr>
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
