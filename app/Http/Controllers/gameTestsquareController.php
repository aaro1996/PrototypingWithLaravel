<?php

namespace App\Http\Controllers;

use App\User;
use App\GameTestsquare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class gameTestsquareController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
        {
            if(Auth::check()) {
                return view('gameboard.implementations.testsquare.list', ['games' => GameTestsquare::get()]);
            } else {
                return redirect('/login');
            }
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	if (Auth::check()) {
    		return view('layouts.creategame', ['gamename' => 'testsquare']);
    	} else {
    		return redirect()->route('home');
    	}
    	return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	if(Auth::check()) {
    		if ($request->has('name')) {
                $board_arr = array();
                for($i = 0; $i < 6; $i++){
                    $board_arr[$i] = array();
                    for($j = 0; $j < 7; $j++) {
                        $board_arr[$i][$j] = ['contents' => 'empty', 'turn_played' => -1, 'victory' => false];
                    }
                }
                $game = new GameTestsquare;
                $game->name = $request->name;
                $game->data = json_encode(['board' => $board_arr, 'turn_count' => 0, 'player_turn' => true, 'game_running' => true]);
                $game->save();
                return redirect('/play/testsquare/'.$game->id);
            } else {
               return back();
           }
       }
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	if(Auth::check()) {
            $game =  GameTestsquare::findOrFail($id);
            $gameplayer = null;
            if(!($gamePlayer = $game->users()->where('user_id', Auth::user()->id)->first())) {
                $new_num = 1;
                if ($users = $game->users()->get()) {
                    foreach ($users as $user) {
                        $new_num = max($user->pivot->player_number + 1, $new_num);
                    }
                }
                error_log($game);
                $game->users()->attach(Auth::user()->id, ['player_number' => $new_num]);
                $gamePlayer = $game->users()->where('user_id', Auth::user()->id)->first();
            }
            return view('gameboard.implementations.testsquare.game', ['playernum' => $gamePlayer->pivot->player_number, 'gamenum' => $id]);
        }
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    public function template($id)
    {
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        function move($column, $data, $id) {
            function check_victory($row, $col, $board, $id) {
                //x+
                $x = -3;
                $y = 0;
                $consecutive = 0;
                while(($x <= 3)) {
                    if ((($col + $x) < 0) || (($col + $x) >= 7) || (($row + $y) < 0) || (($row + $y) >= 6)) {
                        $x++;
                        continue;
                    }
                    if ($board[$row + $y][$col + $x]['contents'] === $board[$row][$col]['contents']) {
                        if (++$consecutive === 4) {
                            for ($i = 0; $i < 4; $i++) {
                                $board[$row + $y][$col + $x]['victory'] = true;
                                $x--;
                            }
                            return $board;
                        }
                    } else {
                        $consecutive = 0;
                    }
                    $x++; 
                }

                //y+
                $x = 0;
                $y = -3;
                $consecutive = 0;
                while(($y <= 3) && ($y >= -3)) {
                    if ((($col + $x) < 0) || (($col + $x) >= 7) || (($row + $y) < 0) || (($row + $y) >= 6)) {
                        $y++;
                        continue;
                    }
                    if ($board[$row + $y][$col + $x]['contents'] === $board[$row][$col]['contents']) {
                        if (++$consecutive === 4) {
                            for ($i = 0; $i < 4; $i++) {
                                $board[$row + $y][$col + $x]['victory'] = true;
                                $y--;
                            }
                            return $board;
                        }
                    } else {
                        $consecutive = 0;
                    }
                    $y++;
                }


                //x+ y-
                $x = -3;
                $y = 3;
                $consecutive = 0;
                while(($x <= 3) && ($y >= -3)) {
                    if ((($col + $x) < 0) || (($col + $x) >= 7) || (($row + $y) < 0) || (($row + $y) >= 6)) {
                        $x++;
                        $y--;
                        continue;
                    }
                    if ($board[$row + $y][$col + $x]['contents'] === $board[$row][$col]['contents']) {
                        if (++$consecutive === 4) {
                            for ($i = 0; $i < 4; $i++) {
                                $board[$row + $y][$col + $x]['victory'] = true;
                                $x--;
                                $y++;
                            }
                            return $board;
                        }
                    } else {
                        $consecutive = 0;
                    }
                    $x++; 
                    $y--;
                }

                //x+ y+
                $x = 3;
                $y = 3;
                $consecutive = 0;
                while(($x >= -3) && ($y >= -3)) {
                    if ((($col + $x) < 0) || (($col + $x) >= 7) || (($row + $y) < 0) || (($row + $y) >= 6)) {
                        $x--;
                        $y--;
                        continue;
                    }
                    if ($board[$row + $y][$col + $x]['contents'] === $board[$row][$col]['contents']) {
                        if (++$consecutive === 4) {
                            for ($i = 0; $i < 4; $i++) {
                                $board[$row + $y][$col + $x]['victory'] = true;
                                $x++;
                                $y++;
                            }
                            return $board;
                        }
                    } else {
                        $consecutive = 0;
                    }
                    $x--; 
                    $y--;
                }
            }
            if ($data['board'][0][$column]['contents'] !== 'empty') {
                return false;
            }
            if ($data['player_turn'] == true) {
                if (GameTestsquare::findOrFail($id)->users()->where('user_id', Auth::user()->id)->first()->pivot->player_number != 1) {
                    return false;
                }
            } else {
                if (GameTestsquare::findOrFail($id)->users()->where('user_id', Auth::user()->id)->first()->pivot->player_number != 2) {
                    return false;
                }
            }
            $data['player_turn'] = !$data['player_turn'];
            $data['turn_count']++;
            $row_number = 0;
            while((++$row_number < 6) && ($data['board'][$row_number][$column]['contents'] === 'empty'));
            $row_number--;
            $data['board'][$row_number][$column]['contents'] = ($data['player_turn'] ? 'red' : 'blue'); //Opposite of normal because player turn was already swapped here
            $data['board'][$row_number][$column]['turn_played'] = $data['turn_count'];
            $temp = check_victory($row_number, $column, $data['board'], $id);
            if ($temp) {
                $data['board'] = $temp;
                $data['game_running'] = false;
            }
            return $data;
        }
        function reset($id) {
            $board_arr = array();
            for($i = 0; $i < 6; $i++){
                $board_arr[$i] = array();
                for($j = 0; $j < 7; $j++) {
                    $board_arr[$i][$j] = ['contents' => 'empty', 'turn_played' => -1, 'victory' => false];
                }
            }
            $game = GameTestsquare::findOrFail($id);
            $game->data = json_encode(['board' => $board_arr, 'turn_count' => 0, 'player_turn' => true, 'game_running' => true]);
            $game->save();
        }
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $json_input = json_decode(file_get_contents("php://input"), true);
        $gamefile = json_decode(GameTestsquare::findOrFail($id)->data, true);
        switch($json_input['mtype']) {
            case 'poll':
            if ($json_input['turnnumber'] != $gamefile['turn_count']) {
                return response()->json(['mtype' => 'update_game', 'gamefile' => $gamefile]);;
            } else {
                return response()->json(['mtype' => 'wait']);
            }
            break;
            case 'move':
            $move = move($json_input['column'], $gamefile, $id);
            if ($move) {
                $tempgame = GameTestsquare::findOrFail($id);
                $tempgame->data = json_encode($move);
                $tempgame->save();
                return response()->json(['mtype' => 'wait']);
            } else {
                return response()->json(['mtype' => 'update_game', 'gamefile' => $gamefile]);
            }
            break;
            case 'reset':
            reset($id);
            return response()->json(['mtype' => 'wait']);
            break;
            default:
            break;
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
