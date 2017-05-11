<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = "testkey";

		if($request->isMethod('post') && $lel === $gitkey)
		{
			echo shell_exec("git pull");
		}
	}

}
