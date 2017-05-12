@extends('layouts.basic')
@section('content')
	@include('gameboard.framework.boards.square', ['x_count' => 10, 'y_count' => 5, 'board_id' => 'testsquare'])
@endsection