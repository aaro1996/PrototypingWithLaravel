<table class="gameboard">
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

<div class="square_tile x_{{$x}} y_{{$y}}">
	<div>
		<p> x: {{$x}} y: {{$y}} </p>
	</div>
</div>