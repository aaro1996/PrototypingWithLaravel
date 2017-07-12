@for($i = 0; $i < count($board_rows); $i++)
	<div class=<?php echo '"hex_row'.($i%2 == 0 ? ' even"' : '"'); ?>>
	@for($j = 0; $j < $board_rows[$i]; $j++)
		@include('gameboard.framework.tiles.hex', ['color' => ($j%2 == 0 ? 'red' : 'blue'), 'x_val' => $j, 'y_val' => $i])
	@endfor
	</div>
@endfor