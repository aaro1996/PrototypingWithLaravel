<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = hash_hmac("sha1", file_get_contents("php://input"),"testkey");
		$secret = substr(getallheaders()['X-Hub-Signature'], 5);
		$output = $secret;
		if ($secret == null) {
			$output = 'nokey';
		}
		if($request->has('ref') && $request->input('ref') === "refs/heads/master" && md5($secret) === md5($gitkey))
		{
			shell_exec("/usr/bin/git pull origin master");
			return 'Success!!!!';
		}
		return ("Secret was: " + $secret + " Gitkey was: " + $gitkey;
	}

}
