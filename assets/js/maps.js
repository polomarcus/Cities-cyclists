
      /*
      To do:

          Base de donnée
          AJAX (ajout + chargement)
          Remove markers when empty
          Quand on clique ça ouvre les informations
      
      
      */
      
      function initialize() {
        var theMarker = null; // THE marker, displayed on a user click
    	var markers = []; // this array will receive all the markers from the DB in ajax.
    	var infoBoxes = [];// infowindows for markers 	
    	var image = 'assets/img/pin.png'; //image for theMarker
    	
    	var mtp = new google.maps.LatLng(43.600, 3.883); //Montpellier GPS
    	
    	//Not used yet
    	var domaine = new Object(); // new marker
    	var coordinates = []; // coordonnées pour créers des bounds
    	  
    
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
				  var contentForm = 
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
			          content: contentForm,
			          maxWidth: 400
			      });	
			      /***************************************************/
	
	        	infowindow.open(map, theMarker); //we display the add data form on the last created marker
	    		
	        });
	      
		     //Close the data form
		     google.maps.event.addListener(map, 'rightclick', function() {
		    	 //theMarker.setMap(null);
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
		  			icon: image,
		  			title: 'Risque potentiel'
		  		})
			}
	
			//place the marker on the map
			theMarker.setMap(map);
	     }
	     
	     
	     /** Get all the markers from the DB*/
	     function getAllMarkers(){
	   		$.ajax({
	   	   		url : "/Cycliste/index.php/index/getMarkers",
	   	   	   	type : "POST",
	   	   	   	success: function(result) {
			    	  var obj = jQuery.parseJSON(result);
			    	    
			    	  for (i = 0; i< obj.length; i++) {
			    		  //Ajout des markers dans le tableau
			    		  //console.log(obj[i].gps);
			    		  addMarkers(obj[i].gps, obj[i].title, obj[i].comment)
			    		  
			    		 setTimeout(function(){
			    			 console.log("wait");
			    		 }
			    				 ,
			    				 5000);
			    	  }
			    	  
			    	  
			      },
	   		})
	     }
	     
	     /** add markers in the marker array */
	     /** gps loaded from the DB */
	     function addMarkers(gps, title, comment) {
	    	 
	    	 //Parse (43.60227297869274, 3.8527679443359375) into 43... and 3....
	    	 array = gps.split(',');
	    	 array0 = array[0].split('(');
	    	 array1 = array[1].split(')');
	    	 
	    	 //Gps position object for google map API
	    	 gps = new  google.maps.LatLng(parseFloat(array0[1]), parseFloat(array1[0]));
	    	
	    	 var tmpMarker = new google.maps.Marker({
										      	    position: gps,
										      	    map: map,
										      	    draggable: false, //can't be drag 
										      	    animation: google.maps.Animation.DROP,
										      	    title: title
										      	  });
	    
	    	 
	    	 //Data about the marker 
		      var tmpInfowindow = new google.maps.InfoWindow({
		          content: '<div class="displayData">'+
			          		   '<h2>' + title + '</h2>'+
			          		   '<p>' + comment + '</p>'+
		          		   '</div>',
		          maxWidth: 400
		      });	
	    	 
		      //Event : display the infoWindows on click on the marker
              google.maps.event.addListener(tmpMarker, 'click', function() {
            	  //close all the others infoboxes
            	  closeInfoBoxes();
            	  
            	  //open the correct one
            	  tmpInfowindow.open(map, tmpMarker);
              });
              
	    	 //******** we add the tmp var in the arrays  *********/
		     markers.push(tmpMarker);
		     infoBoxes.push(tmpInfowindow);	    	 
	     }
	     
	     /**************************** Optional display function ***************************/
	     
	     //close all the info box 
	     function closeInfoBoxes(){
	    	 
	    	 for (i = 0; i< infoBoxes.length; i++) {
	    		 infoBoxes[i].close();
	    	 }  	 
	     }

	  	 // Deletes all markers in the array by removing references to them.
	      function deleteMarkers() {
	    	  setAllMap(null);
	      }
	
	      //Display all the marker from the DB
	      getAllMarkers();
      
      } //Initialize close

      
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
 		    	  if (response == 1){
 		    		  
 		    	  }
 		    	  else  {
 		    		  alert('Une erreur s\'est produite...');
 		    	  }
 		      },
    		});

    		return false;
      }
        
      google.maps.event.addDomListener(window, 'load', initialize);