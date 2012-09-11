<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Uppgifter för Webbutveckling med PHP</title>
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
                    <a href="/pages/uppgift/" class="span1 active btn btn-primary">Uppgifter</a>
                    <a href="/pages/seminarie/" class="span2 btn btn-primary">Seminariegrupp</a>
                    <a href="/pages/about/" class="span1 btn btn-primary">Om mig</a>
                    <a href="/pages/contact/" class="span1 btn btn-primary">Kontakt</a>
                <div class="clearfix"></div>
                </nav>
                <div id="content">
                    <div class="row">
                    	<div class="span8">
                        	<h2>Labbar</h2>
                        	<hr>                        	
                    		<table class="table table-bordered">
                    			<thead>
	                    			<tr>
		                    			<th>Labb</th>
		                    			<th>Moment</th>
		                    			<th>Status</th>
		                    			<th>Redovisad</th>
		                    			<th>Betyg</th>
	                    			</tr>
                    			</thead>
                    			<tbody>
                    				<!-- Laboration 1 -->
                    				<tr>
                    					<td rowspan="3"><a href="labb1/" class="btn btn-success">Labb 1</a></td>
                    					<td>1</td>
                    					<td><span class="icon-ok"></span></td>
                    					<td><span class="icon-ok"></span></td>
                    					<td><span class="icon-minus"></span>G</td>
                    				</tr>
                    				<tr>
                    					<td>2</td>
                    					<td><span class="icon-ok"></span></td>
                    					<td><span class="icon-ok"></span></td>
                    					<td><span class="icon-minus"></span>G</td>
                    				</tr>
                    				<tr>
                    					<td>3</td>
                    					<td><span class="icon-ok"></span></td>
                    					<td><span class="icon-ok"></span></td>
                    					<td><span class="icon-minus"></span>G</td>
                    				</tr>
                    				<!-- Laboration 2 -->
                    				<tr>
                    					<td rowspan="2"><a href="labb2/" class="btn btn-success">Labb 2</a></td>
                    					<td>1</td>
                    					<td><span class="icon-minus"></span></td>
                    					<td><span class="icon-minus"></span></td>
                    					<td><span class="icon-minus"></span></td>
                    				</tr>
                    				<tr>
                    					<td>2</td>
                    					<td><span class="icon-minus"></span></td>
                    					<td><span class="icon-minus"></span></td>
                    					<td><span class="icon-minus"></span></td>
                    				</tr>
                    			</tbody>
                    			<tfoot>
                    				<tr>
                    					<td colspan="3">
                    						Christoffer Rydbergs laborations protokoll
                    					</td>
                    				</tr>
                				</tfoot>
                    		</table>
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
