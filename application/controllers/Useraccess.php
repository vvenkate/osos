<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

class Useraccess extends CI_Controller {
	
	function __construct() {	
		parent::__construct ();
		
		//$this->load->model( 'user_personal_details', 'user_personal', TRUE );
		//$this->load->model( 'user_login_details', 'user_login');
		
		$this->load->model( 'staff_model', 'staff');
		//$this->load->model ( 'user', '', TRUE );
	}
	
	function index(){
		$role  = $this->input->post('role');
		
		$infoBit  = 0;
		$staffMt  = $this->input->post('staffmgmt');
		$finMt    = $this->input->post('finmgmt');
		$propMt	  = $this->input->post('propmgmt');
		$userMt   = $this->input->post('usermgmt');
		$mainMt   = $this->input->post('mainmgmt');
		$reportMt = $this->input->post('reportmgmt');		
		
		$infoBit  = $staffMt+$finMt+$propMt+$userMt+$mainMt+$reportMt;
		var_dump($infoBit);
		
		//updateUserRoleId
		
		echo $this->input->post('user_id');
		
		$this->staff->updateUserRoleId($this->input->post('user_id'), $role);
		$this->staff->updateUserPrivileges($this->input->post('user_id'), $infoBit);
		
		die(0);
		
	}
	
	function indexOld() {
		$total   = $_POST;

		$aSU_A   = array();
		$a_A     = array();
		$aST_A 	 = array();
		$aPT_A   = array();
		$aFI_A   = array();
		$aMA_A   = array();
		$aAC_A   = array();
		$aME_A   = array();
		$aCC_A   = array();
				
		$innerArr = array();
		$innerArr1 = array();
		$innerArr2 = array();
		$innerArr3 = array();
		$innerArr4 = array();
		$innerArr5 = array();
		$innerArr6 = array();
		$innerArr7 = array();
		$innerArr8 = array();			

		$superAdminBit = 0;
		$adminBit = 0;
		$staffAdminBit = 0;
		$propertyAdminBit = 0;
		$financeAdminBit = 0;
		$maintenanceAdminBit = 0;
		$accountantAdminBit = 0;
		$mEAdminBit = 0;
		$ccAdminBit = 0;
		
		foreach ($total as $key=>$values){
			
			$subject  = $key;
			$pattern  = '/^SUPER_ADMIN_/';
			$pattern1 = '/^ADMIN_/';
			$pattern2 = '/^STAFF_ADMIN_/';
			$pattern3 = '/^PROPERTY_ADMIN_/';
			$pattern4 = '/^FINANCE_ADMIN_/';
			$pattern5 = '/^MAINTENANCE_ADMIN_/';
			$pattern6 = '/^ACCOUNTANT_ADMIN_/';
			$pattern7 = '/^ME_ADMIN_/';
			$pattern8 = '/^CC_ADMIN_/';
			
			if(preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aSU_A[$key] = $values;
				$arrayVal = preg_split($pattern, $subject, 2);
				$superAdminBit += $values;
				$innerArr[] = array($arrayVal[1] => $values);
			}

			if(preg_match($pattern1, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$a_A[$key] = $values;
				$arrayVal = preg_split($pattern1, $subject, 2);
				//echo ($arrayVal[1]);
				$adminBit += $values;
				$innerArr1[] = array($arrayVal[1] => $values);
			}
			
			if(preg_match($pattern2, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aST_A[$key] = $values;
				$arrayVal = preg_split($pattern2, $subject, 2);
				//echo ($arrayVal[1]);
				$staffAdminBit += $values;
				$innerArr2[] = array($arrayVal[1] => $values);
			}

			if(preg_match($pattern3, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aPT_A[$key] = $values;
				$arrayVal = preg_split($pattern3, $subject, 2);
				//echo ($arrayVal[1]);
				$propertyAdminBit += $values;
				$innerArr3[] = array($arrayVal[1] => $values);
			}
			
			if(preg_match($pattern4, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aFI_A[$key] = $values;
				$arrayVal = preg_split($pattern4, $subject, 2);
				//echo ($arrayVal[1]);
				$financeAdminBit += $values;
				$innerArr4[] = array($arrayVal[1] => $values);
			}
				
			if(preg_match($pattern5, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aMA_A[$key] = $values;
				$arrayVal = preg_split($pattern5, $subject, 2);
				//echo ($arrayVal[1]);
				$maintenanceAdminBit += $values;
				$innerArr5[] = array($arrayVal[1] => $values);
			}
				
			if(preg_match($pattern6, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aAC_A[$key] = $values;
				$arrayVal = preg_split($pattern6, $subject, 2);
				//echo ($arrayVal[1]);
				$accountantAdminBit += $values;
				$innerArr6[] = array($arrayVal[1] => $values);
			}
				
			if(preg_match($pattern7, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aME_A[$key] = $values;
				$arrayVal = preg_split($pattern7, $subject, 2);
				//echo ($arrayVal[1]);
				$mEAdminBit += $values;
				$innerArr7[] = array($arrayVal[1] => $values);
			}
				
			if(preg_match($pattern8, $subject, $matches, PREG_OFFSET_CAPTURE)){
				//print_r($matches);
				$aCC_A[$key] = $values;
				$arrayVal = preg_split($pattern8, $subject, 2);
				//echo ($arrayVal[1]);
				$ccAdminBit += $values;
				$innerArr8[] = array($arrayVal[1] => $values);
			}
								
// 			$aSU_A = array("SUPER_ADMIN_" => $innerArr);
// 			$a_A   = array("ADMIN_" => $innerArr1);
// 			$aST_A = array("STAFF_ADMIN_" => $innerArr2);
// 			$aPT_A = array("PROPERTY_ADMIN_" => $innerArr3);
// 			$aFI_A = array("FINANCE_ADMIN_" => $innerArr4);
// 			$aMA_A = array("MAINTENANCE_ADMIN_" => $innerArr5);
// 			$aAC_A = array("ACCOUNTANT_ADMIN_" => $innerArr6);
// 			$aME_A = array("ME_ADMIN_" => $innerArr7);
// 			$aCC_A = array("CC_ADMIN_" => $innerArr8);			

			$aSU_A = array("SUPER_ADMIN_" => $superAdminBit);
			$a_A   = array("ADMIN_" => $adminBit);
			$aST_A = array("STAFF_ADMIN_" => $staffAdminBit);
			$aPT_A = array("PROPERTY_ADMIN_" => $propertyAdminBit);
			$aFI_A = array("FINANCE_ADMIN_" => $financeAdminBit);
			$aMA_A = array("MAINTENANCE_ADMIN_" => $maintenanceAdminBit);
			$aAC_A = array("ACCOUNTANT_ADMIN_" => $accountantAdminBit);
			$aME_A = array("ME_ADMIN_" => $mEAdminBit);
			$aCC_A = array("CC_ADMIN_" => $ccAdminBit);			
			//	if ($key SUPER_ADMIN_)
		}
		
// 		var_dump($aSU_A);
// 		var_dump($a_A);
// 		var_dump($aST_A);
// 		var_dump($aPT_A);
// 		var_dump($aFI_A);
// 		var_dump($aMA_A);
// 		var_dump($aAC_A);
// 		var_dump($aME_A);
// 		var_dump($aCC_A);
		
		var_dump($user_id);
		die(0);
		
		$this->input->post();
		
		$username = $this->input->post ( 'username' );

	}
	
	function check_database($password) {
		// Field validation succeeded. Validate against database
		$username = $this->input->post ( 'username' );
		
		// query the database
		$result = $this->user->login ( $username, $password );
	
		if ($result) {
			
			$sess_array = array ();
			foreach ( $result as $row ) {
				$sess_array = array (
						'user_id' => $row->id,
						'username' => $row->username,
						'privilege_key' => $row->privilege_key
				);
				
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
				
			}
			return TRUE;
		} else {
			$this->form_validation->set_message ( 'check_database', 'Invalid username or password' );
			return false;
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