@extends('app')


@section('content')

    @include('trainings.training_done')
	<a href="{{ url('/training/new-training-template') }}"> Add Training Template </a>


@endsection