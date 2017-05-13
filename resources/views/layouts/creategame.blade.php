@extends('layouts.basic')
@section('content')
<h1>
	Create a {{$gamename}}
</h1>
<form method="post" action="/play/{{$gamename}}">
	{{ csrf_field() }}
	<input type="text" name="name" placeholder="Name of game room"><br>
	<input type="submit" value="Create game"><br>
</form>
@endsection