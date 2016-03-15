@extends('app')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Measure</h3>
      </div>
      <div class="panel-body">

        <ul role="tablist" class="nav nav-tabs">
          <li role="presentation" class="active"><a href="#bodyMeasurements" aria-controls="bodyMeasurements" role="tab" data-toggle="tab">Body Measurements</a></li>
          <li role="presentation"><a href="#bmi" aria-controls="bmi" role="tab" data-toggle="tab">BMI</a></li>
          <li role="presentation"><a href="#bmr" aria-controls="bmr" role="tab" data-toggle="tab">BMR</a></li>
          <li role="presentation"><a href="#measureModal" aria-controls="measureModal" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> New </a></li>
          <li role="presentation"><a href="#macronutrient" aria-controls="macronutrient" role="tab" data-toggle="tab">Macronutrient Calorie Calculator</a></li>
        </ul>

        <div class="tab-content">
          <div id="bodyMeasurements" role="tabpanel" class="tab-pane active">
            <span>Your weight range</span><span style="float:right; font-weight:bold"> {{ isset($userMeasure[0]) ? $userBMIrange : " - "  }}</span><br/>
            <span>Height </span><span style="float:right">{{ isset($userMeasure[0]) ? $userHeight : " - "  }}</span><br/>
            <span>Weight </span><span style="float:right">{{ isset($userMeasure[0]) ? $userWeight : " - "  }}</span><br/>
            <span>Body Fat </span><span style="float:right">{{ isset($userMeasure[0]) ? $userBodyFat : " - "  }}</span>
            <p><span>Your BMI is </span><span  class="{{ isset($userMeasure[0]) ? strtolower(str_replace(' ', '-', $userBMIrange)) : "-"  }}" style="float:right">{{ isset($userMeasure[0]) ? $userBMI.' ' : " - " }}<button id="showRanges"> <i class="fa fa-search"></i></button></span></p> <br/>

            <div id="rangesInfo">
              <span>Starvation </span><span class="starvation">Less - 16 </span><br/>
              <span>Emaciation </span><span class="emaciation">16,0–17,0 </span><br/>
              <span>Underweight </span><span class="underweight" >17–18,5 </span><br/>
              <span>Healthy </span><span class="healthy" >18,5–25,0 </span><br/>
              <span>Overweight </span><span class="overweight" >25,0–30,0 </span><br/>
              <span>First stage of obesity </span><span class="first-stage-of-obesity">30,0–35,0 </span><br/>
              <span>Second stage of obesity </span><span class="second-stage-of-obesity">35,0–40,0  </span><br/>
              <span>Second stage of obesity </span><span class="third-stage-of-obesity">40 - more  </span><br/>
            </div>  
          </div> <!-- bodyMeasurements -->

          <div id="bmi" role="tabpanel" class="tab-pane">
            <div class="scrollable scrollbar-macosx">
              <div class="container-fluid">          
                <div class="form-group">
                  <label class="col-sm-6 control-label">Weight (kg)</label>
                  <div class="col-sm-6">
                    <input required="required" value="{{ isset($userWeight) ? $userWeight : ""  }}" id="weightBMI" type="text" name="weight" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-6 control-label">Height (cm)</label>
                  <div class="col-sm-6">
                    <input required="required" value="{{ isset($userHeight) ? $userHeight : "" }}" id="heightBMI" type="text" name="height" class="form-control" />
                  </div>
                </div>
                <div class="form-group" id="resultInputBMI">
                  <label class="col-sm-6 control-label">Result</label>
                  <div class="col-sm-6">
                      <input  value="" type="text" id="resultBMI" name="result" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-6 control-label"></label>
                  <div class="col-sm-offset-6 col-sm-6">
                    <input type="submit" name='save' class="btn btn-success" id="calculateBMIBtn" value="Calculate"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <!-- bmi -->

          <div id="bmr" role="tabpanel" class="tab-pane">
            <div class="scrollable scrollbar-macosx">
              <div class="container-fluid">            
                <div class="form-group">
                  <label class="col-sm-3 control-label">Sex</label>
                  <div class="col-sm-3">
                    <select class="select2 form-control" name="sexBMR" id="sexBMR">
                      <option value=""></option>
                      <option value="female" @if($userData->sex == "female") selected=selected @endif>Female</option>
                      <option value="male" @if($userData->sex == "male") selected=selected @endif>Male</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Weight (kg)</label>
                      <div class="col-sm-3">
                        <input required="required" value="{{ isset($userWeight) ? $userWeight : ""  }}" id="weightBMR" type="text" name="weight" class="form-control" />
                      </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Height (cm)</label>
                  <div class="col-sm-3">
                    <input required="required" value="{{ isset($userHeight) ? $userHeight : "" }}" id="heightBMR" type="text" name="height" class="form-control" />
                  </div>
                </div>        
                <div class="form-group">
                  <label class="col-sm-3 control-label">Age</label>
                  <div class="col-sm-3">
                    <input required="required" value="{{ isset($age) ? $age : "" }}" id="ageBMR" type="text" name="age" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Activity</label>
                  <div class = "col-sm-9">
                    <select class="select2 form-control" name="activityBMR" id="activityBMR">
                      <option value=""></option>
                      <option value="1.2">Little or no exercise</option>
                      <option value="1.375">Light exercise (1-3 times/week)</option>
                      <option value="1.55">Moderate exercise (3-5 days/week)</option>
                      <option value="1.725">Heavy exercise (6-7 days/week)</option>
                      <option value="1.9">Very heavy exercise (physical job or exercise twice a day)</option>
                    </select>
                  </div>
                </div>
                <div class="form-group" id="resultInputBMR">
                    <label class="col-sm-9 control-label">Result</label>
                    <div class="col-sm-3">
                        <input  value="" type="text" id="resultBMR" name="result" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label"></label>
                    <div class="col-sm-offset-6 col-sm-6">
                      <input type="submit" name='save' class="btn btn-success" id="calculateBMRBtn" value="Calculate"/>
                    </div>
                </div>
              </div>
            </div>
          </div> <!-- bmr -->
          <div id="measureModal" role="tabpanel" class="tab-pane">
          <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
              New measure
          </button> -->
            @include('users.measurements_form', ['userData' => 'data'])
          </div>
          <div id="macronutrient" role="tabpanel" class="tab-pane">
            <p>there is nothing to display yet!</p>
          </div>
        </div> <!-- tab-content -->
      </div> <!-- panel-body -->
    </div> <!-- panel-success -->
  </div>  <!-- col-md-8 -->

  <div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Task for today</h3>
      </div>
      <div class="panel-body">
        <h5 style="color:white">Your planed tasks for today:</h5>
        <ul id="todo-list">
          @foreach ($today_tasks as $task)
            <li style="color:white">{{ $task->name }}<i class="fa fa-times pull-right li-todo today" data-id="{{ $task->id}}"> </i><!-- <span class="todo_remove_span pull-right">remove</span> --></li>
          @endforeach
          @if($not_done_tasks)
              @foreach ($not_done_tasks as $task)
                <li>{{ $task->name }}<i class="fa fa-times pull-right li-todo" data-id="{{ $task->id}}"></i></li>
              @endforeach
          @endif
        </ul>
        <div class="newToDo">
          <form  method="post" action="/new-todo"  class="ajax-todo">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-sm-3 control-label"> Name</label>
              <div class="col-sm-9">
                <textarea required="required" value="{{ old('name') }}" type="textarea" rows="3" cols="80" name="name" class="form-control" ></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-7 control-label"> Date</label>
              <div class="col-sm-5">
                <input required="required" value="{{$now}}" name="date_to_do" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="submit" name='save' class="btn btn-success" value="Save"/>
              </div>
            </div>      
          </form>
        </div>
      </div>  
    </div>
  </div>
  <div class="col-md-8">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <h3 class="panel-title">Users measurements</h3> 
      </div>
      <div class="panel-body" id="line-chart" style="height: 350px"> 
        <span id="chart-line" data-user-data='{!!$lastMeasure!!}'></span>
      </div>
    </div>
  </div>

    @if( isset($userMeasureData[0]) )

    <?php  
      $now = new \DateTime(); 
      $measurementsInArray = $userMeasure->toArray(); 
      $latest = $measurementsInArray[0];
        
    ?>

  <div class="col-md-12 col-xs-12">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Your last measurements</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped bodyMeasurement">
            <tr>
              <th>Date</th><th>Weight</th><th>Body fat %</th><th>Body water %</th><th>Muscle %</th><th>BMI</th><th>Internal fat %</th><th>Waist</th><th>Chest</th><th>Neck</th><th>Hips</th><th>Biceps</th><th>Bust</th><th>Thigh</th><th>Upper arm</th><th>Delete</th>   
            </tr>
            
            @foreach($userMeasureData as $new_measure)
                        
            <tr>
                    
              <td >{{ $new_measure['date'] }}</td>

              <td >{{ $new_measure['weight'] }} {!! isset($new_measure['weight_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['weight_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['body_fat'] }} {!! isset($new_measure['body_fat_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['body_fat_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['water'] }} {!! isset($new_measure['water_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['water_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['muscle'] }} {!! isset($new_measure['muscle_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['muscle_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['bmi'] }} {!! isset($new_measure['bmi_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['bmi_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['internal_fat'] }} {!! isset($new_measure['internal_fat_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['internal_fat_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['waist'] }} {!! isset($new_measure['waist_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['waist_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['chest'] }} {!! isset($new_measure['chest_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['chest_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['neck'] }} {!! isset($new_measure['neck_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['neck_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['hips'] }} {!! isset($new_measure['hips_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['hips_class'].'"></i>' : '-' !!}</td>    

              <td >{{ $new_measure['biceps'] }} {!! isset($new_measure['biceps_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['biceps_class'].'"></i>' : '-' !!}</td>  

              <td >{{ $new_measure['bust'] }} {!! isset($new_measure['bust_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['bust_class'].'"></i>' : '-' !!}</td>

              <td >{{ $new_measure['thigh'] }} {!! isset($new_measure['thigh_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['thigh_class'].'"></i>' : '-' !!}</td>
              
              <td >{{ $new_measure['upper_arm'] }} {!! isset($new_measure['upper_arm_class']) ? '<i class="fa fa-long-arrow-'.$new_measure['upper_arm_class'].'"></i>' : '-' !!}</td>
          
              <td><a href="{{  url('measurement/delete/'.$new_measure['id'].'?_token='.csrf_token()) }}" >Delete</a></td>
            </tr>
            <tr>
              <th>Comment: </th>
              <td colspan='16'>{{ $new_measure['comment'] }}</td>
            </tr>                       
            @endforeach
          </table>
        </div>   <!-- table-responsive -->
      </div> <!-- col-md-12 col-xs-12 -->
    </div>
    @endif
  </div>
</div>
@endsection