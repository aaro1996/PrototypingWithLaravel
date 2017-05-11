<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$input = file_get_contents("php://input");
		$gitkey = hash_hmac("sha1", $input,"testkey");
		$secret = substr(getallheaders()['X-Hub-Signature'], 5);
		$output = $secret;
		if ($secret == null) {
			$output = 'nokey';
		}
		$json = json_decode($input, true);
		if(isset($json['ref']) 
			&& $json['ref'] === 'refs/heads/master' 
			&& md5($secret) === md5($gitkey))
		{
			shell_exec("/usr/bin/git pull origin master");
			return 'Success!!!!';
		}
		return ("Secret was: " . $secret . " Gitkey was: " . $gitkey . "\n" . 
			(isset($json['ref']) ? "Request had ref" : "Request didn't have ref") . "\n" . 
			(isset($json['ref']) && $json['ref'] === "refs/heads/master" ? "Request was master" : "Request was not master") . "\n" .
			( md5($secret) === md5($gitkey) ? "Keys were equal" : "Keys weren't equal")
			);
	}

}
