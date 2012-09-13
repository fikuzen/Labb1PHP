<?php

class LoginView{
	const INLOGGED = 0;
	const OUTLOGGED = 1;
	
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
		if(isset($_POST['login'])){
			return true;
  		}
		return false;
	}

	// User tried to logout?
	public function triedToLogout() {
  		if(isset($_POST['logout'])){
  			return true;
  		}
		return false;
	}
	
	public function doOutput($userHasLoggedIn, $authStatus, $loginError) {
		if($userHasLoggedIn) {
		    $form = "
				<form method='post' action='index.php'>
			    	<input type='submit' name='logout' class='btn btn-small' value='Logga Ut'>
		    	</form>
			";
		} else {
			$form = "
			    <form class='form-horizontal' method='POST' action='index.php'>
					<label for='user'>Användarnamn</label>
					<input type='text' placeholder='Användarnamn' name='user' id='user' />
					<label for='password'>Lösenord</label>
					<input type='password' placeholder='Lösenord' name='password' id='password' /><br />
					<div class='checkbox'>
					<label for='remember'>Kom ihåg mig
					<input type='checkbox' id='remember'><br />
					</div>
					<input type='submit' id='login' name='login' class='btn btn-small' value='Logga In'/>
				</form>
		    ";
		}
		
		if ($authStatus == self::OUTLOGGED) {
			$authStatusMessage = "
				<div class=\"alert alert-info\">
					<p>Du behöver logga in för att se mer information.</p>
				</div>
			";
		} else {
			$authStatusMessage = "
				<div class=\"alert alert-success\">
					<p>Du är inloggad.</p>
				</div>
			";
		}
		
		
		$loginErrorMessage = "";
		if ($loginError) {
			$loginErrorMessage = "
				<div class=\"alert alert-error\">
					<p>Fel användarnamn eller lösenord.</p>
				</div>
			";
		}
		
		return "
			<h2>Login Controller</h2>
			<div class=\"row\">
				<div class=\"span4\">
					$form
				</div>
				<div class=\"span8\">
					$authStatusMessage
				</div>
			</div>
			<div class=\"row\">
				<div class=\"span4\">
					$loginErrorMessage
				</div>
			</div>
		";
  }
  
  // Generate HTMLcode to logout box
  public function doLogoutBox() {
    return "
		    <div class='span6'>
			    <form method='post' action='index.php'>
			    	<input type='submit' name='logout' class='btn btn-small' value='Logga Ut'>
		    	</form>
		    </div>
	    </div><!-- End of ROW1 -->";
  }
}