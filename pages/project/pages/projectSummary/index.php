<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Projektbeskrivning Foodtime</title>
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
                <?php include('../../../../module/menu.php') ?>
                <div id="content">
                    <div class="row">
                        <div class="span8">
                        	<h2>Projektbeskrivning</h2>
                        	<p>Mitt projekt är ett stort projekt, jag kommer inte att göra klart alla delar under den här projekttiden men jag påbörjar det för att eventuellt bygga vidare på det.</p>
                        	<p>
                        		Jag har tänkt göra så pass mycket så att man kan registrera sig som medlem och att en administratör ska kunna hantera medlemmar.
                        		Man ska också som medlem kunna skapa måltider de här måltiderna man har exempelvis 20st ska sedan 7st slumpas ut till en vecka när man väljer att slumpa en veckomeny.
                        		Man kommer inte kunna skriva recept och få ut inköpslistor och liknande men få en lista på måltider för en vecka är tanken att man ska kunna få ut.
                     		</p>
                     		<p>
                     			För projektets del så kommer jag framförallt att satsa på alla användarfall förutom Hantera matvarubutiker då detta är för mycket att hantera inom ramen för kursen. Finns det tid över så kanske den funktionaliteten faller på plats också, men ytterst osäkert.
                     			Jag satsar på betyg 5 för att sikta högt och hoppas nå dit. Jag gillar att arbeta i PHP därför vill jag också sikta för att lära mig så mycket som möjligt, underbart språk att programmera i.
                     		</p>
                        	<h3>Aktörer</h3>
                        	<h4>Primära aktörer</h4>
                     		<dl>
                     			<dt>Administratör</dt>
                     			<dd>En administratör har tillgång till alla rättigheter i applikationen och kan via ett användardgränssnitt administrera medlemmar.</dd>
                     			<dd>En administratör kan också redigera och ta bort måltider som finns i databasen</dd>
                     			<dt>Användare</dt>
                     			<dd>En användare kan med hjälp av applikationen välja ut sina favorit måltider och utifrån dessa måltider få en slumpad veckomeny</dd>
                     			<dd>En användare kan också få ut en färdig inköpslista utifrån de måltider användaren har fått i sin veckomeny</dd>
                     		</dl>
                        	<h4>Sekundära aktörer</h4>
                        	<dl>
                        		<dt>Matvarubutik</dt>
                        		<dd>En matvarubutik har ett intresse i att ha systemet och sin affär kopplad till systemet för aktuella rabatter och dylikt som man kan presentera för användaren</dd>
                        	</dl>
                        	<h3>Användningsfall</h3>
                        	<h4>Administratör</h4>
                        	<ol>
                        		<li>Hantera medlemmar</li>
                        		<li><a href="#manageMeals">Hantera måltider</a></li>
                        		<li>Hantera matvarubutiker</li>
                        		<li>Installera applikationen</li>
                        	</ol>
                        	<h4>Användare</h4>
                        	<ol>
                        		<li><a href="#registerUser">Registrera användare</a></li>
                        		<li><a href="#createMeal">Skapa måltid</a></li>
                        		<li><a href="#randomMenu">Slumpa veckomeny</a></li>
                        		<li>Redigera Måltid</li>
                        		<li>Ta bort måltid</li>
                        	</ol>
                        	<h3>Mer dataljerade användningsfall</h3>
                        	<ul class="detailedUsecases">
                        		<li id="registerUser">
                        			<h5>Registrera användare</h5>
                        			<dl>
                        				<dt>Huvudscenario</dt>
                        				<dd>En medlem går in på Foodtime.se och väljer att registrera sig, ett formulär dyker upp där användaren skriver i ett användarnamn samt lösenord två gånger. Användaren skapas och en profilsida finns tillgänglig att skriva vidare på.</dd>
                        				<dt>Alternativa scenarios</dt>
                        				<dd>Lösenorden stämmer inte överens, användaren blir informerad.</dd>
                        				<dd>Lösenordet följer inte kraven för hur lösenordet ska skrivas, användaren blir informerad.</dd>
                        				<dd>Användarnamnet finns redan, användaren blir informerad.</dd>
                        				<dd>Användarnamnet följer inte kraven för ett användarnamn, användaren blir informerad.</dd>
                        			</dl>
                        		</li>
                        		<li id="createMeal">
                        			<h5>Skapa Måltid</h5>
                        			<dl>
                        				<dt>Huvudscenario</dt>
                        				<dd>En inloggad medlem väljer att skapa en måltid, användaren får ett formulär där det finns två fält(Namn, Beskrivning). Användaren fyller i alla fält på korrekt sätt och måltiden skapas och finns tillgänglig bland användarens favoritmåltider</dd>
                        				<dt>Alternativa scenarios</dt>
                        				<dd>Användaren är inte inloggad, användaren blir informerad.</dd>
                        				<dd>Måltidsnamnet finns redan, användaren blir informerad.</dd>
                        				<dd>Måltidsbeksrivning saknas, användaren blir informerad.</dd>
                        				<dd>Namnet/Beskrivningen följer inte de krav som finns, användaren blir informerad.</dd>
                        			</dl>
                        		</li>
                        		<li id="randomMenu">
                        			<h5>Slumpa Veckomeny</h5>
                        			<dl>
                        				<dt>Huvudscenario</dt>
                        				<dd>En användare loggar in på en måndag och uppmanas då att skapa en ny veckomeny. Måltiderna som har slumpats ut visas för användaren och användaren bekräftar menyn.</dd>
                        				<dt>Alternativa scenarios</dt>
                        				<dd>Det finns inte tillräckligt med måltider för en hel vecka, användaren blir informerad.</dd>
                        			</dl>
                        		</li>
                        		<li id="manageMeals">
                        			<h5>Hantera måltider</h5>
                        			<dl>
                        				<dt>Huvudscenario</dt>
                        				<dd>En inloggad administratör väljer att hantera måltider och alla måltider visas, administratören väljer vilken måltid som ska administreras och namn samt beskrivning visas. Administratören sparar och därmed godkänner ändringar</dd>
                        				<dt>Alternativa scenarios</dt>
                        				<dd>Det finns inga måltider att hantera, administratören blir informerad.</dd>
                        				<dd>Namnet/Beskrivningen följer inte de krav som finns, administratören blir informerad.</dd>
                        				<dd>Måltidsnamnet finns redan bland användaren, administratören blir informerad.</dd>
                        			</dl>
                        		</li>
                        	</ul>
                        	<dl>
                        		
                        	</dl>
                        </div>
                        <div class="span4">
                            <?php include('../../../../latest.php') ?>
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
