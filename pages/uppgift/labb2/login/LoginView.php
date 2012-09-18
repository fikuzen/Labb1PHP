<?php

class LoginView{
	
	private $m_controllerName = "LoginController";
	private $m_cookieUsername = "Username";
	private $m_cookiePassword = "Password";
	
	private $m_username = "";
	private $m_password = "";
	
	private static $m_oneMinute = 60;
		
	// Get username
	public function getUserName() {
		if(isset($_POST['user'])) {
			return $_POST['user'];
		}
		return NULL;
	}
  
	// Get password
	public function getPassword() {
  		if(isset( $_POST['password'])) {
			return $_POST['password'];
  		}
  		return NULL;
	}
	
	// Did a user try to login?
	public function triedToLogin() {
		return isset($_POST['login']);
	}

	// User tried to logout?
	public function triedToLogout() {
  		return isset($_POST['logout']);
	}
	
	// Remember me or not?
	public function triedToRememberUser() {
		return isset($_POST['remember']);
	}
		
	// Which user should be remembered
	public function userToRemember($username, $password) {
		setcookie($this->m_cookieUsername, $username, time() + self::$m_oneMinute);
		setcookie($this->m_cookiePassword, $password, time() + self::$m_oneMinute);
	}
	
	public function forgetUser() {
		setcookie($this->m_cookieUsername, "", time() - self::$m_oneMinute);
		setcookie($this->m_cookiePassword, "", time() - self::$m_oneMinute);
	}
  
	// Generate HTMLcode to a user who is logged in
	public function doLogoutPart() {
	    return "
	    	<h2>$this->m_controllerName</h2>
	    	<div class=\"row\">
			    <div class='span4'>
				    <form method='post' action='index.php'>
				    	<input type='submit' name='logout' class='btn btn-small' value='Logga Ut'>
			    	</form>
			    </div>
			    <div class=\"span8\">				
			    	<div class=\"alert alert-success\">
						<p>Du är inloggad.</p>
					</div>
				</div>
		    </div><!-- End of ROW1 -->
	    ";
	}
  
  	// Generate HTMLcode to a user who ain't logged in.
	public function doLoginPart() {
		$this->m_username = isset($_COOKIE[$this->m_cookieUsername]) ? $_COOKIE[$this->m_cookieUsername] : "";
		$this->m_password = isset($_COOKIE[$this->m_cookiePassword]) ? $_COOKIE[$this->m_cookiePassword] : "";
	    return "
	    	<h2>$this->m_controllerName</h2>
	    	<div class=\"row\">
	    		<div class=\"span4\">
				    <form class=\"form-horizontal\" method=\"POST\" action=\"index.php\">
						<label for=\"user\">Användarnamn</label>
						<input type=\"text\" value=\"$this->m_username\" placeholder=\"Användarnamn\" name=\"user\" id=\"user\" />
						<label for=\"password\">Lösenord</label>
						<input type=\"password\" value=\"$this->m_password\" placeholder=\"Lösenord\" name=\"password\" id=\"password\" /><br />
						<div class=\"checkbox\">
						<label for=\"remember\">Kom ihåg mig
						<input type=\"checkbox\" name=\"remember\" id=\"remember\"><br />
						</div>
						<input type=\"submit\" id=\"login\" name=\"login\" class=\"btn btn-small\" value=\"Logga In\"/>
					</form>
				</div>
				<div class=\"span8\">
					<div class=\"alert alert-info\">
							<p>Du behöver logga in för att se mer information.</p>
					</div>
				</div>
			</div> <!-- End of Row1 -->
		";
	}

	// Generate HTMLcode for a errorList.
	// Takes a array of errors as param.
	public function doErrorList($errors) {
		if(count($errors) > 0){
			$errorBox = "
				<div class=\"row\">
					<div class=\"span4\">
						<div class=\"alert alert-error\">
			";
			foreach ($errors as $error) {
				$errorBox .= $error . "<br />";
			}
			$errorBox .= "
						</div>
					</div>
				</div>
			";
			return $errorBox;
		}
		return null;		
	}	
}