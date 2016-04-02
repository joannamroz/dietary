@extends('app')


@section('content')

@if ( !$foods->count() )
There is no food till now.
@else
<div class="panel panel-success" id='foods-panel'> 
  <div class="panel-heading">
    <h3 class="panel-title">Foods </h3>
  </div>
  <div class='panel-body'> 

    <div class="col-md-6 col-xs-8">
      <select type='text' id='food-search' placeholder='Find food...' class='form-control selectpicker  foods-select2'> </select>
    </div>
    <div class="col-md-6 col-xs-4">
      <a class='pull-right btn btn-success' href="{{ url('food/new-food') }}">Add new +</a>
    </div>
    <div class="col-md-12 col-xs-12" style="padding:20px">
      <div class="scrollable scrollbar-macosx">
        <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
          <tr>
            <th>Name</th><th>Brand</th><th>Kcal</th><th>Proteins</th><th>Carbs</th><th>Fats</th><th>Fibre</th><th>Edit</th>
          </tr>
           @foreach( $foods as $food )
           <tr>
             <th>{{ $food->name }}</th>
              <td>{{ $food->brand->name }}</td> 
             <td title = "Popover title" ><div data-toggle="popover" data-title='' data-content="kcal from proteins {{$food->proteins * 4 }} kcal from carbs {{$food->carbs * 4 }} kcal from carbs {{$food->fats * 9 }} "> {{ $food->kcal }} </div></td>
             <td>{{ $food->proteins }}</td>
             <td>{{ $food->carbs }}</td>
             <td>{{ $food->fats  }}</td>
             <td>{{ $food->fibre }}</td>
             <td><a href="{{ url('food/edit/'.$food->id)}}"><i class="fa fa-pencil"></i> </a> <a href="{{ url('food/show/'.$food->id)}}"><i class="fa fa-search"></i> </a> </td> 
          </tr>
          @endforeach
        </table>
      </div>
    </div>

  </div>
</div>
{!! $foods->render() !!}   
        
@endif
@endsection