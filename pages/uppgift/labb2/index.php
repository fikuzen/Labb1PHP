<?php
	require_once "model/LoginModel.php";
	
	//Här börjar vår php kod.
	$bodyLeft = "<h2>Meny</h2>";
	$bodyRight = "<h2>Frågor & Svar</h2>";
	
	$login = new LoginModel();
	
	// Svar på frågor
	$bodyRight .= "
				<ol>
					<li>Ta reda på vad som skiljer följande funktioner som används för att dela upp en php applikation i flera filer
						<dl>
							<dt>require</dt>
							<dd>Skillnaden på require och include är att require skickar ett fatal error. \"E_COMPILE_ERROR\", alltså kommer sidan att krascha</dd>
							<dt>require_once</dt>
							<dd>Denna är identisk till require men den kommer bara att ladda en gång. Alltså ifall den i en ny php fil krävs igen men redan blivit laddad så kommer den inte att laddas igen.</dd>
							<dt>include</dt>
							<dd>När man kör med include så kommer applikationen att fortsätta köras men man får en warning att filen inte finns.</dd>
							<dt>include_once</dt>
							<dd>Samma sak som require_once man kommer bara att ladda en fil en gång.</dd>
						</dl>
					</li>
					<li>Vilka värden kan följande datatyper ta
						<dl>
							<dt>Integer</dt>
							<dd>Siffror och inte decimal tal. Beroende på vilket bit system som används har det olika max tag. På 32 Bits system är max 2147483648 och min -2147483648</dd>
							<dt>Float</dt>
							<dd>Siffror och decimaltal, med 5 decimals precision.</dd>
							<dt>Bool</dt>
							<dd>TRUE / FALSE, versaler / gemener spelar ingen roll</dd>
							<dt>String</dt>
							<dd>En samling av tecken kan innehålla allt i ett 256-tecken system. Det finns olika teckenkominationer isamband med ett \ för att göra t.ex. Radbrytningar, Tabbar.</dd>
							<dt>Array</dt>
							<dd>En array kan ha vad du än vill i princip, vilken datatyp som helst med vilket värde som helst. Du kan skicka in en integer i en array som bara bestod av strängar och man kan ha i princip ALLT.</dd>
						</dl>
					</li>
					<li>Ta reda på hur följande funktioner fungerar och har för användningsområde, redovisa med kodexempel
						<dl>
							<dt>is_int</dt>
							<dd>
								Tar reda på ifall en variabel är av typen Integer.<br />
								\"<br />
								\$isIntTest = \"Strängen\";<br />
								var_dump(is_int(\$isIntTest)); // FALSE<br />
								\"<br />
								Eftersom php är ett otypat språk så kan det finnas användningsområden då man vill vara säker på om det är av den typen man faktiskt måste ha det som.
							</dd>
							<dt>is_string</dt>
							<dd>
								Tar reda på ifall en variabel är av typen String.<br />
								\"<br />
								\$isStringTest = \"Strängen\";<br />
								var_dump(is_int(\$isStringTest)); // TRUE<br />
								\"<br />
								Eftersom php är ett otypat språk så kan det finnas användningsområden då man vill vara säker på om det är av den typen man faktiskt måste ha det som.
							</dd>
							<dt>isset</dt>
							<dd>
								Tar reda på ifall en variable är satt, ifall den inte är NULL.<br />
								\"<br />
								\$issetTest = NULL;<br />
								if(isset(\$issetTest)) {<br />
								....echo \"issetTest är satt.\";<br />									
								} else {<br />
								....echo \"issetTest är inte satt.\"; // Den här koden exekveras.<br />
								}<br />
								\"<br />
								Detta är användbart i många lägen bl.a. när man ska validera inloggning och man vill se att alla obligatoriska fält är skrivna.				
							</dd>
							<dt>gettype</dt>
							<dd>
								Används för att ta reda på av vilken type en specifik variabel är. t.ex.<br />
								\"<br />
								\$gettypeTest = \"Strängen\";<br />
								var_dump(gettype(\$gettypeTest)); // STRING<br />
								\"<br />
								Detta kan vara användbart när man har ett värde som måste vara av en specifik typ och man är osäker på om den är av den typen.						
							</dd>
							<dt>is_numeric</dt>
							<dd>
								Används för att testa i fall det finns siffror i en variabel. t.ex. <br />
								\"<br />
								\$isNumericTest = array(\"42\", 42, \"eee\");<br />
								var_dump(isNumericTest[0]); // TRUE<br />
								var_dump(isNumericTest[1]); // TRUE<br />
								var_dump(isNumericTest[2]); // FALSE<br />
								\"<br />
								Vet inte riktigt när man har behov av denna, men när man vill kontrollera att man jobbar med siffror kan de ju vara meningsfullt.								
							</dd>
							<dt>unset</dt>
							<dd>
								Används för att förstöra en specifik variabel.<br />
								\"<br />
								\$unsetTest = \"Fisk\";<br />
								unset(\$unsetTest);<br />
								var_dump(\$unsetTest); // Varning, variabeln finns inte. NULL<br />
								\"<br />
								Detta kan vara användbart när man t.ex. inte har behov av en variabel som fanns tidigare i applikationen.
							</dd>
						</dl>
					</li>
					<li>Vad ger följande kod för utskrift, varför?<br />
						\"\$s = ' sträng';<br />
						print('enkelfnuttar \$s');<br />
						print(\"dubbelfnuttad \$s\");\"<br />
						<dl>
							<dt>print('enkelfnuttar \$s');</dt>
							<dd>enkelfnuttar \$s</dd>
							<dt>print(\"dubbelfnuttad \$s\");</dt>
							<dd>dubbelfnuttad sträng</dd>
						</dl>
					</li>
					<li>Vad finns i följande \"superglobala arrayer\"?
						<dl>
							<dt>\$_POST</dt>
							<dd>Det som har blivit skickat genom HTTP scriptets POST metod. Allting samlas i en associativ array.</dd>
							<dt>\$_GET</dt>
							<dd>Det som står uppe i URL parametrarna t.ex. www.example.com?get1=1?get2=2. Så är get1 och get2 nycklarna i den associtiva arrayen och dess 1, 2 är dess värden.</dd>
							<dt>\$_REQUEST</dt>
							<dd>Innehåller innehållet av \$_POST, \$_GET och \$_COOKIE i en associativ array.</dd>
							<dt>\$_SESSION</dt>
							<dd>Innehåller variabler som blivit lagrad i sessioner i den nuvarande körningen av webbläsaren, sessioner förstörs när man stänger ner sessionen i phpskriptet eller stänger ner webbläsaren.</dd>
							<dt>\$_COOKIE</dt>
							<dd>Innehåller data som lagras i HTTP Cookies som lagras i webbläsaren under en temporär tid, skillnader från sessioner är att den här datan finns kvar även om webbläsaren stängs ner.</dd>
						</dl>
					</li>
				</ol>
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

