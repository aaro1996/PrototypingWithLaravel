<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = "testkey";

		if($request->isMethod('post') && $request->has('ref') && $request->input('ref') === "refs/heads/master" && $request->input('hook')['secret'] === $gitkey)
		{
			echo shell_exec("/usr/bin/git pull origin master");
		}
	}

}
