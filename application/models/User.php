<?php
class User extends CI_Model {
	function login($username, $password) {
		$this->db->select ( 'id, username, password, privilege_key' );
		$this->db->from ( 'user_login_details' );
		$this->db->where ( 'username', $username );
		//$this->db->where ( 'password', MD5 ( $password ) );
		$this->db->where ( 'password', $password);
		$this->db->limit ( 1 );
		
		$query = $this->db->get ();

		if ($query->num_rows () == 1) {
			//return $query->result ();
			return $query->row();
		} else {
			return false;
		}
	}
	
	//to get list of users
	public function getPersonalData($id){
		$this->db->select('*');
		$this->db->from('user_personal_details');
	
		$this->db->where('id', $id);
	
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row[0];
		}else {
			return false;
		}
	}
	
	/*
	 * Get the access rights from the table 
	 * @user_id
	 * @privilege_key
	 */
	
	 // SELECT permission.bit,permission.name  
     // FROM user_login_details LEFT JOIN permission ON user_login_details.privilege_key & permission.bit
     // WHERE user_login_details.id = 1
	function getAccessKey($user_id, $privilege_key){
		// Need to find out some other better Query....
		$sql = "SELECT permission.bit,permission.name FROM permission WHERE permission.bit & ".$privilege_key;
		$query = $this->db->query($sql);
		 
// 		$this->db->select ( 'permission.bit, permission.name' );
// 		$this->db->from ( 'user_login_details' );
// 		$this->db->join ( 'permission', 'user_login_details.privilege_key & permission.bit', 'left' );
// 		$this->db->where ( 'user_login_details.id', $user_id);

		if ($query->num_rows () > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
}
?>