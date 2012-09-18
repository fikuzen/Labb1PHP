<?php

	require_once('LoginView.php');
	require_once('LoginHandler.php');
	
	class LoginController {
				
		public function doControll(){
			$loginView = new LoginView();
			$loginHandler = new LoginHandler();
			
			
			$html = $loginView->doLoginPart();
			$loginError = array();
			
			if($loginHandler->isLoggedIn()) {
				if($loginView->triedToLogout()){
			 		$loginHandler->doLogout();
					$html = $loginView->doLoginPart();	
				}
			}
			if($loginView->triedToLogin()) {
				try {
					if($loginView->triedToRememberUser()){
						$loginView->userToRemember($loginView->getUserName(), $loginView->getPassword());
					} else {
						$loginView->forgetUser();
					}
					if($loginHandler->doLogin($loginView->getUserName(), $loginView->getPassword())){
						$html = $loginView->doLogoutPart();
					}
				}
				catch (exception $e) {
					$loginError[] .= $e->getMessage();
				}
			}
			
			return $html . $loginView->doErrorList($loginError);
		}
	}
