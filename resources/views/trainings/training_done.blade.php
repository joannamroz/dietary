@if ( !$training_done->count() )

  <h4 style="font-weight:bold">Training done today: - </h4><br/>

@else

  <h4 style = "font-weight:bold">Training done today:</h4>
    <ul>
    @foreach($training_done as $training )
    <li> {{ $training->finished_at }} 
        <ul>
          @foreach ($training->exercises as $exercise) 
            <li> {{$exercise->name}} || {{$exercise->pivot->reps}}  || {{ $exercise->pivot->series }} </li>
          @endforeach
        </ul>
    </li>


    @endforeach
    </ul>


  @endif