@extends('app')


@section('content')
<!-- Training template -->
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Add training</h3>
        </div>
        <div class="panel-body">
          <form action="/new-training" method="post" class='ajax-training' data-redirecturl="{{ url('/training') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" value id='training_template_id' name='id'>
            <div id='exercises-container'> 
              <div class="form-group">
                <label class="col-sm-6 control-label">Exercise Name</label>
                <label class="col-sm-2 control-label">Series</label>
                <label class="col-sm-2 control-label">Repeats</label>
                <label class="col-sm-2 control-label">Duration</label>
              </div> 
            </div>
            <span class='btn btn-default' id='add-exercise'> Add Exercise </span>        
            <input type="submit" name='save' class="btn btn-success" value="Save"/>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection