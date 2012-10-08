<?php

	require_once('../view/LoginView.php');
	require_once('../model/LoginModel.php');
	
	class LoginController {
		
		public function doControll(Database $db){
			/**
			 * Create instances of the Views, Controllers we're using.
			 */
			 
			$loginView = new LoginView();
			$loginModel = new LoginModel($db);
			
			// The possible login error.
			$loginError = "";
			
			// Are you logged in?
			if($loginModel->isLoggedIn()) {
				
				// Generate HTML Part to make it possible to logout
				$html = $loginView->doLogoutPart();
			}
			// Are you not logged in?
			else {
				// Generate HTML Part to make it possible to login
				$html = $loginView->doLoginPart();
			}
			
			// Did the user try to logout
			if($loginView->triedToLogout()){
				
				// Logout the user.
		 		$loginModel->doLogout();
				
				// Generate HTML part to Login again. 
				$html = $loginView->doLoginPart();	
			} 
			// Did the user try to login
			else if($loginView->triedToLogin()) {
				
				// Does the user want to save login Data 
				if($loginView->triedToRememberUser()){
					
					// Which username / password should be saved
					$loginView->userToRemember($loginView->getUserName(), $loginView->getPassword());
				} 
				// If the user doesn't want to be recognized
				else {
					
					// Delete the login Cookie
					$loginView->forgetUser();
				}
					
				/**
				 * Try & Catch because doLogin throw exception if the login information is wrong.
				 */
				try {
					// Try to login the user.
					if($loginModel->doLogin($loginView->getUserName(), $loginView->getPassword())){
						
						// Generate HTML part to make it possible to logout.
						$html = $loginView->doLogoutPart();
					}
				}
				catch (exception $e) {
					// Save the error.
					$html['left'] .= $loginView->doErrorList($e->getMessage());
				}
			}
			
			// Return the HTML and the possible login error.
			return $html;
		}
	}
