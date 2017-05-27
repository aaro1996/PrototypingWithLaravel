/* Lets start by building a board structure for our connect 4 game */
var moveurl = "TODO: MOVE URL";
var pollInterval;

function init() {
	pollInterval = setInterval(function(){poll();}, 1000);
}
function make_move(column_number) {
}
function check_victory(row, col) {
}
function reset() {
}

function poll() {
	var xmlHttp = new XMLHttpRequest()
	xmlHttp.open("PUT", moveurl + gamenum, true);
	xmlHttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	xmlHttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('csrf-token').getAttribute('content'));
	xmlHttp.addEventListener("load", server_response, false);
	xmlHttp.send(JSON.stringify({mtype: 'poll', /* TODO: GAMESTATE CHHECK*/ }));
}

function server_response(e) {
}

function update_game(gamefile) {
}

function send_move(column_number) {
	var xmlHttp = new XMLHttpRequest()
	xmlHttp.open("PUT", moveurl + gamenum, true);
	xmlHttp.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
	xmlHttp.setRequestHeader('X-CSRF-TOKEN', document.getElementById('csrf-token').getAttribute('content'));
	xmlHttp.addEventListener("load", server_response, false);
	xmlHttp.send(JSON.stringify({mtype: 'move', /*TODO: MOVE OBJECT*/}));
}

init();
