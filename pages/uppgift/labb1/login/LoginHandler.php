<?php

class LoginHandler{
		
	// Create temporary Users
	private $users = array("Fisk", "Fisken", "Sture");
	private $password = array("Fisk22", "Fisken22", "Sture22");
	
	// Create a error array
	public $errors = array();
	
	// Is the user loggedin?
	public function IsLoggedIn() {
		if($_SESSION["loggedIn"]) {
			return true;
		}
		return false;
	}
	
	// Logging in a user if the password is right.
	public function DoLogin($user, $password) {
		
		/* 
		 * Creates a test for all users.
		 * Checking if the users exists.
		 * Checking if the password is equal to the relevant user.
		 */
		 
		for($i = 0; $i < count($this->users); $i++) {
			if($user == $this->users[$i]){
				if($password == $this->password[$i]){
					$_SESSION['loggedIn'] = true;
					return true;					
				}
				return false;
			}
		}
		
		/*
		switch($user) {
			case $this->users[0]:
				if($password == $this->password[0]){
					$_SESSION['loggedIn'] = true;
					return true;					
				}
				return false;
				
			case $this->users[1]:
				if($password == $this->password[1]){
					$_SESSION['loggedIn'] = true;
					return true;					
				}
				return false;
				
			case $this->users[2]:
				if($password == $this->password[2]){
					$_SESSION['loggedIn'] = true;
					return true;					
				}
				return false;
		}
		*/
	}
	
	// Logging out a user.
	public function DoLogout() {
		$_SESSION['loggedIn'] = false;
	}
	
	// Automatiska enhetstest.
	public function Test() {
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
		if($_SESSION["loggedIn"]){
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
}

?>