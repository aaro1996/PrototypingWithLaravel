@extends('layouts.basic')
@section('content')
	@include('gameboard.framework.boards.square', ['x_count' => 7, 'y_count' => 6, 'board_id' => 'testsquare'])
@endsection
@section('js-footer')
	<script src="/js/testsquare.js"></script>
@endsection