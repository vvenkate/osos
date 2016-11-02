<?php
class Relationship_Model extends CI_Model {
	function getCountry(){
		$this->db->select('*');
		$this->db->from('relationship');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}		
	}
}
?>