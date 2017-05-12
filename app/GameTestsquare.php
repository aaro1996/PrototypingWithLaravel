<?php
//Ascii art from  http://lunicode.com/bigtext

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameTestsquare extends Model
{
	
    public function users()
    {
    	return $this->belongsToMany('App\User');
    }
}