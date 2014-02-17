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
	
	/** Add data */
	public function addMarker(){

		//Form rules
		$this->form_validation->set_rules('title', 'title', 'trim|min_length[1]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('comment', 'comment', 'trim|min_length[3]|max_length[50]|encode_php_tags|xss_clean');
		$this->form_validation->set_rules('gps', 'gps', 'trim|min_length[3]|max_length[100]|encode_php_tags|xss_clean');

		
		if($this->form_validation->run())
		{
			$gps = $this->input->post('gps');	
			$title = $this->input->post('title');
			$comment = $this->input->post('comment');

			$this->markerModel->addMarker($gps, $title, $comment);
			$output = 'Votre marker a été ajouté. Merci :)';
		}
		else{ //Erreur formulaire
			$output = -1;
		}
	
		echo  json_encode($output);
	}
	
}
