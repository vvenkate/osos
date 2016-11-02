<?php
class Roles extends CI_Model {
	function getRoles(){
		$this->db->select('*');
		$this->db->from('roles');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			//return $query->row()->name;
			return $query->result();
		} else {
			return 0;
		}		
	}

	function getPermission($role_id){
		$this->db->select('group_permission_bit');
		$this->db->from('roles');
		$this->db->where('id', $role_id);
	
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			return $query->row()->group_permission_bit;
		} else {
			return 0;
		}
	}
	
	function getRolesById($id, $dept_id){
		$this->db->select('name');
		$this->db->from('roles');
		$this->db->where('id', $id);
		$this->db->where('department_id', $dept_id);
	
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			return $query->row()->name;
			//return $query->result();
		} else {
			return 0;
		}
	}
}
?>