<?php 
	session_start();
	
	// Get required view files
	require_once 'LoginView.php';
	require_once 'LoginHandler.php';
	
	// The Title
	$title = "Labb1 -> Logga in";
	
	// Creating an instance of the classes I need.
	$loginView = new LoginView();
	$loginHandler = new LoginHandler();
	
	// Running the test of the LoginHandler
	$loginHandlerErrors = $loginHandler->Test();
	
	// Errors during the LoginHandlerTest
	if(count($loginHandlerErrors) > 0) {
		$body = "<div class=\"alert alert-error\">";
		foreach ($loginHandlerErrors as $loginHandlerError => $loginHandlerErrorMessage) {
			$body .= "$loginHandlerErrorMessage<br />";
		}
		$body .= "</div>";
	}
	// LoginHandlerTest succeeded
	else{
		// Generate LoginBox
		$loginBox = $loginView->DoLoginBox();
		$body = $loginBox;
		
		// Generate LogoutBox
		$logoutBox = $loginView->DoLogoutBox();
		$body .= $logoutBox;
		
		if ($loginView->TriedToLogin() ) 
		{
		  	$body .= "<div class='row'><div class='span12'>Användaren har klickat på Login med användarnamn '";
		  	$body .= $loginView->GetUserName() . "' och lösenord '" . $loginView->GetPassword() . "'</div></div>";
		}
		else 
		{
		  	$body .= "<div class='row'><div class='span12'>Användaren har inte klickat på Loginknappen</div></div>"; 
		}
		
		if ($loginView->TriedToLogout() ) 
		{
			$_SESSION['loggedIn'] = $loginHandler->DoLogout();
		  	$body .= "<div class='row'><div class='span12'>Användaren har valt att logga ut.</div></div>";
		}
		else 
		{
		  	$body .= "<div class='row'><div class='span12'>Användaren har inte klickat på Logga ut knappen</div></div>"; 
		}
	}
	
	// Generate Javascript plugin, such as jQuery and my own JS files
	$jsBody = "<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js\"></script>
        <script>window.jQuery || document.write(\\'<script src=\"js/vendor/jquery-1.8.0.min.js\"><\/script>\')</script>
        <script src=\"js/plugins.js\"></script>
        <script src=\"js/main.js\"></script>";
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/vendor/modernizr-2.6.1.min.js"></script>
        <script src="/js/vendor/bootstrap.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <dív id="container">
            <div id="wrapper">
                <header>
                    <div class="row">
                        <h1 class="span6">Webbutveckling med PHP,</h1>
                        <h2 class="span6">Christoffer (CR222CS) Rydberg</h2>
                    </div>
                </header>
                <div class="row">
                    <hr class="span12" />
                </div>
                <nav>
                    <a href="/" class="span1 btn btn-primary">Hem</a>
                    <a href="/uppgift/" class="span1 btn btn-primary">Uppgifter</a>
                    <a href="/seminarie.php" class="span2 btn btn-primary">Seminariegrupp</a>
                    <a href="/about.php" class="span1 btn btn-primary">Om mig</a>
                    <a href="/contact.php" class="span1 btn btn-primary">Kontakt</a>
                <div class="clearfix"></div>
                </nav>
                <div id="content">
                	<?php echo $body ?>
                	<div class="clearfix"></div>
                </div>
            </div>
            <footer>
                <p class="small">Ansvarig för texten på hemsidan är Christoffer Rydberg (CR222CS) - WP11 Distans, &copy; Copyright</p>
            </footer>
        </div>
    </body>
    <?php echo $jsBody ?>
</html>
</head>