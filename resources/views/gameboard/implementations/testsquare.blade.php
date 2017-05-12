@extends('layouts.basic')
@section('content')
	<div hidden="hidden" id="game_vals" data-gamenumber="{{$gamenum}}" data-playernumber="{{$playernum}}"></div>
	@include('gameboard.framework.boards.square', ['x_count' => 7, 'y_count' => 6, 'board_id' => 'testsquare'])
@endsection
@section('js-footer')
	<script src="/js/testsquare.js"></script>
@endsection