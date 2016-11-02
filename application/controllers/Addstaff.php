<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class AddStaff extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		$this->load->model ( 'User', '', TRUE );
		$this->load->model ( 'Department', 'department');
		$this->load->model ( 'Roles', 'roles');
		
		$this->load->model('Staff_Model', 'staff');
		
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$this->load->helper(array('form'));
		//$departmentList = $this->department->getDepartment();
		$data['department_list'] = $this->department->getDepartment();
		$data['roles_list'] = $this->roles->getRoles();
		
		$this->load->view('staff_user_basic_view', $data);
	}
	
	function staffdb(){
		$this->load->helper(array('form'));
		//$departmentList = $this->department->getDepartment();
		
		$data['staff_list'] = $this->staff->getStaffList();
	
		$this->load->view('staff_list', $data);
	}	
	
	function aStaff($id){
		var_dump($this->staff->getStaffInfo($id));
		die(0);	
	}
	
	function addStaffPersonal(){
		$staffCreatedId = $this->staff->addStaffPersonal($_POST);
		redirect(site_url('addstaff/addStaffDocs'), $staffCreatedId);
	}
	
	
	//function addStaffDocs($staffId){
	function addStaffDocs(){
		$staffId = 6;
		$this->load->library ( 'form_validation' );
		$data['createdStaffId'] = $staffId;
		$this->load->view ( 'staff_user_new_document_view' , $data);		
	}
	
	function addStaffDocsInfo(){
		
		$docUploaded = array();
		
		$docUploaded['passport_url'] = $this->upload('user_file1');
		$docUploaded['visa_url'] = $this->upload('user_file2');
		$docUploaded['emirates_id_url'] = $this->upload('user_file3');
		$docUploaded['insurance_url'] = $this->upload('user_file4');
		
		
		$staffCreatedId = $this->staff->addStaffDocsRef($_POST, $docUploaded, $_POST['createdStaffId']);
		
		// Need to have a success / failure check...
		
		$this->load->view ( 'staff_user_new_document_view' , $data);
		redirect(site_url('addstaff/staffBenefit'), $staffCreatedId);		
	}
	
	//function staffBenefit($staffId){
	function staffBenefit(){
		$staffId = 6;
		$this->load->library ( 'form_validation' );
		$data['createdStaffId'] = $staffId;
		$this->load->view ( 'staff_user_benefit' , $data);		
	}
	
	
	function addStaffBenefit(){
		$staffCreatedId = $this->staff->addStaffBenefitInfo($_POST);
		echo 'User Added';	
		//redirect(site_url('addstaff/addStaffBenefitInfo'), $staffCreatedId);		
	}
	
	
	/*
	 * Generic file upload
	 * string file name
	 * returns true/false
	 */
	function upload($upload_file){
		$file = $upload_file;
		$config =  array(
				'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/",
				//'upload_url'      => base_url()."files/",
				'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
				'overwrite'       => TRUE,
				'max_size'        => "1000KB",
				'max_height'      => "768",
				'max_width'       => "1024"
		);
		
		$this->load->library('upload', $config);
		echo 'here';
		
		if($this->upload->do_upload($file))
		{
			echo " file upload success";
			die(0);
			
			$file_name = $this->upload->data('file_name');
			return dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/".$file_name;
		}
		else
		{
			//echo $this->upload->display_errors();
			echo "file upload failed";
			die(0);
			return false;
		}
		die(0);
		
		
		
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