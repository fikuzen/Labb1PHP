<?php 
	session_start();
	$_SESSION['loggedIn'] = false;
	
	require_once('LoginController.php');
	
	// The Title
	$title = "Labb2 -> Logga in";
	
	
	class MasterController {
        public static function doControll() {
                // Instance of LoginController
                $loginController = new LoginController();
                
				// Get HTML5 Site
                $html = $loginController->doControll();
                
                return $html;
        }
    }
	
	
	$body = MasterController::doControll();	
?>

<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div id="container">
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
            </div> <!-- End of content-->
        </div> <!-- End of wrapper -->
        <footer>
            <p class="small">Ansvarig för texten på hemsidan är Christoffer Rydberg (CR222CS) - WP11 Distans, &copy; Copyright</p>
        </footer>
    </div> <!-- End of container -->
</body>
</html>
</head>