<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class MainTicket extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'user', '', TRUE );
		$this->load->model ( 'Property_model');
		$this->load->model ( 'Mainticket_model');
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$dataArray = $this->mainticket_model->getTicketList();
		$sendData="";
		$i =0;
		foreach($dataArray as $val){
			$sendData[$i]["summary"]= $val->ticket_summary;
			
			$pridata = $this->mainticket_model->get_prior($val->priority_type);
			if($pridata){
				foreach($pridata as $prival){
					$sendData[$i]["priority"] = $prival->description;
				}
			}else{
				$sendData[$i]["priority"] = "";
			}
			$pridata = "";
			
			$pridata = $this->property_model->getPropertyDetails($val->unit_number,$val->unit_type);
			if($pridata){
				foreach($pridata as $prival){
					$sendData[$i]["unit"] = $prival->name;
				}
			}else{
				$sendData[$i]["unit"]  = "";
			}
			$pridata = "";
			
			if($val->flat_no != "" && $val->flat_no != NULL){
				$pridata = $this->mainticket_model->getFlatDetail($val->flat_no);
				if($pridata){
					foreach($pridata as $prival){
						$sendData[$i]["unit"] .= $prival->floor_no."_".$prival->flat_no;
					}
				}
			}
			
			$creDate = date("d-M-Y", strtotime($val->created_at));
			$sendData[$i]["date"] = $creDate;
			
			if($val->assigned_user_id == 0){
				$sendData[$i]["assigned_to"] = "Mani";
			}else{
					$sendData[$i]["assigned_to"] = $val->assigned_user_id;
			}
			
			$sendData[$i]["id"] = $val->id;
			$i++;
		}
		
		$data = array("sendData" => $sendData);
		$this->load->view('mainticket_list', $data);
	}
	
	function viewticket(){
		$ticket_id = $_GET['id'];
		$dataArray = $this->property_model->getPropertyDetails($property_id,$type);
		
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