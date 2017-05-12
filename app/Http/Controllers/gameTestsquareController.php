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
    			$game = new GameTestsquare;
    			$game->name = $request->name;
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
    		if(!($gamePlayer = Auth::user()->gameTestsquares()->where('game_testsquare_id', $id)->get())) {
                $new_num = 1;
                if ($users = $game->users()->get()) {
                    foreach ($users as $user) {
                        $new_num = max($user->pivot->player_number + 1, $new_num);
                    }
                    $new_num = $hpm->pivot->player_number + 1;
                }
                Auth::user()->attach($id, ['player_number' => $new_num]);
                $gamePlayer = $game->users()->where('user_id', Auth::user()->id)->get()->first();
                error_log($gamePlayer);
            }
            return view('gameboard.implementations.testsquare', ['playernum' => $gamePlayer->pivot->player_number, 'gamenum' => $id]);
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
