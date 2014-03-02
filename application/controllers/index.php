<?php

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Data model
		$this->load->model('marker_model','markerModel');
		
		//Form library
		$this->load->library('form_validation');
	}
	
	public function index()
	{
			$this->layout->view('home/index');			
	}
	
	/** Get all the markers */
	public function getMarkers(){

		$markers = $this->markerModel->getMarkers();
		
		echo  json_encode($markers);
	}
	
	/** Add data 
	 * @return $output 1 = success, other fail.
	 */
	
	public function addMarker(){

		//Form rules
		$this->form_validation->set_rules('title', 'title', 'trim|min_length[2]||required|max_length[100]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('comment', 'comment', 'trim|min_length[3]|required|max_length[1000]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('gps', 'gps', 'trim|min_length[3]|max_length[41]|required|encode_php_tags|xss_clean');
		
		if($this->form_validation->run())
		{
			$gps = $this->input->post('gps');	
			$title = $this->input->post('title');
			$comment = $this->input->post('comment');
			
			//Control date integrity 			
			//Check this format ( XXX , YYY );
			$pos1 = strpos($gps, '('); //must be 0
			
			$pos2 = strpos($gps, ','); //must be true
			
			$pos3 = strpos($gps, ')'); //must be length string +1
			$pos3+= 1;
			
			
			//if errors
			if($pos1 != 0 || $pos3 != strlen($gps) || $pos2 == false) {
				return -1;	
			}
			
			//get rid of the ( and )
			$array = explode("(", $gps);
			$array = $array[1];
			$array = explode(")", $array);
			$array = $array[0];
				
			//get rid of the ,
			$array = explode(", ", $array);
			$lat = floatval($array[0]);
			$lng = floatval($array[1]);
			
			//. Latitude is specified in degrees within the range [-90, 90]. Longitude is specified in degrees within the range [-180, 180].
			if($lat == 0 || $lng == 0 || $lat > 90 || $lat < -90 || $lng > 180 || $lng < -180) { //fake data
				return -1;
			}

			$already = $this->markerModel->getMarkerGPS($gps); //see if there is already a point there.
			
			if(empty($already)) {
				$this->markerModel->addMarker($gps, $title, $comment);
				$output = 1;
			}
			else {
				$output = -1;
			}	
		}
		else{ //Erreur formulaire
			$output = -1;
		}
		
		echo  json_encode($output);
	}
	
}
