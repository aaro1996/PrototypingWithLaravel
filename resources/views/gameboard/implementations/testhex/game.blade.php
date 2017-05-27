@extends('layouts.basic')
@section('content')
	@include('gameboard.framework.boards.hex_centered', ['board_rows' => [4,5,4]])
@endsection