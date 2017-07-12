@extends('layouts.basic')
@section('content')
	@include('gameboard.framework.boards.hex_centered', ['board_rows' => [3,4,3]])
@endsection