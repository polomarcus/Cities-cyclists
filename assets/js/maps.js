
      /*
      To do:

          Base de donnée
          AJAX (ajout + chargement)
          Remove markers when empty
          Quand on clique ça ouvre les informations
      
      
      */
      
      function initialize() {
        var theMarker;
    	var mtp = new google.maps.LatLng(43.600, 3.883); //Montpellier GPS
    	var domaine = new Object(); // new marker
    	var coordinates = []; // coordonnées pour créers des bounds
    	  
    	var markers = []; // this array will receive all the markers from the DB in ajax.
    	
        var mapOptions = {
          
          center: mtp, //Montpellier
          zoom: 12
        };
        
        var map = new google.maps.Map(document.getElementById("map-canvas"),
                 mapOptions);

      //Event to add a position on the map
      google.maps.event.addListener(map, 'rightclick', function(event) {
			placeMarker(event.latLng); //new marker
			
	        /***************************************************/
			//Adddata form display 
			  var contentString = 
				  '<div id="content">'+
				      '<div id="siteNotice">'+
				      '</div>'+
				      '<h2 id="firstHeading" class="firstHeading">Signaler un risque</h2>'+
				      ''+
					      '<form id="dataForm" method="post" action="#">'+
					      '<input type="hidden" name="gps" id="gps" value="' + theMarker.getPosition().toString() + '">'+
						  '		<input class="col-lg-12" type="text" id="title" placeholder="Titre" name="title"><br/>'+
						  '		<textarea class="col-lg-12" rows="8" id="comment" name="comment" placeholder="Description du risque"></textarea>' +
						  '<input class="btn center-block" id="submitData" value="Envoyer" onclick="addMarker()">'+
						  '</form>'+
				      ''+
			      '</div>';

		      var infowindow = new google.maps.InfoWindow({
		          content: contentString
		      });	
		      /***************************************************/

        	infowindow.open(map, theMarker); //we display the add data form on the last created marker
    		
        });

     /** Place a new marker on the map when a click happens*/
     function placeMarker(location) {
    	
    	
		if( theMarker ) { // If there is already a marker we replace it on the new location
			theMarker.setPosition(location);
		}
		else { //else we create a new one
			    theMarker = new google.maps.Marker({
	  			position: location, //coordonnée de la position du clic sur la carte
	  			map: map,
	  			draggable:true,
	  			animation: google.maps.Animation.DROP,
	  			title: 'Risque'
	  		})
		}


     }
     
     
     /** Get all the markers*/
     function getAllMarkers(){
   		$.ajax({
   	   		url : "/Cycliste/index.php/index/getMarkers",
   	   	   	type : "POST",
   	   	   	success: function(result) {
		    	  var obj = jQuery.parseJSON(result);
		    	  
		    	  console.log(obj);
		    	  
		    	  for (i = 0; i< obj.length; i++) {
		    		  //Ajout des markers dans le tableau
		    		  //console.log(obj[i].gps);
		    		 addMarkers(obj[i].gps);
		    	  }
		    	  
		    	  location.reload();
		      },
   		})
     }
     
     /** add markers in the marker array */
     function addMarkers(gps) {
    	 
    	 //Parse (43.60227297869274, 3.8527679443359375) en 43 et 3
    	 array = gps.split(',');
    	 array0 = array[0].split('(');
    	 array1 = array[1].split(')');
    	 console.log(array0[1]);
    	 console.log(array1[0]);
    	 
    	 
    	 gps = new LatLng(parseFloat(array0[1]), parseFloat(array1[0]));
    	 markers.push(new google.maps.Marker({
	      	    position: gps,
	      	    map: map,
	      	    draggable: false,
	      	    animation: google.maps.Animation.DROP
	      	  })
    	 );
    	 
     }
     
     
  	 // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
    	  setAllMap(null);
      }

      getAllMarkers();
      
      } //Initialize

      
      /** Send the form in AJAX */
      function addMarker(event){
    	
  		console.log("AddMarker");
  		
     	title = $('#title').val();
     	comment = $('#comment').val();
     	gps = $('#gps').val();
   		
    		$.ajax({
    	   		url : "/Cycliste/index.php/index/addMarker",
    	   	   	type : "POST",
    	   	   	data: {"title" : title, "comment" : comment, "gps" : gps},
 		      success: function(response) {
 		    	  alert(response);
 		      },
    		});

    		return false;
      }
        
      google.maps.event.addDomListener(window, 'load', initialize);