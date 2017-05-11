<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class GitController extends Controller
{
	public function gitpull(Request $request) {
		$gitkey = hash_hmac("sha1", file_get_contents("php://input"),"testkey");
		$headers = getallheaders();
		$secret = substr($headers['X-Hub-Signature'], 5);
		$output = $secret;
		if ($secret == null) {
			$output = 'nokey';
		}
		if(isset($_POST['ref']) && $_POST['ref'] === "refs/heads/master" && md5($secret) === md5($gitkey))
		{
			shell_exec("/usr/bin/git pull origin master");
			return 'Success!!!!';
		}
		return ("Secret was: " . $secret . " Gitkey was: " . $gitkey . "\n" . 
			(isset($_POST['ref'] ? "Request had ref" : "Request didn't have ref") . "\n" . 
			($_POST['ref'] === "refs/heads/master" ? "Request was master" : "Request was not master") . "\n" .
			( md5($secret) === md5($gitkey) ? "Keys were equal" : "Keys weren't equal")
			);
	}

}
