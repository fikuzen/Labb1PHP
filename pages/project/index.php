<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Foodtime planerare</title>
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
                <?php include('../../module/menu.php') ?>
                <div id="content">
                    <div class="row">
                        <div class="span8">
                        	<h2>Projekt Christoffer Rydberg - Foodtime</h2>
                        	<?php include('module/subnav.php') ?>
                        	<h3>Kortfattad beskrivning</h3>
                        	<h4>Stora idéer</h4>
                        	<p> 
                        		Jag ska göra ett stort receptsystem där man som familj kan skapa maträtter, recept liknande system fast man inte behöver ha recept.
                        		Det räcker alltså med ett namn på en måltid själva huvudsyftet med applikationen är att man ska kunna få en färdig veckomeny
                        		från sina valda maträtter man har. För att på så sätt slippa hitta på måltider för varje vecka om man t.ex. veckoplanerar.                        		
                     		</p>
                     		<h4>Vad innehåller projektet då?</h4>
                     		<p>
                     			För projektet kommer jag att påbörja det som sagt, man ska kunna registrera sig samt editera sin profil.
                     			Man ska också kunna lägga till måltider för sig själv/sin familj.
                     		</p>
                        </div>
                        <div class="span4">
                            <?php include('../../latest.php') ?>
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
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
