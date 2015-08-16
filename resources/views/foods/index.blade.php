@extends('app')

@section('title')
{{$title}}
@endsection

@section('content')

@if ( !$foods->count() )
There is no food till now.
@else
<a href = "{{ url('food/new-food') }}">Add new food position</a>
<div class = "list-group">
  <div class = "list-group-item">
    <table class = "table table-bordered">
      <tr>
        <th>Name</th><th>Brand</th><th>Kcal</th><th>Proteins</th><th>Carbs</th><th>Fats</th><th>Fibre</th><th>Edit</th>
      </tr>
       @foreach( $foods as $food )
       <tr>
         <th>{{ $food->name }}</th>
          <td>{{ $food->brand->name }}</td> 
         <td title = "Popover title" ><div data-toggle = "popover" data-title = '' data-content = "kcal from proteins {{$food->proteins * 4 }} kcal from carbs {{$food->carbs * 4 }} kcal from carbs {{$food->fats * 9 }} "> {{ $food->kcal }} </div></td>
         <td>{{ $food->proteins }}</td>
         <td>{{ $food->carbs }}</td>
         <td>{{ $food->fats  }}</td>
         <td>{{ $food->fibre }}</td>
         <td><a href = "{{ url('food/edit/'.$food->id)}}"><i class = "fa fa-pencil"></i> </a> <a href = "{{ url('food/show/'.$food->id)}}"><i class = "fa fa-search"></i> </a> </td> 
      </tr>
      @endforeach
    </table>     
    {!! $foods->render() !!}           
  </div>
</div>
@endif
@endsection