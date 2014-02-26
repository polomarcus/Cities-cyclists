<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      
    </style>
    
	<title>Cyclistes des villes</title>
	<link rel="shortcut icon" href="assets/img/bike.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="<?php echo css_url('bootstrap.min')?>" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
	<LINK HREF=<?PHP ECHO css_url("style")?> REL="STYLESHEET">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	    
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoWYFIMMxFCQZPefMrPRfGfBEnJZ8UI5M&sensor=false&language=fr">
    </script>
    <script type="text/javascript" src="<?php echo js_url('maps');?>"></script>
  </head>
  <body>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=485494948177837";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="container">
			<?php echo $header; ?>
	</div>
	
<!-- MAP -->
	<div id="map-canvas"></div>

	<div class="container">
		<?php echo $footer; ?>
	</div>
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
      
    <script src="assets/js/menuActive.js"></script>  
    <script type="text/javascript" src="<?php echo js_url('addPosition');?>"></script> 
    <!-- special scripts -->
    <?php foreach($js as $url): ?>
    <script type="text/javascript" src="<?php echo $url; ?>"></script> 
	<?php endforeach; ?>
	
	
<!-- 	Modal help  -->
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">En savoir un peu plus</h4>
      </div>
      <div class="modal-body">
       	<h2>Vous cherchez de l'aide ?</h2>
       	<p>Voici les commandes</p>
       	<ul>
       		<li><b>Clique droite</b> sur la carte pour afficher le <b>formulaire d'enregistrement</b> d'un risque.</li>
       		<li><b>Clique gauche</b> sur un des points de la carte <b>pour en savoir plus</b> sur celui-ci.</li>
       	</ul>
       	
       	<h2>Je cherche aussi de l'aide</h2>
       	
       	<p>Vous êtes <b>développeur</b> ? Vous pouvez améliorer aisément ce projet sur <a href="https://github.com/polomarcus/cycliste">GitHub</a>. Ce projet utilise ces technos :</p>
       	<ul>
       		<li>JavaScript avec <b>l'API Google maps</b></li>
       		<li>PHP avec <b>CodeIgniter</b></li>
       		<li>Frontend avec <b>Bootstrap</b></li>
       		<li>Base de données <b>MySQL</b></li>
       	</ul>
       	
       	<h3>Made in Montpellier with love by</h3>
       	<p>Paul Leclercq (<a href="https://twitter.com/polomarcus">@polomarcus</a>), étudiant en 5ème année à Polytech Marseille, cycliste et développeur web <i>(en herbe)</i></p>
       	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
  </body>
</html>