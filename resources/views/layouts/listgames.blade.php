@extends('layouts.basic')
@section('content')
	<h1> List of {{$gamename}} games! </h1>
	@foreach($games as $game)
		<a href="{{ url('/play/'.$gamename.'/'.$game->id) }}"> {{$game->name}} </a> <br/>
	@endforeach
	<h2> <a href="{{url('/play/'.$gamename.'/create')}}"> CREATE A GAME HERE </a> <br/> </h2>
@endsection