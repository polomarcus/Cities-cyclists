<?php
class Marker_model extends CI_Model {

	var $table = 'marker'; //table BD
	
	
	/*******************************************************/
	/*						GETTERS						   */
	/*******************************************************/	
	/**
	 * @return all the markers
	 * @param  limit the number of return $nb
	 * @param  limit the number of return $debut
	 */
	public function getMarkers()
	{
		return $this->db->select('*')
		->from($this->table)
		->order_by('date', 'desc')
		->get()
		->result();
	}
	
	/**
	 * @return the date on a point with this GPS
	 * use to see if there is already a marker on this GPS position
	 * @param  $gps (ex: (12321.21, 12321.432)
	 */
	public function getMarkerGPS($gps)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('gps', $gps)
		->get()
		->result();
	}
	
	
	/* 			TO DO 						*/
	/*			STATS PART					*/
	/**
	 * @return all data on motion between 2 dates
	 * @param  $date (ex: AAAA-MM-JJ)
	 */
	public function getTempBetweenDates($first_date,$second_date)
	{
		return $this->db->select('*')
		->from($this->table)
		->where('date >=', $first_date)
		->where('date <=', $second_date)
		->get()
		->result();
	}
	
	
	/**
	 * @return all data on motion of the month
	 * @param  $month (ex: MM)
	 */
	public function getDataOfMonth($month)
	{
		$this->load->helper('date');
		//To otain the number of day in the month
		$days = date('t', $month);
		$year = date('Y');
		
		//To obtain all day
		$first_date = $year . '-' . $month . '-01' . " " . "00:00:00";
		$second_date = $year . '-' . $month . '-' . $days . " " . "23:59:59";
		
		return $this->db->select('*')
		->from($this->table)
		->where('date >=', $first_date)
		->where('date <=', $second_date)
		->order_by('date', 'desc')
		->get()
		->result();
	}
	
	
	
	/*******************************************************/
	/*						SETTERS						   */
	/*******************************************************/
	
	/**
	 * add a new marker
	 * @return the id just created
	 */
	public function addMarker($gps, $title, $comment, $ip = 0)
	{	
		$this->load->helper('date');

		//Insert the marker into the DB
		$this->db->set('gps', $gps)
				 ->set('title', $title)
				 ->set('comment', $comment)
				 ->set('date', date('Y-m-d H:i:s'))
				 ->set('ip', $ip)
				 ->insert($this->table);
	
		// new ID created
		return $this->db->insert_id();
	}	
}