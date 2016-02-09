@extends('app')


@section('content')
<!-- Training template -->


<form action="/new-training" method="post" class='ajax-training'>

    <div class="row">
        <div class="col-md-12">
        <h3> Add New Training </h3>
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" value id='training_template_id' name='id'>
    <!--            <div class="form-group">
              <label class="col-sm-3 control-label">Name</label>
              <div class="col-sm-7">
                <input value="{{ old('name') }}" required="required" type ="text" name ="name" class="form-control" />      
              </div>  
            </div> -->
    <!--            <div class="form-group">
              <div class="col-sm-2">
                <input type="submit" name='save' class="btn" value="Save"/>
              </div>
            </div> -->
            <div id='exercises-container'> 
                <div class="form-group">
                    <label class="col-sm-6 control-label">Exercise Name</label>
                    <label class="col-sm-2 control-label">Series</label>
                    <label class="col-sm-2 control-label">Repeats</label>
                    <label class="col-sm-2 control-label">Duration</label>
                </div> 
            </div>
            <span class='btn btn-default col-sm-2 col-sm-offset-10' id='add-exercise'> Add Exercise </span>          
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <input type="submit" name='save' class="btn" value="Save"/>
        </div>


    </div>

</form>
<script>



</script>


@endsection