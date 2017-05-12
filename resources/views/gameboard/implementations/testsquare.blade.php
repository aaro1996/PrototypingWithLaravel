@extends('layouts.basic')
@section('header')
	<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
@endsection
@section('content')
	@include('gameboard.framework.boards.square', ['x_count' => 7, 'y_count' => 6, 'board_id' => 'testsquare'])
@endsection
@section('js-footer')
	<script src="/js/testsquare.js"></script>
@endsection