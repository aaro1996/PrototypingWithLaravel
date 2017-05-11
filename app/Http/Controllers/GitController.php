<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = "testkey";
<<<<<<< HEAD
		$output = "failed";
		if($request->isMethod('post') && $request->has('ref') && $request->input('ref') === "refs/heads/master" && $request->input('hook')['secret'] === $gitkey)
=======
		$secret = $request->input('hook.secret');
		$output = $secret;
		if($request->has('ref') && $request->input('ref') === "refs/heads/master" && $secret === $gitkey)
>>>>>>> bc5a4ce... reads secret better maybe?
		{
			$output = shell_exec("/usr/bin/git pull origin master");
		}
		return $output;
	}

}
