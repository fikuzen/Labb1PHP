<?php

	class NavigationView {
		private static $m_userQuery = "user";
		private static $m_registerNewUser = "newUser";
		private static $m_forgotPass = "forgotPassword";
		private static $m_deleteUser = "deleteUser";
		
		public static function getUserQuery() { return self::$m_userQuery; }
		public static function getRegisterNewUser() { return self::$m_registerNewUser; }
		public static function getForgotPass() { return self::$m_forgotPass; }
		public static function getDeleteUser() { return self::$m_deleteUser; }
		
		public static function isRegistration() {
			if ( isset($_GET[self::$m_userQuery]) ){
				if ( $_GET[self::$m_userQuery] == self::$m_registerNewUser ) {
					return true;
				}
			}
			return false;
		}
		
		public static function isForgotPassword() {
			if ( isset($_GET[self::$m_userQuery]) ){
				if ( $_GET[self::$m_userQuery] == self::$m_forgotPass ) {
					return true;
				}
			}
			return false;
		}
		
		public static function isDeleteUser() {
			if ( isset($_GET[self::$m_userQuery]) ){
				if ( $_GET[self::$m_userQuery] == self::$m_deleteUser ) {
					return true;
				}
			}
			return false;
		}
		
		public static function getHistoryLink() {
			return "javascript:history.back()";
		}
		
		public static function getRegistrationLink() {
			return "?" . self::$m_userQuery . "=" . self::$m_registerNewUser;
		}
		
		public static function getForgotPassLink() {
			return "?" . self::$m_userQuery . "=" . self::$m_forgotPass;
		}
		
		public static function getDeleteUserLink() {
			return "?" . self::$m_userQuery . "=" . self::$m_deleteUser;
		}
	}
