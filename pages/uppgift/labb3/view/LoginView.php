<?php

class LoginView{
	
	private $m_controllerName = "LoginController";
	
	private $m_cookieUsername = "Username";
	private $m_cookiePassword = "Password";
	
	private $m_postLogout = "logout";
	private $m_postPassword = "password";
	private $m_postUsername = "username";
	private $m_postLogin = "login";
	private $m_postRemember = "remember";
	
	private $m_username = "";
	private $m_password = "";
	
	// Static variable for cookie timer. (1800 = 30minutes.)
	private static $m_cookieTimer = 1800;
		
	/**
	 * Get username
	 */
	public function getUserName() {
		if(isset($_POST[$this->m_postUsername])) {
			return $_POST[$this->m_postUsername];
		}
		return NULL;
	}
  
	/**
	 * Get password
	 */ 
	public function getPassword() {
  		if(isset( $_POST[$this->m_postPassword])) {
			return $_POST[$this->m_postPassword];
  		}
  		return NULL;
	}
	
	/**
	 * Did a user try to login?
	 */
	public function triedToLogin() {
		return isset($_POST[$this->m_postLogin]);
	}

	/**
	 * User tried to logout?
	 */
	public function triedToLogout() {
  		return isset($_POST[$this->m_postLogout]);
	}
	
	/**
	 * Remember me checkbox checked?
	 */
	public function triedToRememberUser() {
		return isset($_POST[$this->m_postRemember]);
	}
		
	/**
	 * Set a cookie with the Username, Password.
	 */
	public function userToRemember($username, $password) {
		setcookie($this->m_cookieUsername, $username, time() + self::$m_cookieTimer);
		setcookie($this->m_cookiePassword, $password, time() + self::$m_cookieTimer);
	}
	
	/**
	 * Removes the cookie for Username, Password.
	 */
	public function forgetUser() {
		setcookie($this->m_cookieUsername, "", time() - self::$m_cookieTimer);
		setcookie($this->m_cookiePassword, "", time() - self::$m_cookieTimer);
	}
  
	/**
	 * Generate HTMLcode to a user who is logged in
	 * 
	 * @return HTML CODE
	 */
	public function doLogoutPart() {
		
		// Returns a logout button.
	    return array(
	    		'header' => "
	    		Christoffers Filuppladdning
	    		",
	    		'subNav' => "",
	    		'left' => "
			    <form method='post' action='index.php'>
			    	<input type='submit' name='$this->m_postLogout' class='btn btn-large' value='Logga Ut'>
		    	</form>
			    ",
			   'right' => "				
		    	<div class=\"alert alert-success\">
		    		<button type=\"button\" id=\"loginFormClose\" data-dismiss=\"alert\" class=\"close\">×</button>
					Du är inloggad.
				</div>
	    ");
	}
  
  	/**
	 * Generate HTMLcode to a user who ain't logged in.
	 * 
	 * @return HTML CODE
	 */
	public function doLoginPart() {
		
		// Check if there's a cookie if there's a cookie load the login form with data for Username, Password.
		$this->m_username = isset($_COOKIE[$this->m_cookieUsername]) ? $_COOKIE[$this->m_cookieUsername] : "";
		$this->m_password = isset($_COOKIE[$this->m_cookiePassword]) ? $_COOKIE[$this->m_cookiePassword] : "";
		
		// Returns a login box.
	    return array(
    				'header' => "
	    			Christoffers Filuppladdning
	    			",
	    			'subNav' => "
						<li><a class='btn btn-small' href=" . NavigationView::getRegistrationLink() . ">Registrera</a></li>
						<li><a class='btn btn-small' href=" . NavigationView::getForgotPassLink() . ">Glömt Lösenord</a></li>
						<li><a class='btn btn-small' href=" . NavigationView::getDeleteUserLink() . ">Ta bort Användare</a></li>
					",
	    			'left' => "
	    			<button id=\"loginShowButton\" class=\"btn btn-large\">Logga in</button>
	    			<div id=\"loginForm\" class=\"alert alert-info\">
	    				<button type=\"button\" id=\"loginFormClose\" class=\"close\">×</button>
					    <form class=\"form-horizontal\" method=\"POST\" action=\"index.php\">
							<label for=\"$this->m_postUsername\">Användarnamn</label>
							<input type=\"text\" value=\"$this->m_username\" placeholder=\"Användarnamn\" name=\"$this->m_postUsername\" id=\"$this->m_postUsername\" />
							<label for=\"$this->m_postPassword\">Lösenord</label>
							<input type=\"password\" value=\"$this->m_password\" placeholder=\"Lösenord\" name=\"$this->m_postPassword\" id=\"$this->m_postPassword\" /><br />
							<div class=\"checkbox\">
							<label for=\"$this->m_postRemember\">Kom ihåg mig
							<input type=\"checkbox\" name=\"$this->m_postRemember\" id=\"$this->m_postRemember\"><br />
							</div>
							<input type=\"submit\" id=\"login\" name=\"$this->m_postLogin\" class=\"btn btn-small\" value=\"Logga In\"/>
						</form>
					</div>
					", 
					'right' => "
					<div class=\"alert alert-info\">
		    			<button type=\"button\" id=\"loginFormClose\" data-dismiss=\"alert\" class=\"close\">×</button>
						Du behöver logga in för att se mer information.
					</div>
					");
	}

	/**
	 * Generate HTMLcode for a errorList.
	 * Takes a array of errors as param.  
	 * 
	 * @return $errorBox HTML CODE
	 * @param $error an Error Message.
	 */ 
	public function doErrorList($error) {
		if($error != ""){
			
			// Påbörja row, span4, alert alert-error.
			$errorBox = "
				<div class=\"row\">
					<div class=\"span3\">
						<div class=\"alert alert-error\"> 
							" . $error . "<br />
						</div>
					</div>
				</div>";
			return $errorBox;
		}
		return null;		
	}	
}