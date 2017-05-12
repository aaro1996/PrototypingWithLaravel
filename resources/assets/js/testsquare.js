/* Lets start by building a board structure for our connect 4 game */
var x_count = 7;
var y_count = 6;
var game_running = false;
var player_turn; // in this case player_turn will be the indicator of whether red or blue plays, blue is player, red is opponent
var boardname = 'testsquare';
var board_node = document.getElementById(boardname);
var board_arr = [];
var turn_count;

function init() {
	for(var i = 0; i < y_count; i++) {
		board_arr.push([]);
		for (var j = 0; j < x_count; j++) {
			board_arr[i].push({
				cell: board_node.getElementsByClassName('row_' + i)[0].getElementsByClassName('col_' + j)[0].children[0],
				turn_played: -1, 
				contents: 'empty'
			});
			board_arr[i][j].cell.setAttribute('data-x', j);
			board_arr[i][j].cell.setAttribute('data-y', i);
			board_arr[i][j].cell.addEventListener('click', function(e) {
				handle_click(parseInt(e.currentTarget.getAttribute('data-x')), parseInt(e.currentTarget.getAttribute('data-y')));
			});
		}
	}
	turn_count = 0;
	player_turn = true;
	game_running = true;
}


function handle_click(column_number, row_number) {
	make_move(column_number);
	return;
}
function make_move(column_number) {
	if (!game_running) {
		return;
	}
	if (player_turn == true) {
		if (board_arr[0][column_number].contents !== 'empty') {
			return;
		}
		player_turn = false;
		var row_number = 0;
		while((++row_number < y_count) && (board_arr[row_number][column_number].contents === 'empty'));
		row_number--;
		board_arr[row_number][column_number].contents = 'blue';
		board_arr[row_number][column_number].cell.classList.add('blue_tile');
		check_victory(row_number, column_number);
		return;
	} else {
		// would do nothing here if working over the server
		if (board_arr[0][column_number].contents !== 'empty') {
			return;
		}
		player_turn = true;
		var row_number = 0;
		while((++row_number < y_count) && (board_arr[row_number][column_number].contents === 'empty'));
		row_number--;
		board_arr[row_number][column_number].contents = 'red';
		board_arr[row_number][column_number].cell.classList.add('red_tile');
		check_victory(row_number, column_number);
		return;
	}
}


function check_victory(row, col) {
	if(board_arr[row][col].contents === 'empty') {
		return;
	}
	var consecutive = 0;
	//horizontal check
	var x, y;
	x = -3;
	y = 0;

	while(x <= 3) {
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			x++;
			continue;
		}
		if (board_arr[row + y][col + x].contents === board_arr[row][col].contents) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].contents);
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].cell.classList.add('victory_tile');
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
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			y--;
			continue;
		}
		if (board_arr[row + y][col + x].contents === board_arr[row][col].contents) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].contents);
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].cell.classList.add('victory_tile');
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
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			x++;
			y--;
			continue;
		}
		if (board_arr[row + y][col + x].contents === board_arr[row][col].contents) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].contents);
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].cell.classList.add('victory_tile');
					x--;
					y++;
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
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			x--;
			y++;
			continue;
		}
		if (board_arr[row + y][col + x].contents === board_arr[row][col].contents) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].contents);
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].cell.classList.add('victory_tile');
					x++;
					y--;
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


function victory(victor) {
	console.log(victor + " has won!!!");
}


function reset() {

}
init();