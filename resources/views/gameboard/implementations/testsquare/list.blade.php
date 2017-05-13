@extends('layouts.basic')
@section('content')
	@foreach($games as $game)
		<a href="{{ url('/play/testsquare/'.$game->id) }}"> {{$game->name}} </a> <br/>
	@endforeach
	<h2> <a href="{{url('/play/testsquare/create')}}"> CREATE A GAME HERE </a> <br/> </h2>
@endsection