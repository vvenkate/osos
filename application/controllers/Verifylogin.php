<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class VerifyLogin extends CI_Controller {
	private $MODULE_BIT;
	
	function __construct() {
		parent::__construct ();
		
		$this->MODULE_BIT =  array(
				"15" => "user", "240" => "staff", "3840" => 'property', "61440" => 'finance',"983040" => "ticket", "15728640" => "reports", "16777215" => "ALL"
		);
		$this->load->model ( 'User', 'user');
	}
	
	function index() {		
		$this->load->library ( 'form_validation' );
		$this->load->view ( 'login_view' );
	}
		
	function login(){
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( 'username', 'username', 'trim|required' );
		$this->form_validation->set_rules ( 'password', 'password', 'trim|required|callback_check_database' );
		
		if ($this->form_validation->run() == FALSE) {			
			$this->load->view ( 'login_view' );
		} else {
			$landingPage = $this->session->userdata('landing_page');	
			redirect ( $landingPage, 'refresh' );
		}
			
// 			$iPermissionBit = $this->session->userdata('permission_bit');
// 			if($iPermissionBit === "16777215"){
// 				redirect ( 'staff', 'refresh' );
// 			}else if(array_key_exists($iPermissionBit, $this->MODULE_BIT)){				
// 				redirect ( $this->MODULE_BIT[$iPermissionBit], 'refresh' );
// 			}else {
// 				redirect ( 'dashboard', 'refresh' );
// 			}			
// 		}
	}
	
	function check_database($password) {
		// Field validation succeeded. Validate against database
		$username = $this->input->post ( 'username' );
		$oFormat = $this->input->post ( 'format' );

		// query the database
		$result = $this->user->login ( $username, md5($password) );
		
		
		if($oFormat == 'html')
		{

		if ($result) {
			
			$sess_array = array ();
			//foreach ( $result as $row ) {
				$sess_array = array (
					'user_id' => $result->id,
					'username' => $result->username,
					'privilege_key' => $result->privilege_key
				);
				
				$this->session->set_userdata('permission_bit', $result->privilege_key);
				$this->session->set_userdata('user_id', $result->id);
				$this->session->set_userdata('user_name', $result->username);
				
				// Get the Privileges from the user id & keys...

				
				//$result = $this->user->getAccessKey($user_id, $privilege_key);

				$privilegeResult = $this->user->getAccessKey($sess_array['user_id'], $sess_array['privilege_key']);
				
				foreach ( $privilegeResult as $row ) {
					$privilege_array[] = array (
							'permission_bit' => $row->bit,
							'permission_to_pages' => $row->name
					);
				}
				
				$this->session->set_userdata('logged_in', $sess_array);
				$this->session->set_userdata('privileges', $privilege_array);
				
				
				$LANDING_PAGE = 'Dashboard';
				
				$ALLOWED_ALL_MODULES = array();
				//var_dump($privilege_array);
				//var_dump($permission_bit);
				//die();
				
				if($result->privilege_key === "16777215"){
					$LANDING_PAGE = 'Dashboard';
				}
				else 
				{			
				foreach ($privilege_array as $values){
					if(
							($values['permission_bit'] === '1') ||
							($values['permission_bit'] === '2') ||
							($values['permission_bit'] === '4') ||
							($values['permission_bit'] === '8')
					){
						$LANDING_PAGE = 'Usermanage';
						continue;
					}
				
					if(
							($values['permission_bit'] == '16') ||
							($values['permission_bit'] == '32') ||
							($values['permission_bit'] == '64') ||
							($values['permission_bit'] == '128')
					){
						$LANDING_PAGE = 'Staff';
					}
				
					if(
							($values['permission_bit'] == '256') ||
							($values['permission_bit'] == '512') ||
							($values['permission_bit'] == '1024') ||
							($values['permission_bit'] == '2048')
					){
						$LANDING_PAGE = 'Property';
					}
				
					if(
							($values['permission_bit'] == '4096') ||
							($values['permission_bit'] == '8192') ||
							($values['permission_bit'] == '16384') ||
							($values['permission_bit'] == '32768')
					){
						$LANDING_PAGE = 'Finance';
					}
				
					if(
							($values['permission_bit'] == '65536') ||
							($values['permission_bit'] == '131072') ||
							($values['permission_bit'] == '262144') ||
							($values['permission_bit'] == '524288')
					){
						$LANDING_PAGE = 'Mainticket';
					}
				
					if(
							($values['permission_bit'] == '1048576') ||
							($values['permission_bit'] == '2097152') ||
							($values['permission_bit'] == '4194304') ||
							($values['permission_bit'] == '8388608')
					){
						$LANDING_PAGE = 'Reports';
				
					}
				}
				
				}
//				$aPrivileges = $this->session->userdata('privileges');
				$this->session->set_userdata('landing_page', $LANDING_PAGE);
				
				
			///}
			return TRUE;
		} else {
			$this->form_validation->set_message ( 'check_database', 'Invalid username or password' );
			return false;
		}
		
	}
	else
	{
		
		if ($result) {
		
			$sess_array = array ();
			//foreach ( $result as $row ) {
			$sess_array = array (
					'user_id' => $result->id,
					'username' => $result->username,
					'privilege_key' => $result->privilege_key
			);
		
			$privilegeResult = $this->user->getAccessKey($sess_array['user_id'], $sess_array['privilege_key']);
		
			foreach ( $privilegeResult as $row ) {
				$privilege_array[] = array (
						'permission_bit' => $row->bit,
						'permission_to_pages' => $row->name
				);
			}
		
			if($result->privilege_key === "16777215"){
				$LANDING_PAGE = 'Dashboard';
			}
			else
			{
				foreach ($privilege_array as $values){
					if(
							($values['permission_bit'] === '1') ||
							($values['permission_bit'] === '2') ||
							($values['permission_bit'] === '4') ||
							($values['permission_bit'] === '8')
					){
						$LANDING_PAGE = 'Usermanage';
						continue;
					}
		
					if(
							($values['permission_bit'] == '16') ||
							($values['permission_bit'] == '32') ||
							($values['permission_bit'] == '64') ||
							($values['permission_bit'] == '128')
					){
						$LANDING_PAGE = 'Staff';
					}
		
					if(
							($values['permission_bit'] == '256') ||
							($values['permission_bit'] == '512') ||
							($values['permission_bit'] == '1024') ||
							($values['permission_bit'] == '2048')
					){
						$LANDING_PAGE = 'Property';
					}
		
					if(
							($values['permission_bit'] == '4096') ||
							($values['permission_bit'] == '8192') ||
							($values['permission_bit'] == '16384') ||
							($values['permission_bit'] == '32768')
					){
						$LANDING_PAGE = 'Finance';
					}
		
					if(
							($values['permission_bit'] == '65536') ||
							($values['permission_bit'] == '131072') ||
							($values['permission_bit'] == '262144') ||
							($values['permission_bit'] == '524288')
					){
						$LANDING_PAGE = 'Mainticket';
					}
		
					if(
							($values['permission_bit'] == '1048576') ||
							($values['permission_bit'] == '2097152') ||
							($values['permission_bit'] == '4194304') ||
							($values['permission_bit'] == '8388608')
					){
						$LANDING_PAGE = 'Reports';
							
					}
				}
					
			}
			$arr = array('status' => 200, 'message' => 'success', 'privilege_key' => $result->privilege_key, 'landing_page' => $LANDING_PAGE,
					'user_id' => $result->id,'username' => $result->username);
			
			//'user_id' => $result->id,
			//'username' => $result->username,
			
				
			//add the header here
			header('Content-Type: application/json');
			echo json_encode( $arr );
			die(0);
				
		}else {
			$arr = array('status' => 404, 'message' => 'failure', 'data_message' => 'Invalid username or password');
			
			//add the header here
			header('Content-Type: application/json');
			echo json_encode( $arr );
			die(0);
				
		}
		
	}
		
		
		
		
		
		
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