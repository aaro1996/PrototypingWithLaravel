<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTestsquareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_testsquares', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('turn_number')->default(1);
            $table->string('name', 200);
            $table->unique('name');
            $table->json('data');
        });

        Schema::create('game_testsquare_user', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('game_testsquare_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('player_number')->signed();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_testsquares');
        Schema::dropIfExists('game_testsquare_user');
    }
}
