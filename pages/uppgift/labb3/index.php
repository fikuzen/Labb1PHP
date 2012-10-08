<?php
	require_once('model/LoginModel.php');
	require_once('database/Database.php');
	require_once('database/DBSettings.php');
	
	//Här börjar vår php kod.
	$bodyLeft = "<h2>Meny</h2>";
	$bodyRight = "<h2>Frågor & Svar</h2>";
	
	// Create the Database connection
	$dbSettings = new DBSettings();
	$database = new Database();
	$database->Connect($dbSettings);
	
	// Creates the instance of the LoginModel
	$login = new LoginModel($database);
	
	// Svar på frågor
	$bodyRight .= "
				<dl>
					<dt>Vilka rättigheter bör man ha på databasanvändarkonton för den här uppgiften? Bör man ha flera olika konton?</dt>
					<dd>Man bör ha t.ex. en admin som kan göra allting, man bör också ha en till som använder applikationen som kan köra insert, select, update</dd>
					<dt>
						I tidigare uppgift har vi hårdkodat användaruppgifter för testanvändare, i den här uppgiften skapar vi testanvändare i databasen.
						Vilken säkerhetsrisk innebär detta? Hur kan man hantera risken?
					</dt>
					<dd>När man arbetar mot databasen så måste databas inloggningen sparas någonstans. För att vara säkra på att ingen kan komma åt de uppgifterna så lagras de i en separat DBSettings.php fil.</dd>
					<dt>Fundera över vilka problem som kan uppkomma ifall man använder ert loginsystem tillsammans med komponenter som andra har utvecklat, exempelvis med tabeller i databas, värden i sessionen, värden i cookies.</dt>
					<dd>Eftersom jag inte har några strängberoenden så kommer jag endast behöva ändra i mina medlemsvariabler. Mohaha!</dd>
				</dl>
				";
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Laboration 3</title>
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
                			<h1>Laboration 3</h1>
                    	</div>
                	</div>
                    <div class="row">
                    	<div class="span4">
                    		<?php echo $bodyLeft; ?>
                    		<a class="btn btn-small btn-success" href="login/">Login sidan</a>
                    		<a class="btn btn-small btn-success" href="test.php">Testa applikationen</a>
                    	</div>
                    	<div class="span8">
                    		<?php echo $bodyRight; ?>
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

