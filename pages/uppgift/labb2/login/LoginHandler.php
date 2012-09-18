<?php

class LoginHandler{
	private $m_sessionLoggedIn = "loggedIn";
			
	/**
	 * Create temporary Users
	 */
	private $users = array("Fisk" => "Fisk22", "Fisken" => "Fisken22", "Sture" => "Sture22");	
	
	/**
	 * Create a error array
	 */
	public $errors = array();
	
	/**
	 * Any user logged in?
	 * 
	 * @return BOOLEAN, True = logged in, False = not logged in
	 */
	public function isLoggedIn() {
		if($_SESSION[$this->m_sessionLoggedIn]) {
			return true;
		}
		return false;
	}
	
	/**
	 * Logging in a user if the password is right.
	 * 
	 * @param $tryUser String, attempted username
	 * @param $tryPassword String, attempted password
	 * @return Boolean, True = Login success, False = Login Failed.
	 */
	public function doLogin($tryUser, $tryPassword) {
		
		/* 
		 * Creates a test for all users.
		 * When a user tries to login.
		 */
		 foreach ($this->users as $user => $password) {
			 if($tryUser == $user && $tryPassword == $password) {
			 	$_SESSION[$this->m_sessionLoggedIn] = true;
				return true;
			 } else {
			 	// Username doesn't exist
			 	if ($tryUser != $user) {
			 		throw new Exception("The user doesn't exist.", 2002);
			 	} 
			 	// Wrong password.
			 	elseif ($tryPassword != $password) {
			 		throw new Exception("Wrong lösenord", 2003);
			 	}
			 	return false;	
			 }
		 }
	}
	
	
	/**
	 * Loggin out a user
	 */
	public function doLogout() {
		$_SESSION[$this->m_sessionLoggedIn] = false;
	}
	
	/**
	 * Automatic Unittest.
	 * 
	 * @return StringArray, Error list.
	 */
	public static function Test() {
		
		// Creates a System Under Test object.
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
			// Test failed.
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fiskpinne\", \"Fläskpannkaka\") function");
		} catch (exception $e) {
			// Test success		
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
			// Test failed.
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisk\", \"Fisken22\") function");
		} catch (exception $e) {
			// Test success.			
		}
		
		// DoLogin fail username, right password
		try {
			$sut->DoLogin("Fisken", "Fisk22");
			// Test failed.
			array_push($sut->errors, "Something is wrong with the DoLogin(\"Fisken\", \"Fisk22\") function");
		} catch (exception $e) {
			// Test success.			
		}

		return $sut->errors;
	}
}