<div class="row">
  <div class="col-md-8">
    <div class="panel panel-success">
    
      @if ( !$training_done->count() )
      <div class="panel-heading">
        <h3 class="panel-title">Training done today: - </h3>
      </div>

      @else
      <div class="panel-heading">
        <h3 class="panel-title">Training done today:</h3>
      </div>
      <div class="panel-body">

        <ul>
        @foreach($training_done as $training )
          <li> {{ $training->finished_at }} 
              <ul>
                @foreach ($training->exercises as $exercise) 
                  <li>  {{$exercise->name}}  || {{ $exercise->pivot->series }}  || {{$exercise->pivot->reps}}</li>
                @endforeach
              </ul>
          </li>

        @endforeach
        </ul>
      </div>
      @endif
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-success">
     <div class="panel-heading">
        <h3 class="panel-title">Add new </h3>
      </div>
      <div class="panel-body">
        <a href="{{ url('/new-training') }}"> Add Training Template </a>
      </div>
    </div>
  </div>
</div>
