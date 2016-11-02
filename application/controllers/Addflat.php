<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class AddFlat extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'User', '', TRUE );
		$this->load->model ( 'Property_model');
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		
		
		$this->form_validation->set_rules ( 'prop_building', 'prop_building', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			//echo 'here i am fine failed';
			$this->load->view('property_new_flat');
 		}else{
			if($this->property_model->isSubPropertyExist()){
				$this->property_model->add_buliding_subprop();
				
				redirect ( 'dashboard', 'refresh' );
			}else{
				$this->load->view('property_new_view');
			}
		}
	}
	
	
	function check_database() {
		//$country = $this->input->post(
	}
	
	/*
	 * Get the Privileges
	*/
	function getAccess($user_id, $privilege_key){
		// Field validation succeeded. Validate against database
		//$username = $this->input->post ( 'username' );
	
			
		if ($result) {
			$sess_array = array ();
			foreach ( $result as $row ) {
				$sess_array = array (
						'id' => $row->id,
						'username' => $row->username
				);
	
				// $this->session->set_userdata('logged_in', $sess_array);
			}
			
			// query the database
			$result = $this->user->getAccessKey($user_id, $privilege_key);
				
			return TRUE;
		} else {
			$this->form_validation->set_message ( 'check_database', 'Invalid username or password' );
			return false;
		}
	}
}
?>