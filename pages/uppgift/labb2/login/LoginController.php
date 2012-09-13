<?php

	require_once('LoginView.php');
	require_once('LoginHandler.php');
	
	class LoginController {
		
		public function doControll(){
			$loginView = new LoginView();
			$loginHandler = new LoginHandler();
			
			$authStatus = LoginView::OUTLOGGED;
			$loginError = false;
			
			if($loginHandler->isLoggedIn()) {
				if($loginView->triedToLogout()){
			 		$loginHandler->doLogout();
					$authStatus = LoginView::OUTLOGGED;	
				}
			}
			if($loginView->triedToLogin()) {
				if($loginHandler->doLogin($loginView->getUserName(), $loginView->getPassword())){
					$authStatus = LoginView::INLOGGED;	
				} else {
					$loginError = true;
				}
			}
			
			// Boolean
			$userHasLoggedIn = $loginHandler->isLoggedIn();
			
			return $loginView->doOutput($userHasLoggedIn, $authStatus, $loginError);
		}
	}
