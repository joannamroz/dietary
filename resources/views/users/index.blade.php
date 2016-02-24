@extends('app')

@section('content')

@if ( !$users->count() )
  We don't have users yet!
@else

<div class="row">
  <div class="col-md-10">
    <div class="panel panel-success">
      <div class="panel-heading">
          <h3 class="panel-title">Users</h3>
      </div>
      <div class="panel-body">
        <div class="scrollable scrollbar-macosx">
          <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
            <thead>
              <tr>
              	<th>Nr </th>
                <th>Name </th>
                <th>Email</th>  
                <th>Permissions</th>  
                <th>View profile</th>    
              </tr>
            </thead>
            <?php $nr=1; ?>
           
            @foreach( $users as $user )
            <tr>
              <td>{{ $nr }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td><a href="{{ url('permission/add-permission/'.$user->id)}}" ><i class="fa fa-lock fa-lg"></i> </a></td>
              <td><a href="{{ url('meal/user_meal/'.$user->id)}}" ><i class="fa fa-eye fa-lg"></i></a> </td> 
            </tr>
            <?php  $nr+=1;?>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
  	
  </div>
</div>
@endif

@endsection
