<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    
	<title>Cyclistes de Montpellier</title>
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
<!-- MAP -->

   	<div id="map-canvas"/>
	
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
  </body>
</html>