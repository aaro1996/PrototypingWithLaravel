/* Lets start by building a board structure for our connect 4 game */
var x_count = 7;
var y_count = 6;
var game_running = false;
var player_turn = true; // in this case player_turn will be the indicator of whether red or blue plays, blue is player, red is opponent
var boardname = 'testsquare';
var board_node = document.getElementById(boardname);
var board_arr = [];
for(var i = 0; i < y_count; i++) {
	board_arr.push([]);
	for (var j = 0; j < x_count; j++) {
		board_arr[i].push(board_node.getElementsByClassName('row_' + i)[0].getElementsByClassName('col_' + j)[0].children[0]);
		board_arr[i][j].setAttribute('data-x', j);
		board_arr[i][j].setAttribute('data-y', i);
		board_arr[i][j].setAttribute('data-contents', 'empty');
		board_arr[i][j].addEventListener('click', function(e) {
			console.log("click on col " + e.currentTarget.getAttribute('data-x'));
			handle_click(parseInt(e.currentTarget.getAttribute('data-x')));
		})
	}
}
game_running = true;

console.log("Finished Parsing init");
function handle_click(column_number) {
	// break if the game isn't going, I.E. did someone win
	if (!game_running) {
		return;
	}
	if (player_turn == true) {
		if (board_arr[0][column_number].getAttribute('data-contents') !== 'empty') {
			return;
		}
		player_turn = false;
		var row_number = 0;
		while((++row_number < y_count) && (board_arr[row_number][column_number].getAttribute('data-contents') === 'empty'));
		row_number--;
		board_arr[row_number][column_number].setAttribute('data-contents', 'blue');
		board_arr[row_number][column_number].classList.add('blue_tile');
		console.log('blue went to x:' + column_number + ' y: ' + row_number);
		check_victory(row_number, column_number);
		return;
	} else {
		// would do nothing here if working over the server
		if (board_arr[0][column_number].getAttribute('data-contents') !== 'empty') {
			return;
		}
		player_turn = true;
		var row_number = 0;
		while((++row_number < y_count) && (board_arr[row_number][column_number].getAttribute('data-contents') === 'empty'));
		row_number--;
		board_arr[row_number][column_number].setAttribute('data-contents', 'red');
		board_arr[row_number][column_number].classList.add('red_tile');
		console.log('red went to x:' + column_number + ' y: ' + row_number);
		check_victory(row_number, column_number);
		return;
	}
}
console.log("Finished Parsing handle_click");
function debug(debug_group, statement) {
	switch(debug_group) {
		case 1:
		//console.log(statement);
		break;
		default:
		break;
	}
}
function check_victory(row, col) {
	debug(1, "Victory check on row: " + row + " col: " + col);
	if(board_arr[row][col].getAttribute('data-contents') === 'empty') {
		debug(1, "Error, shouldn't have empty on victory check");
		return;
	}
	var consecutive = 0;
	//horizontal check
	var x, y;
	x = -3;
	y = 0;

	while(x <= 3) {
		debug(1, "Checking x+" + " x = " + x + " y = " + y);
		debug(1, "row + y = " + (row + y) + " col + x = " + (col + x));
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			x++;
			continue;
		}
		if (board_arr[row + y][col + x].getAttribute('data-contents') === board_arr[row][col].getAttribute('data-contents')) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].getAttribute('data-contents'));
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].classList.add('victory_tile');
					x--;
				}
				return;
			}
		} else {
			consecutive = 0;
		}
		x++;
	}
	//vertical check
	x = 0;
	y = 3;
	consecutive = 0;
	while(y >= 0){
		debug(1, "Checking y+" + " x = " + x + " y = " + y);
		debug(1, "row + y = " + (row + y) + " col + x = " + (col + x));
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			y--;
			continue;
		}
		if (board_arr[row + y][col + x].getAttribute('data-contents') === board_arr[row][col].getAttribute('data-contents')) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].getAttribute('data-contents'));
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].classList.add('victory_tile');
					y++;
				}
				return;
			}
		} else {
			consecutive = 0;
		}
		y--;
	}


	//diagonal x+ y-
	x = -3;
	y = 3;
	consecutive = 0;
	while ((x <= 3) && (y >= -3)){
		debug(1, "Checking x+ y-" + " x = " + x + " y = " + y);
		debug(1, "row + y = " + (row + y) + " col + x = " + (col + x));
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			x++;
			y--;
			continue;
		}
		if (board_arr[row + y][col + x].getAttribute('data-contents') === board_arr[row][col].getAttribute('data-contents')) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].getAttribute('data-contents'));
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].classList.add('victory_tile');
					x++;
					y--;
				}
				return;
			}
		} else {
			consecutive = 0;
		}
		x++;
		y--;
	}


	//diagonal x- y+
	x = 3;
	y = -3;
	consecutive = 0;
	while((x >= -3) && (y <= 3)) {
		debug(1, "Checking x- y+" + " x = " + x + " y = " + y);
		debug(1, "row + y = " + (row + y) + " col + x = " + (col + x));
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			x--;
			y++;
			continue;
		}
		if (board_arr[row + y][col + x].getAttribute('data-contents') === board_arr[row][col].getAttribute('data-contents')) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].getAttribute('data-contents'));
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].classList.add('victory_tile');
					x--;
					y++;
				}
				return;
			}
		} else {
			consecutive = 0;
		}
		x--; 
		y++;
	}

}

console.log("Finished Parsing check_victory");
function victory(victor) {
	console.log(victor + " has won!!!");
}
console.log("Finished Parsing victory");