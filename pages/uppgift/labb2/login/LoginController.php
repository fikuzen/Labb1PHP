<?php

	require_once('LoginView.php');
	require_once('LoginHandler.php');
	
	class LoginController {
				
		public function doControll(){
			$loginView = new LoginView();
			$loginHandler = new LoginHandler();
			
			$loginError = array();
			
			if($loginHandler->isLoggedIn()) {
				$html = $loginView->doLogoutPart();
				if($loginView->triedToLogout()){
			 		$loginHandler->doLogout();
					$html = $loginView->doLoginPart();	
				}
			} else {
				$html = $loginView->doLoginPart();
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
