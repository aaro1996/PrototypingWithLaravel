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
        Schema::create('gameTestsquares', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('turn_number')->default(1);
            $table->string('name', 200);
            $table->unique('name');
        });

        Schema::create('gameTestsquare_user', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('gameTestsquare_id')->unsigned();
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
        Schema::dropIfExists('gameTestsquares');
        Schema::dropIfExists('gameTestsquare_user');
    }
}
