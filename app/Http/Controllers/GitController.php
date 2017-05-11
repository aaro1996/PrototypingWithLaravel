<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = "testkey";
		$secret = getallheaders()['X-Hub-Signature'];
		$output = $secret;
		if ($secret == null) {
			$output = 'nokey';
		}
		if($request->has('ref') && $request->input('ref') === "refs/heads/master" && $secret === $gitkey)
		{
			shell_exec("/usr/bin/git pull origin master");
			$output = 'Success!!!!';
		}
		return $output;
	}

}
