<table>
	@for($i = 0; $i < $y_count; $i++)
		<tr>
			@for($j = 0; $j < $x_count; $j++)
				<td>
					@include('gameboard.framework.tiles.square', ['x' => $j, 'y' => $i])
				</td>
			@endfor
		</tr>
	@endfor
</table>