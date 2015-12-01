@extends('app')

@section('title')
{{$title}}
@endsection

@section('content')

@if ( !$brands->count() )
There is no brands till now. Login and add a new brand now!!!
@else
<div class = "row">
  <div class = "col-md-6">
    <table class = "table table-bordered">
     <tr>
      <th>Brand name</th>
      <th>Edit</th>
     </tr>
      @foreach( $brands as $brand )
      <tr>
        <td>{{ $brand->name }}</td>
        <td><a href = "{{ url('brand/edit/'.$brand->id)}}"><i class = "fa fa-pencil"></i></a></td>
      </tr>
    @endforeach
    </table>   
  </div>
  <div class = "col-md-6">
    <button class = "btn btn-info" id = "btnNewBrand">Add new brand </button> <!-- {{ url('brand/new-brand') }} -->
    <form action = "/new-brand" method = "post" class = "form-horizontal" id = "brandForm">
      <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
      <div class = "form-group">
        <label class = "col-sm-4 control-label">Brand name</label>
        <div class = "col-sm-8">
          <input required = "required" value = "{{ old('name') }}" type = "text" name = "name" class = "form-control" />
        </div>
      </div>
      <div class = "form-group">
        <div class = "col-sm-offset-4 col-sm-8">
          <input type = "submit" name = 'save' class = "btn btn-success" value = "Save"/>
        </div>
      </div>
    </form>
  </div>
</div>
@endif

@endsection