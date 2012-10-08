<?php

class Database {
	private $mysqli = NULL;
	
	public function Connect(DBSettings $dbsettings) {
			
		$this->mysqli = new mysqli($dbsettings->getHost(), 
									$dbsettings->getUser(), 
									$dbsettings->getPass(), 
									$dbsettings->getDB());
		if($this->mysqli->connect_error) {
			throw new Exception($this->mysqli->connect_error);
		}
		
		$this->mysqli->set_charset("utf8");
		return true;
	}
	
	public function SelectOne($stmt) {
		
		$ret = 0;
				
		if (!$stmt->execute()) {
			throw new Exception($this->mysqli->error);
		}
		
		if (!$stmt->bind_result($ret)) {
			throw new Exception($this->mysqli->error);
		}
		
		$stmt->fetch();
		
		$stmt->close();
		
		return $ret;
		
	}
	
	public function ExecuteSelectQuery($stmt) {

		if (!$stmt) {
			throw new Exception($this->mysqli->error, $this->mysqli->errno);
		}
		
		// Executes the query and throw exception if it fails.
		if (!$stmt->execute()) {
			throw new Exception($this->mysqli->error, $this->mysqli->errno);
		}
		
		$ret = mysqli_fetch_assoc($stmt->get_result());
		
		$stmt->close();
		return $ret;
	}
	
	public function ExecuteInsertQuery(mysqli_stmt $stmt) {
		
		// Possible prepare errors is caught
		if (!$stmt) {
			throw new Exception($this->mysqli->error);
		}
		
		// Executes the query and throw exception if it fails.
		if(!$stmt->execute()) {
			throw new Exception($this->mysqli->error, $this->mysqli->errno);
		}
		
		$ret = $stmt->insert_id;
		
		$stmt->close();
		
		return $ret;
	}
	
	public function ExecuteRemoveQuery(mysqli_stmt $stmt)
		{		
			// Possible prepare errors is caught
			if (!$stmt) {
				throw new Exception($this->mysqli->error, $this->mysqli->errno);
			}
			
			// Executes the query and throw exception if it fails.
			if (!$stmt->execute()) {
				throw new Exception($this->mysqli->error, $this->mysqli->errno);
			}
			
			$stmt->close();
			
			return true;
		}
	
	/**
	 * Prepares a SQL Query
	 * @param $sql String SQL Query
	 * @return mysqli_stmt
	 */
	public function Prepare($sql) {
		$ret = $this->mysqli->prepare($sql);
		
		if (!$ret) {
			throw new Exception($this->mysqli->error);
		}
		
		return $ret;
	}
	
	public function Close() {
		return $this->mysqli->close();
	}
	
	public static function test($dbsettings) {
		// Create the error Array
		$errors = array();
		
		// Create an instance of the object
		$sut = new Database();
		
		/**
		 * Can we connect to the Database?
		 */
		if (!$sut->Connect($dbsettings)) {
			$errors[] = "Database conenction failed.";
		}
		
		/**
		 * Count users
		 */
		$stmt = $sut->Prepare("SELECT COUNT(*) FROM user");
		try {
			$usersBeforeFailedInsert = $sut->SelectOne($stmt);
		} catch (exception $e) {
			$errors[] = "Database get user count failed.";
		}
		
		/**
		 * Insert user with a static username, should already exist.
		 */
		$username = "testuser";
		$password = "testuser22";		
		$stmt = $sut->Prepare("INSERT INTO user (username, password) VALUES (?,?)");
		
		$stmt->bind_param('ss', $username, $password);
		
		// Tries to insert a user that already exists
		try {
			$sut->ExecuteInsertQuery($stmt);
			$errors[] = "Inserted a user with a username that already exists";
		} catch(Exception $e) {
			// test success
		}
		
		/**
		 * Insert user with a unique username.
		 */
		$stmt = $sut->Prepare("SELECT COUNT(*) FROM user");
		$usersInDatabaseBeforeInsert = $sut->SelectOne($stmt);
		
		// Add a counter of users in database after username to make username unique.
		$username = "testuser" . $usersInDatabaseBeforeInsert;
		$password = "testuser22";		
		
		$stmt = $sut->Prepare("INSERT INTO user (username, password) VALUES (?,?)");
		
		$stmt->bind_param('ss', $username, md5($password));
		
		// Tries to insert a user with unique username
		try {
			$sut->ExecuteInsertQuery($stmt);
		} catch(Exception $e) {
			$errors[] = "Failed to insert a user with a unique username.";
		}
		
		/**
		 * Delete the testuser from the Unique test.
		 */
		 $stmt = $sut->Prepare("SELECT COUNT(*) FROM user");
		 $usersInDatabaseBeforeDelete = $sut->SelectOne($stmt);
		 
		 $username = "testuser" . $usersInDatabaseBeforeInsert;
		 $stmt = $sut->Prepare("DELETE FROM user WHERE username = ?");
		 $stmt->bind_param('s', $username);
		 
		 // Tries to delete the user with a unique username
		try {
			$sut->ExecuteRemoveQuery($stmt);
		} catch(Exception $e) {
			$errors[] = "Failed to delete the user with a unique username.";
		}
		
		/**
		 * Can we disconnect from the Database?
		 */ 
		if(!$sut->Close()) {
			$errors[] = "Database disconnect failed.";
		}
		
		return $errors;
	}
}
