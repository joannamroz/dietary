@extends('app')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <h3 class="panel-title"> Name : {{ $brand->name}}</h3> 
      </div>
      <div class="panel-body">  
        <div class="scrollable scrollbar-macosx">
          <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th><th>Kcal</th><th>Proteins</th><th>Carbs</th><th>Fats</th><th>Fibre</th><th>Edit</th>
              </tr>
            </thead>
            
          @foreach ($brand_foods as  $food) 
              <tr>
                <th>{{ $food->name }}</th>  
                <td title = "Popover title" ><div data-toggle="popover" data-title='' data-content="kcal from proteins {{$food->proteins * 4 }} kcal from carbs {{$food->carbs * 4 }} kcal from carbs {{$food->fats * 9 }} "> {{ $food->kcal }} </div></td>
                <td>{{ $food->proteins }}</td>
                <td>{{ $food->carbs }}</td>
                <td>{{ $food->fats  }}</td>
                <td>{{ $food->fibre }}</td>
                <td><a href="{{ url('food/edit/'.$food->id)}}"><i class="fa fa-pencil"></i> </a> <a href="{{ url('food/show/'.$food->id)}}"><i class="fa fa-search"></i> </a></td> 
              </tr>
          @endforeach
       
          </table>
        </div>
      </div>
    </div>
  </div>          
</div>

@endsection
 