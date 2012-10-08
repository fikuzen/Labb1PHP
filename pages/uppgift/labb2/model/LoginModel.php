<?php

class LoginModel {
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
		return isset($_SESSION[$this->m_sessionLoggedIn]) ? true : false;
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
				// Wrong Username or password
			 	$correctLogIn = false;	
			}
		}
		// Throw Exception if login information is wrong.
		if($correctLogIn == false) {
			throw new Exception("Wrong username or password", 2002);
		}
		return $correctLogIn;
	}
	
	
	/**
	 * Loggin out a user
	 */
	public function doLogout() {
		unset($_SESSION[$this->m_sessionLoggedIn]);
	}
	
	/**
	 * Automatic Unittest.
	 * 
	 * @return StringArray, Error list.
	 */
	public static function Test() {
		
		// Creates a System Under Test object.
		$sut = new LoginModel();
		
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