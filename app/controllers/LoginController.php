<?php

namespace App\controllers;
use App\Models\LoginModel;

class LoginController extends LoginModel {
	
	public function checkLogin(string $login, string $password): bool {

	    $prepareToHash = $login . "\n" . $password;
	    $hash = md5($prepareToHash);

		return $this->validate($login, $hash);
	}
}