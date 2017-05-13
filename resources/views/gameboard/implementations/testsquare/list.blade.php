@extends('layouts.basic')
@section('content')
	@foreach($games as $game)
		<a href="{{ url('/play/testsquare/'.$game->id) }}"> {{$game->name}} </a> <br/>
	@endforeach
@endsection