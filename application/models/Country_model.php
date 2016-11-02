<?php
class Country_Model extends CI_Model {
	
// 	function getCountryNationalities(){
// 		$this->db->select('*');
// 		$this->db->from('country');
// 		$query = $this->db->get();
		
// 		if ($query->num_rows() > 0) {
// 			//return $query->row()->name;
// 			return $query->result();
// 		} else {
// 			return 0;
// 		}
// 	}
	
	function getCountry(){
		$this->db->select('Country');
		$this->db->from('country');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}		
	}
	
	function getNationalities(){
		$this->db->select('Nationality');
		$this->db->from('country');
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
?>