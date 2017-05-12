<?php 
$rows = array();
for($i = 1; $i <= $y_count; $i++){
	$rows[$i] = array();
	for($j = 1; $j <= $x_count; $j++) {
		$rows[$i][$j] = ['y' => $i, 'x' => $j];
	}
	$rows['xlength'] = $x_count;
	$rows['ylength'] = $y_count;
}
?>
<squareboard v-bind:rows={{json_encode($rows)}}></squareboard>