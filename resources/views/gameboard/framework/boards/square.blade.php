<table class="gameboard" id="{{$board_id}}">
	@for($i = 0; $i < $y_count; $i++)
		<tr class="row_{{$i}} square_board_row">
			@for($j = 0; $j < $x_count; $j++)
				<td class="col_{{$j}} square_board_tile">
					@include('gameboard.framework.tiles.square', ['x' => $j, 'y' => $i])
				</td>
			@endfor
		</tr>
	@endfor
</table>