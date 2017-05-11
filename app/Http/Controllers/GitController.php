<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = hash_hmac("sha1", $request->all(),"testkey");
		$secret = getallheaders()['X-Hub-Signature'];
		$output = $secret;
		if ($secret == null) {
			$output = 'nokey';
		}
		if($request->has('ref') && $request->input('ref') === "refs/heads/master" && md5($secret) === md5($gitkey))
		{
			shell_exec("/usr/bin/git pull origin master");
			$output = 'Success!!!!';
		}
		return $output;
	}

}
