@extends('layouts.basic')
@section('content')
	<div hidden="hidden" id="game_vals" data-gamenumber="{{$gamenum}}" data-playernumber="{{$playernum}}"></div>
	<h1> You are 
	<?php
	switch($playernum) {
		case -1:
			echo 'playing hotseat';
		break;
		case 1:
			echo 'playing as blue';
		break;
		case 2:
			echo 'playing as red';
		break;
		default:
			echo 'spectating';
		break;
	}
	?> </h1>
	@include('gameboard.framework.boards.square', ['x_count' => 7, 'y_count' => 6, 'board_id' => 'testsquare'])
	<h1 id="victory_banner"> </h1>
	<button id="reset_button"> Restart Game </button>
	<button id="next_button"> Show Next Move </button>
	<button id="prev_button"> Show Previous Move </button>
@endsection
@section('js-footer')
	<script src="/js/testsquare.js"></script>
@endsection