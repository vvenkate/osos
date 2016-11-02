<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class AddMainticket extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'user', '', TRUE );
		$this->load->model ( 'Property_model');
		$this->load->model ( 'Mainticket_model');
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		
		$this->form_validation->set_rules ( 'ticket_sum', 'ticket_sum', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			$this->load->view('mainticket_new');
 		}else{
			if($this->mainticket_model->isSimilarTktFnd()){
				$this->mainticket_model->add_main_ticket();
				
				redirect ( 'dashboard', 'refresh' );
			}else{
				$this->load->view('mainticket_new');
			}
		}
	}
	
	//to get the builder details in JSON.
	function getlbunittype(){
		$dataArray = $this->mainticket_model->get_unittype();
		$sendData="";
		$i =0;
		
		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["key"]= $val->id;
				$sendData[$i]["val"] = $val->description;
				$i++;
			}
			$json = json_encode($sendData);
			echo $json;
		}else{
			echo "false";
			
		}
	}
	
	//to get the issue type in JSON.
	function getlbissuetype(){
		$dataArray = $this->mainticket_model->get_issuetype();
		$sendData="";
		$i =0;
		
		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["key"]= $val->id;
				$sendData[$i]["val"] = $val->description;
				$i++;
			}
		
			$json = json_encode($sendData);
			echo $json;
			
		}else{
			echo "false";
			
		}
	}
	
	//to get the priority type in JSON.
	function getlbpriortype(){
		$dataArray = $this->mainticket_model->get_prior();
		$sendData="";
		$i =0;
		
		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["key"]= $val->id;
				$sendData[$i]["val"] = $val->description;
				$i++;
			}
			$json = json_encode($sendData);
			echo $json;
			
		}else{
			echo "false";
			
		}
	}
	
	//to get flat for specific bulding.
	function getlbflat(){
		$val = $this->input->get("id");
		$dataArray = $this->mainticket_model->getFlat($val);
		
		$sendData="";
		$i =0;

		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["key"]= $val->id;
				$sendData[$i]["val"] = $val->floor_no."-".$val->flat_no;
				$i++;
			}
			$json = json_encode($sendData);
			echo $json;
		}else{
			echo "false";
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