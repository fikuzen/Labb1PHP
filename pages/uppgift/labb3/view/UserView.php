<?php
	class UserView {
		
		private $m_registerName = "register";
		private $m_deleteName = "delete";
		private $m_forgotPassName = "forgotPass";
		private $m_registerUsername = "username";
		private $m_registerPassword = "password";
		private $m_registerPasswordAgain = "passwordAgain";
		private $m_errorMessages = array();
		private $m_validator;
		
		public function __construct() {
			$this->m_validator = new Validator();
		}
		
		public function getUsername() { return isset($_POST[$this->m_registerUsername]) ? $_POST[$this->m_registerUsername] : NULL; }
		public function getPassword() { return isset($_POST[$this->m_registerPassword]) ? $_POST[$this->m_registerPassword] : NULL; }
		public function getPasswordAgain() { return isset($_POST[$this->m_registerPasswordAgain]) ? $_POST[$this->m_registerPasswordAgain] : NULL; }
		
		public function triedToRegister() {
			return isset($_POST[$this->m_registerName]);
		}
		
		public function triedToRecoverPass() {
			return isset($_POST[$this->m_forgotPassName]);
		}
		
		public function triedToDeleteUser() {
			return isset($_POST[$this->m_deleteName]);
		}
		
		private function validateUsername(){ return $this->m_validator->validateUsername($this->getUsername()); }
		private function validatePassword(){ return $this->m_validator->validatePassword($this->getPassword()); }
		private function validatePasswordMatch() {
			if ( $this->getPassword() != $this->getPasswordAgain() ) {
				$this->m_errorMessages[] = "Passwords doesn't match";
				return false;
			}
			return true;
		}
		
		public function setErrorMessages() {
			foreach ($this->m_validator->getErrorMessages() as $errorMessage) {
				$this->m_errorMessages[] = $errorMessage;
			}
		}
		
		public function getErrorMessages() {
			var_dump($this->m_validator->getErrorMessages());
			return $this->m_errorMessages;
		}
		
		public function validateNewRegisteredUser() {
		
			$this->validateUsername();
			$this->validatePassword();
			$this->validatePasswordMatch();
			
			$errorMessage = $this->setErrorMessages();
			
			$ret = false;
			if (count($this->m_errorMessages) == 0) {
				$ret = true;
			}
			return $ret;
		}
		
		public function doForgotPassPart() {
			return array('header' => 
							'Glömt Lösenord',
							'subNav' =>
							'<li><a class="btn btn-small btn-success" href="index.php">Tillbaka</a></li>',
							'left' =>
							"
								<form action=\"index.php\" method=\"post\">
									<label for=\"$this->m_registerUsername\">Användarnamn</label>
									<input type=\"text\" id=\"$this->m_registerUsername\" name=\"$this->m_registerUsername\" /><br />
									<input type=\"submit\" class=\"btn btn-small\" name=\"$this->m_forgotPassName\" value=\"Skicka Lösenord\" />
								</form>
							",
							'right' =>
							"
								<div class=\"alert\">
						    		<button type=\"button\" id=\"loginFormClose\" data-dismiss=\"alert\" class=\"close\">×</button>
									Implementationen är inte klar för glömt lösenord.
								</div>
							");
		}
		
		public function doRegisterPart() {
			return array('header' => 
							'Registrera',
							'subNav' =>
							'<li><a class="btn btn-small btn-success" href="index.php">Tillbaka</a></li>',
							'left' =>
							"
								<form action=\"index.php" . NavigationView::getRegistrationLink() . "\" method=\"post\">
									<label for=\"$this->m_registerUsername\">Användarnamn</label>
									<input type=\"text\" id=\"$this->m_registerUsername\" name=\"$this->m_registerUsername\" />
									<label for=\"$this->m_registerPassword\">Lösenord</label>
									<input type=\"password\" id=\"$this->m_registerPassword\" name=\"$this->m_registerPassword\" />
									<label for=\"$this->m_registerPasswordAgain\">Lösenord igen</label>
									<input type=\"password\" id=\"$this->m_registerPasswordAgain\" name=\"$this->m_registerPasswordAgain\" /><br />
									<input type=\"submit\" name=\"$this->m_registerName\" class=\"btn btn-small\" value=\"Registrera\" />
								</form>
							",
							'right' =>
							'Test');
		}

		public function doDeleteUserPart() {
			return array('header' => 
							'Tabort användare',
							'subNav' =>
							'<li><a class="btn btn-small btn-success" href="index.php">Tillbaka</a></li>',
							'left' =>
							"
								<form action=\"index.php" . NavigationView::getDeleteUserLink() . "\" method=\"post\">
									<label for=\"$this->m_registerUsername\">Användarnamn</label>
									<input type=\"text\" id=\"$this->m_registerUsername\" name=\"$this->m_registerUsername\" /><br />
									<input type=\"submit\" name=\"$this->m_deleteName\" class=\"btn btn-small\" value=\"Ta bort\" />
								</form>
							",
							'right' =>
							'Test');
		}

		public function doFailURL() {
			return array('header' =>
							'Felaktig URL',
							'subNav' =>
							'<li><a class="btn btn-small btn-success" href="' . NavigationView::getHistoryLink() . '">Tillbaka</a></li>',
							'left' =>
							'<div class="alert alert-warning">
								<p>Du har angivet en ogiltig URL</p>
							</div>',
							'right' =>
							'');
		}
		
		public function doRecoverPass() {
			return array('header' =>
							'Felaktig URL',
							'subNav' =>
							'<li><a class="btn btn-small btn-success" href="' . NavigationView::getHistoryLink() . '">Tillbaka</a></li>',
							'left' =>
							'<div class="alert alert-warning">
								<p>Du har angivet en ogiltig URL</p>
							</div>',
							'right' =>
							'');
		}
		public function doRegisterSuccessMessage() {
			return array('header' =>
							'Gratulerar',
							'subNav' =>
							'<li><a class="btn btn-small btn-success" href="index.php">Logga in</a></li>',
							'left' =>
							"",
							'right' =>
							"
								<div class=\"alert alert-success\">
						    		<button type=\"button\" id=\"loginFormClose\" data-dismiss=\"alert\" class=\"close\">×</button>
									Du lyckades registrera dig med användarnamnet: " . $this->getUsername() . "
								</div>
							");
		}

		public function doDeleteSuccessMessage() {
			return array('header' =>
							'Borttagen användare lyckades',
							'subNav' =>
							'',
							'left' =>
							"",
							'right' =>
							"
								<div class=\"alert alert-success\">
						    		<button type=\"button\" id=\"loginFormClose\" data-dismiss=\"alert\" class=\"close\">×</button>
									Du tog bort användaren: " . $this->getUsername() . "
								</div>
							");
		}
		
		public function doErrorList($error) {
			$ret = "<div class=\"alert alert-error\">
						<button type=\"button\" id=\"loginFormClose\" data-dismiss=\"alert\" class=\"close\">×</button>";
			foreach ($error as $errorMessage) {
				$ret .= "<p>$errorMessage</p>";
			}
			$ret .= "</div>";
			return $ret;
		}
	}
