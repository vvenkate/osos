<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class Staff extends CI_Controller {
	private $dataCountry;
	private $dataNational;
	private $relationshipInfo;
	
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		$this->load->model( 'User', '', TRUE );
		$this->load->model( 'Department', 'department');
		$this->load->model( 'Roles', 'roles');		
		$this->load->model( 'Staff_model', 'staff');
		$this->load->model( 'Country_model', 'country');
		
		$this->load->model( 'Relationship_model', 'relation');	
		
		$this->dataCountry['country_list'] = $this->country->getCountry();
		$this->dataNational['nationalities_list'] = $this->country->getNationalities();
		
		$this->relationshipInfo = $this->relation->getCountry();		
	}
	
	function index(){
		$this->load->helper(array('form'));
		$data['department_list'] = $this->department->getDepartment();
		$data['roles_list'] = $this->roles->getRoles();
		$data['staff_list'] = $this->staff->getStaffList();

		
		$this->load->view('staff_list', $data);
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('verifylogin');
	}
	
	function newStaff(){
		$this->load->helper(array('form'));
		$data['department_list'] = $this->department->getDepartment();
		$data['roles_list'] = $this->roles->getRoles();	
		$data['country_list'] = $this->country->getCountry();
		$data['nationalities_list'] = $this->country->getNationalities();
		
		$this->load->view('staff_user_basic_view', $data);
	}

	function addStaffPersonal(){
		$staffCreatedId = $this->staff->addStaffPersonal($_POST);
		
		//redirect(site_url('staff/addStaffDocs'), $staffCreatedId);
		
		$this->session->set_userdata('created_staff_id', $staffCreatedId);
		
		redirect('staff/addStaffDocs/');
	}
	
	function getStaffInfo($user_id){
		
		if(!empty($user_id)){
 			$this->load->helper(array('form'));

 			$data['department_list'] = $this->department->getDepartment();
 			$data['roles_list'] = $this->roles->getRoles();
			
			
			$data['staff_personal_list']   = $this->staff->getStaffPerDocInfo($user_id)[0];	// All 4 below has to be removed with 0 index

			$data['country_list'] = $this->country->getCountry();
			$data['nationalities_list'] = $this->country->getNationalities();
			$data['user_id'] = $user_id;
			
			$this->load->view('staff_user_basic_edit', $data);
		}
	}

	function editStaffPersonal(){ // move user_id to staff_id
		
		$this->load->helper(array('form'));
		$user_id = $_REQUEST['createdStaffId'];
		//$user_id = $_POST['createdStaffId'];

		
		$staffCreatedId = $this->staff->addStaffPersonal($_POST, $user_id);
		
		if(!empty($user_id)){
			//$this->load->helper(array('form'));

 			$data['department_list'] = $this->department->getDepartment();
 			$data['roles_list'] = $this->roles->getRoles();
					
			$data['staff_personal_list']   = $this->staff->getStaffPerDocInfo($user_id)[0];	// All 4 below has to be removed with 0 index
							
			$data['staff_dependent_list'] = $this->staff->getStaffDependentInfo($user_id); // dependent
			
			$data['relationship_list']  = $this->relationshipInfo; // dependent Type
			
			$data['staff_education_list']  = $this->staff->getStaffEducationInfo($user_id); // Education
			$data['staff_experience_list'] = $this->staff->getStaffExperienceInfo($user_id); // Work Experience
			
			$data['created_staff_id'] = $staffCreatedId;

			$this->load->view('staff_user_document_edit', $data);
		}
		
		// Generate the data for the page and send to the form .. 
		//redirect(site_url('staff_user_document_view_edit'), $staffCreatedId);
		
		
	}
	
	function editStaffDocsInfo(){
		$this->load->helper(array('form'));
		$user_id = $_REQUEST['createdStaffId'];

		$docUploaded = array();
		
// 		$docUploaded['passport_url'] = basename($this->upload('user_file1', $user_id));
// 		$docUploaded['visa_url'] = basename($this->upload('user_file2', $user_id));
// 		$docUploaded['emirates_id_url'] = basename($this->upload('user_file3', $user_id));
// 		$docUploaded['insurance_url'] = basename($this->upload('user_file4', $user_id));		

		
		$docUploaded['passport_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file1'), $user_id);
		$docUploaded['visa_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file2'), $user_id);
		$docUploaded['emirates_id_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file3'), $user_id);
		$docUploaded['insurance_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file4'), $user_id);
		
		$staffCreatedId = $this->staff->addStaffDocsRef($_POST, $docUploaded, $user_id);
		
		// Need to have a success / failure check...
		
		//$this->load->view ( 'staff_user_new_document_view' , $data);
		
		
		if(!empty($user_id)){
			$this->load->helper(array('form'));
	
			//$data['staff_experience_list'] = $this->staff->getStaffExperienceInfo($user_id)[0]; // Work Experience
			$data['staff_benefit_list'] = $this->staff->getStaffBenefitInfo($user_id)[0]; // Work Experience

			
			//$this->roles->getRoles();
			$this->load->view('staff_user_benefit_edit', $data);
		}
		
		//redirect(site_url('staff/editStaffBenefit'), $staffCreatedId);
	}
	
	function staffList(){
		$this->load->helper(array('form'));
		//$departmentList = $this->department->getDepartment();
		
		$data['staff_list'] = $this->staff->getStaffList();
		
		$this->load->view('staff_list', $data);
	}
	
	function aStaff($id){
		var_dump($this->staff->getStaffInfo($id));
		die(0);		
	}
		
	function addStaffDocs(){
		
		$staffId = $this->session->userdata('created_staff_id');
		$this->load->library ( 'form_validation' );
		$data['createdStaffId'] = $staffId;
		
		$data['relation_list']  = $this->relationshipInfo;
		
		$this->load->view ( 'staff_user_new_document_view' , $data);		
	}
	
	function addStaffDocsInfo(){
		/// createdStaffId
		
		$this->load->helper(array('form'));
		$user_id = $_POST['createdStaffId'];
		
		$docUploaded = array();
		//$file_access_url = base_url()."/assets/uploads/".$file_name;
		
		$docUploaded['passport_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file1', $user_id));
		$docUploaded['visa_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file2', $user_id));
		$docUploaded['emirates_id_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file3', $user_id));
		$docUploaded['insurance_url'] = base_url()."/assets/uploads/".basename($this->upload('user_file4', $user_id));

		//echo 'going to add document';
		$staffCreatedId = $this->staff->addStaffDocsRef($_POST, $docUploaded, $user_id);
		// Need to have a success / failure check...
		
		//$this->load->view ( 'staff_user_new_document_view' , $data);
		//redirect(site_url('addstaff/staffBenefit'), $staffCreatedId);
		
		redirect(site_url('staff/staffBenefit'), $staffCreatedId);
	}
	
	//function staffBenefit($staffId){
	function staffBenefit(){
		//$staffId = 6;
		$staffId = $this->session->userdata('created_staff_id');
		
		$this->load->library ( 'form_validation' );
		$data['createdStaffId'] = $staffId;
		$this->load->view ( 'staff_user_benefit' , $data);		
	}
			 
	function addStaffBenefit(){
		$this->staff->addStaffBenefitInfo($_POST);
			
		
		//$aPrivileges = $this->session->userdata('workemail');
		
		$username = explode("@", $this->session->userdata('workemail'));
		
		$data['username'] = $username[0];
		
		$data['personalemail'] = $this->session->userdata('personal_email');
		$data['workemail'] = $this->session->userdata('workemail');
		
		$successMsg = $this->load->view('accountsuccess_model.php', $data, true);
		
		$this->load->library('email');
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$this->email->from('mukilmani@gmail.com', 'Mani'); // Need to Change the OSOS admin email id
		
		$this->email->to($data['workemail']);
		$this->email->cc($data['personalemail']);
		
		$this->email->subject('OSOS Account Creation');
		$this->email->message($successMsg);
		
		$this->email->send();
				
		redirect(site_url('/staff'));
					
		//redirect(site_url('addstaff/addStaffBenefitInfo'), $staffCreatedId);		
	}
	
	function editStaffBenefit(){
		$staffCreatedId = $this->staff->editStaffBenefitInfo($_POST);
		//echo 'User Updated';		
	}
	
	
	/*
	 * Generic file upload
	 * string file name
	 * returns true/false
	 */
	function upload($upload_file, $user_id=null){
			
 		//$upload_url_path = base_url()."assets/uploads/".$created_user_id."/";
		
		$file = $upload_file;
		$config =  array(
				//'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/",
				//'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/assets/uploads/".$created_user_id."/",
				'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/assets/uploads/",
				
				//'upload_path'     => $upload_url_path,
				
				'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
				'overwrite'       => TRUE,
				'max_size'        => "1000KB",
				'max_height'      => "768",
				'max_width'       => "1024"
		);
				
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload($file))
		{
			
			$file_name = $this->upload->data('file_name');
			return $file_name;
			//return dirname($_SERVER["SCRIPT_FILENAME"])."/assets/uploads/".$file_name;
			//return base_url()."/assets/uploads/".$file_name;
		}
		else
		{
			//echo 'in else';
			return false;
		}
		
		
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