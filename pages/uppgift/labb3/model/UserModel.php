<?php
	class UserModel {
		private $m_db = NULL;
		
		public function __construct(Database $db) {
			$this->m_db = $db;
		}
		
		public function isRegistered($username) {
			$stmt = $this->m_db->Prepare("SELECT * FROM user WHERE username = (?)");
			$stmt->bind_param('s', $username);
			$users = $this->m_db->ExecuteSelectQuery($stmt);
			if($users['username'] == null) {
				return true;
			}
			else {
				throw new Exception("Username exists");
			}
		}
		
		/**
		 * Register a user into the database. 
		 *
		 * @param $username, String
		 * @param $password, String
		 * @return $registerStatus, Boolean
		 */
		public function doRegisterUser($username, $password) {
			
			$registerStatus = false;
			
			$stmt = $this->m_db->Prepare("INSERT INTO user (username, password) VALUES (?, ?)");
			$stmt->bind_param('ss', $username, md5($password));
			$user = $this->m_db->ExecuteInsertQuery($stmt);
			$registerStatus = true;
			
			return $registerStatus;
		}
		
		/**
		 * Delete a user. 
		 *
		 * @param $username, String,
		 * @return $deleteStatus, Boolean, 
		 */
		 public function doDeleteUser($username) {
				
			$deleteStatus = false;
			
			$stmt = $this->m_db->Prepare("DELETE FROM user WHERE username = ? ");
			$stmt->bind_param('s', $username);
			$deleteStatus = $this->m_db->ExecuteRemoveQuery($stmt);
			
			return $deleteStatus;
		}
		
		/**
		 * Automatic Unittest for the UserModel
		 *
		 * @param $db, Database
		 * @param $validator, Validator
		 * @return $errors, String Array
		 */
		public static function test(Database $db) {
			// Creates and error array.
			$errors = array();
			
			// Creates a System Under Test object.
			$sut = new UserModel($db);
			
			
			/**
			 * Register a user with valid username, password
			 */
			try {
				// make a unique name with a usercounter.
				$stmt = $db->Prepare("SELECT COUNT(*) FROM user");
				$userCounter = $db->SelectOne($stmt);
				if(!$sut->doRegisterUser("FlätadFisk" . $userCounter, "FlätadFisk22")) {
					// Test failed
					$errors[] = 'doRegisterUser("FlätadFisk" . $userCounter, "FlätadFisk22") failed. On line: ' . __LINE__;
				}
			} catch(exception $e) {
				// Test Success
			}
			
			/**
			 * Try to register a user which is already registered.
			 */
			 try {
			 	$sut->doRegisterUser("FlätadFisk" . $userCounter, "FlätadFisk22");
		 		$errors[] = 'doRegisterUser("FlätadFisk" . $userCounter, "FlätadFisk22") failed. On line: ' . __LINE__;
			 } catch (exception $e) {
			 	// Test success
			 }
			
			/**
			 * Delete a user
			 */
			try {
				$stmt = $db->Prepare("SELECT COUNT(*) FROM user");
				$userCounter = $db->SelectOne($stmt) - 1;
				if(!$sut->doDeleteUser("FlätadFisk" . $userCounter)) {
					// Test failed
					$errors[] = 'doDeleteUser("FlätadFisk" . $userCounter) failed. On line: ' . __LINE__;
				}
			} catch(exception $e) {
				// Test Success
			}
			
			return $errors;
		}
	}
