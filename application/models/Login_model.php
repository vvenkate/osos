<?php

/*
  * Model class for Login  
  * Author : ManikandaRaja.S
  * Date created : 20 August 2016
  */

class Login_Model extends CI_Model {
    
	/* 
    * This method validates the user credentials and checks if the user is active
	*/
	public function __construct() {
		//die('on the login model');
// 		parent::__construct();
// 		$this->load->model('Login_Model', 'login');
// 		$this->load->model('acl_model', 'acl');
	}
	
	public function login(){
		
	}
	
	public function check_user_valid() {
        extract($_POST);
        $uname = mysql_real_escape_string($username);
        $pwd = mysql_real_escape_string($password);
        //$pwd = mysql_real_escape_string(md5($password)); // NEED TO USE MD5 ENCRYPTED METHOD ONCE ALL THE PASSWORD HAS BEEN MERGED INTO ENCRYPTION - LATER
        $this->db->select('pers.first_name, pers.last_name, pers.tenant_id, usr.user_id, ten.logo, ten.copyrighttext, ten.currency, ten.country,ten.applicationname');
        $this->db->from('tms_users_pers pers');
        $this->db->join('tms_users usr','usr.tenant_id = pers.tenant_id and usr.user_id = pers.user_id');
        $this->db->join('tenant_master ten','usr.tenant_id=ten.tenant_id');
        $this->db->where('usr.user_name', $uname);
        $this->db->where('usr.password', $pwd);
        $this->db->where('usr.account_status', 'ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }
    
    
    /**
     * Get the Role Id for the user currently logged in
     * @input - tenant_id, user_id
     * @output - role_id
    */    
    public function getRoleId($tenant_id, $user_id) {
        $this->db->select('role_id');
        $this->db->from('internal_user_role');
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        //echo "I am in get role*********"; 
        if ($query->num_rows() > 0) {
            return $query->row()->role_id;
        } else {
            return 0;
        }
    }
    
    /*
     * Function used to check the user credentials while doing forgot username and password.
     * @output - username and password
     */
    public function check_user_credentials($forgot_setting, $email, $dob) {       
        $this->db->select('usr.user_name, usr.password');
        $this->db->from('tms_users_pers pers');
        $this->db->join('tms_users usr','usr.tenant_id = pers.tenant_id and usr.user_id = pers.user_id');
        $this->db->where('usr.registered_email_id', $email);
        $this->db->where('pers.dob', $dob);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

    /*
     * Function used to reset the password.
     */
    function setNewPassword($new_password, $user_name, $dob) {

        $this->db->set("password", $new_password);
        $this->db->where('tms_users.user_name',$user_name); // NEED TO ADD TENANT ID.. TO DO
        $this->db->update('tms_users');

        $afftectedRows = $this->db->affected_rows();

        if ($afftectedRows > 0) {
            return $afftectedRows;
        } else {
            return 0;
        }
    }
}   
?>    