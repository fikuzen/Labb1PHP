<?php

class LoginModel {
	private static $m_sessionLoggedIn = "loggedIn";
	
	private $m_db = NULL;
		
		
	public function __construct(Database $db) {
		$this->m_db = $db;
	}
	
	/**
	 * Any user logged in?
	 * 
	 * @return BOOLEAN, True = logged in, False = not logged in
	 */
	public static function isLoggedIn() {
		return isset($_SESSION[self::$m_sessionLoggedIn]) ? true : false;
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
		$correctLogIn = false;
		$stmt = $this->m_db->Prepare("SELECT * FROM user WHERE username = ?");
		$stmt->bind_param('s', $tryUser);
		$user = $this->m_db->ExecuteSelectQuery($stmt);
		if(isset($user)) {
			if($user['password'] == md5($tryPassword)) {
				$_SESSION[self::$m_sessionLoggedIn] = true;
				$correctLogIn = true;
			}
		}

		// Throw Exception if login information is wrong.
		
		if(isset($correctLogIn)){
			if(!$correctLogIn) {
				throw new Exception("Wrong username or password", 2002);
			}
			return $correctLogIn;
		}
	}
	
	
	/**
	 * Loggin out a user
	 */
	public function doLogout() {
		if(isset($_SESSION[self::$m_sessionLoggedIn])) {
			unset($_SESSION[self::$m_sessionLoggedIn]);
		}
	}
	
	/**
	 * Automatic Unittest.
	 * 
	 * @return StringArray, Error list.
	 * @param $db Database.
	 */
	public static function test(Database $db) {
		
		// Creates and error array.
		$errors = array();
		
		// Creates a System Under Test object.
		$sut = new LoginModel($db);
		
		// Shouldn't be logged in.
		if (LoginModel::IsLoggedIn()){
			$errors[] = 'Something is wrong with the IsLoggedIn() function "When you shouldn\'t be logged in" ' . __LINE__;
		}
			
		// DoLogin fail user
		 try {
			$sut->DoLogin("Fiskpinne", "Fläskpannkaka");
			// Test failed.
			$errors[] = 'Something is wrong with the DoLogin("Fiskpinne", "Fläskpannkaka") function ' . __LINE__;
		} catch (exception $e) {
			// Test success		
		}
		
		// DoLogin success user
		if(!($sut->DoLogin("Fisk", "Fisk22"))){
			$errors[] = 'Something is wrong with the DoLogin("Fisk", "Fisk22") function ' . __LINE__;
		}
		
		// Should be logged in.
		if(!(LoginModel::IsLoggedIn())){
			$errors[] = 'Something is wrong with the IsLoggedIn() function "When you should be logged in ' . __LINE__;
		}
		
		// Logging out the inlogged test user.
		$sut->DoLogout();		
		if($sut->isLoggedIn()){
			$errors[] = 'Something is wrong with the DoLogout() function ' . __LINE__;	
		}
		
		// DoLogin right username, fail password
		try {
			$sut->DoLogin("Fisk", "Fisken22");
			// Test failed.
			$errors[] = 'Something is wrong with the DoLogin("Fisk", "Fisken22") function ' . __LINE__;
		} catch (exception $e) {
			// Test success.			
		}
		
		// DoLogin fail username, right password
		try {
			$sut->DoLogin("Fisken", "Fisk22");
			// Test failed.
			$errors[] = 'Something is wrong with the DoLogin("Fisken", "Fisk22") function ' . __LINE__;
		} catch (exception $e) {
			// Test success.			
		}

		return $errors;
	}
}