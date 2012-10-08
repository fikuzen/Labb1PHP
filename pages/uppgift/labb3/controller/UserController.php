<?php

	require_once('../view/UserView.php');
	require_once('../model/UserModel.php');
	require_once('../model/validate/Validator.php');
	
	class UserController {
		private static $m_db = "";
		private static $m_status = null;
		
		public function __construct(Database $db) {
			self::$m_db = $db;
			self::$m_status = $_GET[NavigationView::getUserQuery()];
		}
		public function doControll() {
			$html = array();
			
			$userView = new UserView();
			$userModel = new UserModel(self::$m_db);
			
			if ( isset(self::$m_status) ) {
				if ( self::$m_status == NavigationView::getForgotPass()) {
					$html = $userView->doForgotPassPart();
				}
				else if ( self::$m_status == NavigationView::getRegisterNewUser() ) {
					$html = $userView->doRegisterPart();
					if( $userView->triedToRegister() ) {
						if( $userView->validateNewRegisteredUser() ) {
							if ( $userModel->isRegistered($userView->getUsername()) ) {
								if ( $userModel->doRegisterUser($userView->getUsername(), $userView->getPassword()) ) {
									$html = $userView->doRegisterSuccessMessage();
								}
							}
						}
						else {
							$html['right'] = $userView->doErrorList($userView->getErrorMessages());
						}
					}
				}
				else if ( self::$m_status == NavigationView::getDeleteUser() ) {
					$html = $userView->doDeleteUserPart();
						if( $userView->triedToDeleteUser() ) {
							try {
								if ( $userModel->doDeleteUser($userView->getUsername()) ) {
									$html = $userView->doDeleteSuccessMessage();
								}
							} catch (exception $e) {
								$html = $userView->doErrorList($e->getMessage());
							}
						}
				}
				else {
					$html = $userView->doFailURL();
				}
			}
			
			return $html;
		}
		
	}
