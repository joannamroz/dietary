@extends('app')


@section('content')

    @include('trainings.training_done')


    
	<a href="{{ url('/new-training') }}"> Add Training Template </a>


@endsection