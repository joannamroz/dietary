@if ( !$training_done->count() )
<!--   <h3 class="panel-title" style="margin-top:50px">Training done today: - </h3> -->
@else

 <!--  <h3 class="panel-title" style="margin-top:50px">Training done today:</h3> -->
  <ul>
  @foreach($training_done as $training )
    <li> {{ $training->finished_at }} 
        <ul>
          @foreach ($training->exercises as $exercise) 
            <li> {{$exercise->name}} || {{ $exercise->pivot->series }}  ||  {{$exercise->pivot->reps}}</li>
          @endforeach
        </ul>
    </li>
  @endforeach
  </ul>
@endif