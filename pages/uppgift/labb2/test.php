<?php
	require_once "model/LoginModel.php";
	
	//Här börjar vår php kod.
	$bodyLeft = "";
	$bodyRight = "<h2>Frågor & Svar</h2>";
		
	//Test av login.php
	$testResults = LoginModel::Test();
	if (count($testResults) == 0) {
		$bodyLeft .= "
					<div class='span3'>
						<p class='alert alert-success'>Logintest ok</p>
					</div>";
	} else {
		
		// För varje fel så skriver vi ut felet.
		foreach($testResults as $error) {
			$bodyLeft .= "
						<div class='span8 alert alert-warning'>
							$error
						</div>";
		}
		// Testet gick ej igenom
		$bodyLeft .= "<p class='span4 alert alert-error'>Logintest fungerar ej</p>";
	}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Laboration 2</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/style.css">
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
                    <a href="/pages/uppgift/" class="span1 btn btn-primary">Uppgifter</a>
                    <a href="/pages/seminarie/" class="span2 btn btn-primary">Seminariegrupp</a>
                    <a href="/pages/about/" class="span1 btn btn-primary">Om mig</a>
                    <a href="/pages/contact/" class="span1 btn btn-primary">Kontakt</a>
                <div class="clearfix"></div>
                </nav>
                <div id="content">
                	<div class="row">
                		<div class="span12">
                			<h1>Laboration 2</h1>
                    	</div>
                	</div>
                	<h3>Login-test</h3>
                    <div class="row">
            			<?php echo $bodyLeft; ?>
                    </div>
                    <div class="row">
                    	<hr class="span12" />
                    </div>
                    <div class="row">
                    	<div class="span12">
	                		<a class="btn btn-small btn-success" href="login/">Login sidan</a>
	            			<a class="btn btn-small btn-success" href="javascript:history.back()">Tillbaka</a>
            			</div>
                    </div>
                </div>
            </div>
            <footer>
                <p class="small">Ansvarig för texten på hemsidan är Christoffer Rydberg (CR222CS) - WP11 Distans, &copy; Copyright</p>
            </footer>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>

