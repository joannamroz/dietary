@extends('app')


@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-heading">
          <h3 class="panel-title">Brands</h3>
      </div>
      <div class="panel-body">
        <div class="scrollable scrollbar-macosx">
        
          <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Brand name</th>
                <th>Edit</th>
              </tr>
            </thead>
            @foreach( $brands as $brand )
            <tr>
              <td>{{ $brand->name }}</td>
              <td><a href="{{ url('brand/edit/'.$brand->id)}}"><i class="fa fa-pencil"></i></a></td>
            </tr>
        @endforeach
          </table> 
        </div>
      </div> 
    </div> 
  </div>
  <div class="col-md-6">
   <div class="panel panel-success">
      <div class="panel-heading">
          <h3 class="panel-title">Add new brand</h3>
      </div>
      <div class="panel-body">
        <form action="/new-brand" method="post" class="form-horizontal" id="">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="col-sm-4 control-label">Brand name</label>
            <div class="col-sm-8">
              <input required="required" value="{{ old('name') }}" type="text" name="name" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <input type="submit" name='save' class="btn btn-default" value="Save"/>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection