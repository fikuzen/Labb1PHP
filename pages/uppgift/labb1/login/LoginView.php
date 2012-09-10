<?php

/**
 * A view that only generates output 
 * This view is/can be used from several controllers
 */
class LoginView {  
  // Get username
  public function GetUserName() {
  	if(isset($_POST['user'])) {
  		return $_POST['user'];
  	}
  	return NULL;
  }
  
  // Get password
  public function GetPassword() {
  	if(isset( $_POST['password'])) {
  		return $_POST['password'];
  	}
  	return NULL;
  }
  
  // User tried to login?
  public function TriedToLogin() {
  	if(isset($_POST['login'])){
  		return true;
  	}
	return false;
  }

  // User tried to logout?
  public function TriedToLogout() {
  	if(isset($_POST['logout'])){
  		return true;
  	}
	return false;
  }
  
  // Generate HTMLcode to login box
  public function DoLoginBox() {
    return "
	    <div class='row'>
			<div class='span6'>
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
			</div>
	";
  }
  
  // Generate HTMLcode to logout box
  public function DoLogoutBox() {
    return "
		    <div class='span6'>
			    <form method='post' action='index.php'>
			    	<input type='submit' name='logout' class='btn btn-small' value='Logga Ut'>
		    	</form>
		    </div>
	    </div><!-- End of ROW1 -->";
  }
  
}