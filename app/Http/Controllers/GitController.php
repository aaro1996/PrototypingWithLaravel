<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = "testkey";
		$secret = $request->input('hook.secret');
		$output = $secret;
		if($request->has('ref') && $request->input('ref') === "refs/heads/master" && $secret === $gitkey)
		{
			$output = shell_exec("/usr/bin/git pull origin master");
		}
		return $output;
	}

}
