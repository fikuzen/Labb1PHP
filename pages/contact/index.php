<?php
  include('sendmail.php');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    //Glöm inte att ändra de statiska sakerna till de du vill ha dem som.
    
    $email = array(); 
    $email['receiver_name'] = "Christoffer Rydberg";
    $email['receiver_email'] = "mongoj_92@hotmail.com";
    $email['sender_name'] = isset($_POST['sender_name']) ? $_POST['sender_name'] : 'Statiskt avsändarnamn';
    $email['sender_email'] = isset($_POST['sender_email']) ? $_POST['sender_email'] : 'Statiskt avsändaradress';
    $email['subject'] = isset($_POST['subject']) ? $_POST['subject'] : 'Via Hemsidan';
    $email['message'] = isset($_POST['message']) ? $_POST['message'] : 'Statisk body';
    
    //här kan du manipulera eventuell annan data. Ovan är bara ett förslag på hur du kan göra.
    //dock så är det viktigt att arrayen är associativ med de namnen som finns där uppe.
    
    $sendmail = new SendMail($email);
    
  }
  
  else {?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Kontaktuppgifter</title>
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
                    <a href="/pages/contact/" class="span1 active btn btn-primary">Kontakt</a>
                <div class="clearfix"></div>
                </nav>
                <div id="content">
                    <div class="row">
                        <div class="span8">
                        	<h2>Christoffer Rydberg</h2>
                            <hr />
                            <div class="span3 contact-info">
	                            <p><span class="icon-envelope margin-fix"></span>cr222cs@student.lnu.se</p>
	                        	<p><span class="icon-user margin-fix"></span>Skype: aldiiz</p>
	                            <p><span class="icon-volume-down margin-fix"></span>073-5075497</p>
                            </div>
                            <div class="span4">
                            	<form class="emailform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            		<label for="sender_name">Namn</label>
                            		<input class="span4" type="text" id="sender_name" name="sender_name" placeholder="Namn..."></input>
                            		<label for="sender_email">Email</label>
                            		<input class="span4" type="text" id="sender_email" name="sender_email" placeholder="Email..."></input>
                            		<label for="subject">Ämne</label>
                            		<input class="span4" type="text" id="subject" name="subject" placeholder="Ämne..."></input>
                            		<label for="message">Meddelande</label>
                            		<textarea id="message" name="message" class="textarea-fix">Meddelande...</textarea>
                            		<input type="submit" value="Skicka" class="btn btn-small btn-info"></input>
                            	</form>
                            </div>
                        </div>
                        <div class="span4">
                            <h2>Senaste uppgifter</h2>
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <h3>Laboration 1</h3>
                                <p>Labben är nu i sitt slutskede tror den är klar, bara checklistan att kolla igenom.</p>
                                <a href="/uppgift/labb1/" class="btn btn-success">Gå till Labb 1</a>
                            </div>
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
<?php }?>
