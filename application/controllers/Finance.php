<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class Finance extends CI_Controller {
	private $dataCountry;
	private $dataNational;
	private $relationshipInfo;
	
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		$this->load->model( 'Finance_Model', 'finance');
		$this->load->model ( 'Property_Model','property_model');
// 		$this->load->model( 'user', '', TRUE );
// 		$this->load->model( 'department', 'department');
// 		$this->load->model( 'roles', 'roles');		
// 		$this->load->model( 'staff_model', 'staff');
// 		$this->load->model( 'country_model', 'country');
		
// 		$this->load->model( 'Relationship_Model', 'relation');	
		
// 		$this->dataCountry['country_list'] = $this->country->getCountry();
// 		$this->dataNational['nationalities_list'] = $this->country->getNationalities();
		
// 		$this->relationshipInfo = $this->relation->getCountry();
		
	}
	
	function index(){
		$this->load->helper(array('form'));
		$dataArray = $this->finance->getListFinance();
		
		if($dataArray){
			$i =0;
			foreach($dataArray as $val){
				if($val->expense_type == "office"){
					$sendData[$i]["exptype"]= "Office";
					$sendData[$i]["property"] = "NA";
				}else{
					$sendData[$i]["exptype"]= "Property";
					if($val->property_type == 1){
						$sendData[$i]["property"] = "Building";
					}
					if($val->property_type == 2){
						$sendData[$i]["property"] = "Villa";
					}
					if($val->property_type == 3){
						$sendData[$i]["property"] = "Warehouse";
					}
					if($val->property_no != ""){
						$pridata = $this->property_model->getPropertyDetails($val->property_no,$val->property_type);
						if($pridata){
							foreach($pridata as $prival){
								$sendData[$i]["property"] .= "-".$prival->name;
							}
						}
					}
				}
				$expdate = strtotime($val->expense_date);
				$sendData[$i]["expdate"]= date("d-M-Y",$expdate);
				$sendData[$i]["amt"]= $val->exp_amt;
				$sendData[$i]["id"] = $val->id;
				$i++;
			}
		}
		$incomedata = "";
		$dataArray = "";
	
		$dataArray = $this->finance->getListFinance("income");
		if($dataArray){
			$i =0;
			foreach($dataArray as $val){
				
				if($val->property_type == 1){
					$incomedata[$i]["property"] = "Building";
				}
				if($val->property_type == 2){
					$incomedata[$i]["property"] = "Villa";
				}
				if($val->property_type == 3){
					$incomedata[$i]["property"] = "Warehouse";
				}
				
				if($val->property_no != ""){
					$pridata = $this->property_model->getPropertyDetails($val->property_no,$val->property_type);
					if($pridata){
						foreach($pridata as $prival){
							$incomedata[$i]["prop_name"] = $prival->name;
						}
					}
				}
				if($val->flat_no != ""){
					$pridata = $this->property_model->getPropertyDetails($val->flat_no,"4");
					if($pridata){
						foreach($pridata as $prival){
							$incomedata[$i]["prop_name"] .= "-".$prival->flat_no;
						}
					}
				}
				$expdate = strtotime($val->paid_date);
				$incomedata[$i]["paiddate"]= date("d-M-Y",$expdate);
				$incomedata[$i]["amt"]= $val->amount_paid;
				$incomedata[$i]["id"] = $val->id;
				$i++;
			}
		}
		
		$data = array("sendData" => $sendData, "incomedata" =>$incomedata);
		$this->load->view('finance_list',$data);
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
	
	function addexpense(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		
		
		$this->form_validation->set_rules ( 'exp_type', 'exp_type', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			//echo 'here i am fine failed';
			$this->load->view('finance_new');
 		}else{
			$filename = basename($this->upload('fin_invoice'));
			if($this->finance->add_expense($filename)){				
				redirect ( 'finance', 'refresh' );
			}else{
				$this->load->view('finance_new');
			}
		}
	}
	
	function addincome(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		
		
		$this->form_validation->set_rules ( 'prop_ftype', 'prop_ftype', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			//echo 'here i am fine failed';
			$this->load->view('finance_new_rent');
 		}else{
			if($this->finance->add_income()){				
				redirect ( 'finance', 'refresh' );
			}else{
				$this->load->view('finance_new_rent');
			}
		}
	}

	function addStaffPersonal(){
		$staffCreatedId = $this->staff->addStaffPersonal($_POST);
		
		//redirect(site_url('staff/addStaffDocs'), $staffCreatedId);
		
		$this->session->set_userdata('created_staff_id', $staffCreatedId);
		
		redirect('staff/addStaffDocs/');
	}

	
	
	
	
	/*
	 * Generic file upload
	 * string file name
	 * returns true/false
	 */
	function upload($upload_file, $user_id=""){
			
 		//$upload_url_path = base_url()."assets/uploads/".$created_user_id."/";
		
		$file = $upload_file;
		$config =  array(
				'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/assets/uploads/",

				'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
				'overwrite'       => TRUE
		);
		$config['file_name'] = 'fin_'.$_FILES[$upload_file]['name'];
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