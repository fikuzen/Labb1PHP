<?php

class LoginHandler{
	private $m_sessionLoggedIn = "loggedIn";
			
	// Create temporary Users
	private $users = array("Fisk" => "Fisk22", "Fisken" => "Fisken22", "Sture" => "Sture22");	
	
	// Create a error array
	public $errors = array();
	
	// Is the user loggedin?
	public function isLoggedIn() {
		if($_SESSION[$this->m_sessionLoggedIn]) {
			return true;
		}
		return false;
	}
	
	// Logging in a user if the password is right.
	public function doLogin($tryUser, $tryPassword) {
		
		/* 
		 * Creates a test for all users.
		 * Checking if the users exists.
		 * Checking if the password is equal to the relevant user.
		 */
		 foreach ($this->users as $user => $password) {
			 if($tryUser == $user && $tryPassword == $password) {
			 	$_SESSION[$this->m_sessionLoggedIn] = true;
				return true;
			 } else {
			 	if ($tryUser != $user) {
			 		throw new Exception("Användaren finns inte i arrayen", 2002);
			 	} elseif ($tryPassword != $password) {
			 		throw new Exception("Felaktigt lösenord", 2003);
			 	}
			 	return false;	
			 }
		 }
	}
	
	// Logging out a user.
	public function doLogout() {
		$_SESSION[$this->m_sessionLoggedIn] = false;
	}
	
	// Automatiska enhetstest.
	public static function Test() {
		$sut = new LoginHandler();
		
		// Logging out a user.
		$sut->DoLogout();
		
		// Shouldn't be logged in.
		if ($sut->IsLoggedIn()){
			array_push($sut->errors, "Something is wrong with the IsLoggedIn() function \"When you shouldn't be logged in\"");
		}
			
		// DoLogin fail user
		try {
			$sut->DoLogin("Fiskpinne", "Fläskpannkaka");
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fiskpinne\", \"Fläskpannkaka\") function");
		} catch (exception $e) {			
		}
		
		// DoLogin success user
		if(!($sut->DoLogin("Fisk", "Fisk22"))){
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisk\", \"Fisk22\") function");
		}
		
		// Should be logged in.
		if(!($sut->IsLoggedIn())){
			array_push($sut->errors, "Something is wrong with the IsLoggedIn() function \"When you should be logged in\"");
		}
		
		// Logging out the inlogged test user.
		$sut->DoLogout();		
		if($sut->isLoggedIn()){
			array_push($sut->errors, "Something is wrong with the DoLogout() function");	
		}
		
		// DoLogin right username, fail password
		try {
			$sut->DoLogin("Fisk", "Fisken22");
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisk\", \"Fisken22\") function");
		} catch (exception $e) {			
		}
		
		// DoLogin fail username, right password
		try {
			$sut->DoLogin("Fisken", "Fisk22");
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisken\", \"Fisk22\") function");
		} catch (exception $e) {			
		}

		return $sut->errors;
	}
}