@extends('app')

@section('content')
<?php $date_added_training = $training->created_at; ?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">Trainings for {{ $date_added_training->format('d/m/Y') }} ({{ $date_added_training->format('l') }})</h3>
      </div>
      <div class="panel-body">
         <div class="scrollable scrollbar-macosx">
            <table id="" class="table table_sortable {sortlist: [[0,0]]}" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Series</th>
                  <th>Reps</th>
                  <th>Duration</th>
                  <th>When aded</th>
                </tr>
              </thead>
             
              @foreach( $training->exercises as $exercise )

              <tr>
                <td>{{ $exercise->name}}</td>
                <td>{{ $exercise->pivot->series}}</td>
                <td>{{ $exercise->pivot->reps}}</td>
                <td>{{ $exercise->pivot->duration}}</td>
                <td>{{ $exercise->created_at->format('d/m/Y')}}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>  
</div> <!-- row -->


@endsection