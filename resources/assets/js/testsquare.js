/* Lets start by building a board structure for our connect 4 game */
var x_count = 7;
var y_count = 6;
var game_running = false;
var player_turn; // in this case player_turn will be the indicator of whether red or blue plays, blue is player, red is opponent
var boardname = 'testsquare';
var board_node = document.getElementById(boardname);
var gamenum = parseInt(document.getElementById('game_vals').getAttribute('data-gamenumber'));
var playernum = parseInt(document.getElementById('game_vals').getAttribute('data-playernumber'));
var board_arr = [];
var turn_count;
var pollInterval;

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
	document.getElementById('reset_button').addEventListener('click', function(e) {
		if (confirm('Are you sure you want to restart?')) {
			reset();
		}
	});
	turn_count = 0;
	player_turn = true;
	game_running = true;
	pollInterval = setInterval(function(){poll();}, 1000);
}


function handle_click(column_number, row_number) {
	switch(playernum) {
		case -1:
		make_move(column_number);
		break;
		case 1:
		if (player_turn) {
			make_move(column_number);
		}
		break;
		case 2:
		if (!player_turn) {
			make_move(column_number);
		}
		break;
		default: 
		break;
	}
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
		turn_count++;
		var row_number = 0;
		while((++row_number < y_count) && (board_arr[row_number][column_number].contents === 'empty'));
		row_number--;
		board_arr[row_number][column_number].contents = 'blue';
		board_arr[row_number][column_number].cell.classList.add('blue_tile');
		board_arr[row_number][column_number].turn_played = turn_count;
		check_victory(row_number, column_number);
		if (playernum == 1) {send_move(column_number);}
		return;
	} else {
		// while working through the server this is called by the server's response
		if (board_arr[0][column_number].contents !== 'empty') {
			return;
		}
		player_turn = true;
		turn_count++;
		var row_number = 0;
		while((++row_number < y_count) && (board_arr[row_number][column_number].contents === 'empty'));
		row_number--;
		board_arr[row_number][column_number].contents = 'red';
		board_arr[row_number][column_number].cell.classList.add('red_tile');
		board_arr[row_number][column_number].turn_played = turn_count;
		check_victory(row_number, column_number);
		if (playernum == 2) {send_move(column_number);}
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


	//diagonal x- y-
	x = 3;
	y = 3;
	consecutive = 0;
	while((x >= -3) && (y >= -3)) {
		if (((col + x) < 0) || ((col + x) >= x_count) || ((row + y) < 0) || ((row + y) >= y_count)) {
			x--;
			y--;
			continue;
		}
		if (board_arr[row + y][col + x].contents === board_arr[row][col].contents) {
			if (++consecutive === 4) {
				victory(board_arr[row][col].contents);
				game_running = false;
				for (var i = 0; i < 4; i++) {
					board_arr[row + y][col + x].cell.classList.add('victory_tile');
					x++;
					y++;
				}
				return;
			}
		} else {
			consecutive = 0;
		}
		x--; 
		y--;
	}

}

function victory(victor) {
	document.getElementById('victory_banner').innerHTML = victor + ' has won!';
	console.log(victor + " has won!!!");
}


function reset() {
	for(var i = 0; i < y_count; i++) {
		for (var j = 0; j < x_count; j++) {
			board_arr[i][j].contents = 'empty';
			board_arr[i][j].cell.classList.remove('victory_tile');
			board_arr[i][j].cell.classList.remove('red_tile');
			board_arr[i][j].cell.classList.remove('blue_tile');
		}
	}
	turn_count = 0;
	player_turn = true;
	game_running = true;
	document.getElementById('victory_banner').innerHTML = '';	
	if(playernum > 0) {
		var xmlHttp = new XMLHttpRequest()
		xmlHttp.open("PUT", "/play/testsquare/" + gamenum, true);
		xmlHttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
		xmlHttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('csrf-token').getAttribute('content'));
		xmlHttp.addEventListener("load", server_response, false);
		xmlHttp.send(JSON.stringify({mtype: 'reset'}));
	}
}

function poll() {
	var xmlHttp = new XMLHttpRequest()
	xmlHttp.open("PUT", "/play/testsquare/" + gamenum, true);
	xmlHttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	xmlHttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('csrf-token').getAttribute('content'));
	xmlHttp.addEventListener("load", server_response, false);
	xmlHttp.send(JSON.stringify({mtype: 'poll', turnnumber: turn_count}));
}

function server_response(e) {
	var serverJSON = JSON.parse(e.target.responseText);
	console.log('recieved_response');
	switch(serverJSON.mtype) {
		case 'wait':
		break;
		case 'update_game':
		update_game(serverJSON.gamefile);
		break;
		case 'make_move':
		console.log('making_move');
		make_move(parseInt(serverJSON.column));
		console.log('recovering');
		break;

	}

}

function update_game(gamefile) {
	turn_count = gamefile.turn_count;
	if (turn_count == 0) {
		reset();	
	} else {
		for(var i = 0; i < y_count; i++) {
			for (var j = 0; j < x_count; j++) {
				board_arr[i][j].contents = gamefile.board[i][j].contents;
				board_arr[i][j].turn_played = gamefile.board[i][j].turn_played;
				if (gamefile.board[i][j].victory) {
					board_arr[i][j].cell.classList.add('victory_tile');
				} else {
					board_arr[i][j].cell.classList.remove('victory_tile');
				}
				if(gamefile.board[i][j].contents == 'red') {
					board_arr[i][j].cell.classList.add('red_tile');
				} else {
					board_arr[i][j].cell.classList.remove('red_tile');
				}
				if (gamefile.board[i][j].contents == 'blue') {
					board_arr[i][j].cell.classList.add('blue_tile');
				} else {
					board_arr[i][j].cell.classList.remove('blue_tile');
				}
			}
		}
	}
	player_turn = gamefile.player_turn;
	game_running = gamefile.game_running;
}

function send_move(column_number) {
	var xmlHttp = new XMLHttpRequest()
	xmlHttp.open("PUT", "/play/testsquare/" + gamenum, true);
	xmlHttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	xmlHttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('csrf-token').getAttribute('content'));
	xmlHttp.addEventListener("load", server_response, false);
	xmlHttp.send(JSON.stringify({mtype: 'move', column: column_number}));
}

init();
