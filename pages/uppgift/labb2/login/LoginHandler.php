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
			 		throw new Exception("Användaren finns inte i databasen", 2002);
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
	public function Test() {
		try {
			// Logging out a user.
			$this->DoLogout();
			
			// Shouldn't be logged in.
			if($this->IsLoggedIn()){
				array_push($this->errors, "Something is wrong with the IsLoggedIn() function \"When you shouldn't be logged in\"");
			}
			
			// DoLogin fail user
			if($this->DoLogin("Fiskpinne", "Fläskpannkaka")){
				array_push($this->errors, "Something is wrong with the DoLogin(\"Fiskpinne\", \"Fläskpannkaka\") function");
			}
			
			// DoLogin success user
			if(!($this->DoLogin("Fisk", "Fisk22"))){
				array_push($this->errors, "Something is wrong with the DoLogin(\"Fisk\", \"Fisk22\") function");
			}
			
			// Should be logged in.
			if(!($this->IsLoggedIn())){
				array_push($this->errors, "Something is wrong with the IsLoggedIn() function \"When you should be logged in\"");
			}
			
			// Logging out the inlogged test user.
			$this->DoLogout();		
			if($_SESSION[$this->m_sessionLoggedIn]){
				array_push($this->errors, "Something is wrong with the DoLogout() function");	
			}
			
			// DoLogin right username, fail password
			if($this->DoLogin("Fisk", "Fisken22")){
				array_push($this->errors, "Something is wrong with the DoLogin(\"Fisk\", \"Fisken22\") function");
			}
			
			// DoLogin fail username, right password
			if($this->DoLogin("Fisken", "Fisk22")) {
				array_push($this->errors, "Something is wrong with the DoLogin(\"Fisken\", \"Fisk22\") function");
			}
			
			// Return the error array.
			return $this->errors;
		}
		catch (exception $e) {
			
		}
	}
}