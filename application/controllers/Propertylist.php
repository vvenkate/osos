<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class PropertyList extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'user', '', TRUE );
		$this->load->model ( 'Property_model', 'property_model');
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$dataArray = $this->property_model->getListBuilding();
		$sendData="";
		$i =0;
		foreach($dataArray as $val){
			$sendData[$i]["type"]= "Building";
			$sendData[$i]["name"]= $val->name;
			$sendData[$i]["no"]= $val->builder_number;
			$sendData[$i]["date"] = $val->created_at;
			$sendData[$i]["id"] = $val->id;
			$i++;
		}
		
		$data = array("sendData" => $sendData);
		$this->load->view('property_list', $data);
	}
	
	function viewproperty(){
		$property_id = $_GET['id'];
		$type = $_GET['type'];
		$dataArray = $this->property_model->getPropertyDetails($property_id,$type);
		
	}
	
	//to get the builder details in JSON.
	function getlbbuilder(){
		$dataArray = $this->property_model->get_building();
		$sendData="";
		$i =0;
		foreach($dataArray as $val){
			$sendData[$i]["key"]= $val->id;
			$sendData[$i]["val"] = $val->name;
			$i++;
		}
		//var_dump($sendData);
		if($dataArray){
			$json = json_encode($sendData);
			echo $json;
			//return $json;
		}else{
			echo "false";
			//return "false";
		}
	}
	
	
	//to get the villa details in JSON.
	function getlbvilla(){
		$dataArray = $this->property_model->get_villa();
		$sendData="";
		$i =0;
		foreach($dataArray as $val){
			$sendData[$i]["key"]= $val->id;
			$sendData[$i]["val"] = $val->name;
			$i++;
		}
		//var_dump($sendData);
		if($dataArray){
			$json = json_encode($sendData);
			echo $json;
			//return $json;
		}else{
			echo "false";
			//return "false";
		}
	}
	
	//to get the warehouse details in JSON.
	function getlbwarehouse(){
		$dataArray = $this->property_model->get_warehouse();
		$sendData="";
		$i =0;
		foreach($dataArray as $val){
			$sendData[$i]["key"]= $val->id;
			$sendData[$i]["val"] = $val->name;
			$i++;
		}
		//var_dump($sendData);
		if($dataArray){
			$json = json_encode($sendData);
			echo $json;
			//return $json;
		}else{
			echo "false";
			//return "false";
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