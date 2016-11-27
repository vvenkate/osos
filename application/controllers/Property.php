<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class Property extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'user', '', TRUE );
		$this->load->model ( 'property_model');
		$this->load->model( 'Country_model', 'country');
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$dataArray = $this->property_model->getListBuilding();
		$sendData="";
		$i =0;
		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["type"]= "Building";
				$sendData[$i]["name"]= $val->name;
				$sendData[$i]["no"]= $val->builder_number;
				$creDate = date("d-M-Y", strtotime($val->created_at));
				$sendData[$i]["date"] = $creDate;
				$sendData[$i]["id"] = $val->id;
				$i++;
			}
		}
		
		$propArray = $this->property_model->getListTenant();
		$tentData = "";
		$i = 0;
		if($propArray){
			foreach($propArray as $val){
				$tentData[$i]['name'] = $val->first_name." ".$val->last_name;
				$tentDetArray = $this->property_model->getTenantContract($val->id);
				if($tentDetArray){
					foreach($tentDetArray as $detval){
						if($detval->unit_type == "1"){
							$tentData[$i]['prop_type'] = "Building";
						}
						if($detval->unit_type == "2"){
							$tentData[$i]['prop_type'] = "Villa";
						}
						if($detval->unit_type == "3"){
							$tentData[$i]['prop_type'] = "Warehouse";
						}
						$tentData[$i]['rent'] = $detval->rent_value;
						$edate = strtotime($detval->contract_startdate);
						$tentData[$i]['std'] = date("d-M-Y",$edate);
						$edate = strtotime($detval->contract_enddate);
						$tentData[$i]['etd'] = date("d-M-Y",$edate);
						$tentData[$i]['id'] = $detval->id;
					}
				}
				$i++;
			}
			
		}
		
		$data = array("sendData" => $sendData,"tendata"=>$tentData);
		$this->load->view('property_list', $data);
	}
	
	function sms(){
		$MessageBird = new \MessageBird\Client('');

		$Message = new \MessageBird\Objects\Message();
		$Message->originator = 'MessageBird';
		$Message->recipients = array(919341123435);
		$Message->body = 'This is a test message.';
		
		$result = $MessageBird->messages->create($Message);
		var_dump($result);
	}
	
	//add update property villa, warehouse and bulding
	function addproperty(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		
		
		$this->form_validation->set_rules ( 'prop_type', 'prop_type', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			//echo 'here i am fine failed';
			$this->load->view('property_new_view');
 		}else{
			if($this->property_model->isPropExist()){
				$this->property_model->add_property();
				
				redirect ( 'property', 'refresh' );
			}else{
				$this->load->view('property_new_view');
			}
		}
	}
	
	
	//add flat for building
	function addflat(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		
		
		$this->form_validation->set_rules ( 'prop_building', 'prop_building', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			//echo 'here i am fine failed';
			$this->load->view('property_new_flat');
 		}else{
			if($this->property_model->isSubPropertyExist()){
				$this->property_model->add_buliding_subprop();
				
				redirect ( 'property', 'refresh' );
			}else{
				$this->load->view('property_new_flat');
			}
		}
	}
	
	//add tenant
	function addtenant(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		$data['nationalities_list'] = $this->country->getNationalities();
		
		$this->form_validation->set_rules ( 'prop_ttype', 'prop_ttype', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			//echo 'here i am fine failed';
			$this->load->view('property_tenant',$data);
 		}else{
			if($this->property_model->add_tenant()){
				
				redirect ( 'property', 'refresh' );
			}else{
				$this->load->view('property_tenant',$data);
			}
		}
	}
	
	//update theproperty like villa, warehouse and building
	function update_property(){
		$this->load->helper(array('form'));
		
		if($this->input->get('id') != "" && $this->input->get('type') != ""){
			$id = $this->input->get('id');
			$type = $this->input->get('type');
			$arrData = $this->property_model->getPropertyDetails($id,$type);
			$json = "";
			
			foreach($arrData as $val){
				$val->unittype = $type;
				$sendData = $val;
			}
			$a["json"] = json_encode($sendData);
			$this->load->view('property_update_view', $a);
		}
		else{
			
			$this->load->library ( 'form_validation' );
		
			$this->form_validation->set_rules ( 'prop_type', 'prop_type', 'trim|required' );
			
			if ($this->form_validation->run () == TRUE) {
				if($this->property_model->update_property()){					
					redirect ( 'property', 'refresh' );
				}else{
					$this->load->view('property_update_view', $a);
				}
			}
		}
	}
	
	public function updatetenant(){
		$this->load->helper(array('form'));
		$a = "";
		$a['nationalities_list'] = $this->country->getNationalities();
		
		if($this->input->get('id') != ""){
			$where = "";
			$where['id'] = $this->input->get('id');
			$arrData = $this->property_model->getTenantDetails($where);
			$json = "";
			
			if($arrData){
				$a["json"] = json_encode($arrData[0]);
				$where = "";
				$where['tenant_id'] = $this->input->get('id');
				$where['status'] = 1;
				
				$arrContract = $this->property_model->getTenantContractw($where);
				if($arrContract){
					$a["jsoncontract"] = json_encode($arrContract[0]);
				}
			}else{
				$a["json"] = false;
				$a["jsoncontract"] = false;
			}
			
			$this->load->view('property_tenant_update', $a);
		}
		else{
			
			$this->load->library ( 'form_validation' );
		
			$this->form_validation->set_rules ( 'tentcont_sd', 'tentcont_sd', 'trim|required' );
			
			if ($this->form_validation->run () == TRUE) {
				if($this->property_model->update_tenant()){				
					redirect ( 'property', 'refresh' );
				}else{
					$a["json"] = json_encode($_POST);
					$this->load->view('property_tenant_update', $a);
				}
			}
		}
	}
	
	//get list of Subproperty for a Bulding as View
	public function buildingsublist(){
		$this->load->helper(array('form'));
		
		if($this->input->get('id') != ""){
			$id = $this->input->get('id');
			$sendData="";
			
			$arrData = $this->property_model->getListSubProperty($id);
			if($arrData){
				$i = 0;
				foreach($arrData as $data){
					$sendData[$i]['type'] = $data->flat_type;
					$sendData[$i]['floorno'] = $data->floor_no;
					$sendData[$i]['flatno'] = $data->flat_no;
					$sendData[$i]['occupied'] = $data->occupied;
					$sendData[$i]['id'] = $data->id;
					$i++;
				}
			}
		}
		$data = array("sendData" => $sendData);
		$this->load->view('property_flat_list', $data);
	}
	
	//get list of villa to present in list page
	function villa(){
		$dataArray = $this->property_model->getListBuilding("villa");
		$sendData="";
		$i =0;
		
		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["type"]= "Villa";
				$sendData[$i]["name"]= $val->name;
				$sendData[$i]["no"]= $val->no;
				$creDate = date("d-M-Y", strtotime($val->created_at));
				$sendData[$i]["date"] = $creDate;
				$sendData[$i]["id"] = $val->id;
				$i++;
			}
		}
		
		$propArray = $this->property_model->getListTenant();
		$tentData = "";
		$i = 0;
		if($propArray){
			
			foreach($propArray as $val){
				$tentData[$i]['name'] = $val->first_name." ".$val->last_name;
				$tentDetArray = $this->property_model->getTenantContract($val->id);
				if($tentDetArray){
					foreach($tentDetArray as $detval){
						if($detval->unit_type == "1"){
							$tentData[$i]['prop_type'] = "Building";
						}
						if($detval->unit_type == "2"){
							$tentData[$i]['prop_type'] = "Villa";
						}
						if($detval->unit_type == "3"){
							$tentData[$i]['prop_type'] = "Warehouse";
						}
						$tentData[$i]['rent'] = $detval->rent_value;
						$edate = strtotime($detval->contract_startdate);
						$tentData[$i]['std'] = date("d-M-Y",$edate);
						$edate = strtotime($detval->contract_enddate);
						$tentData[$i]['etd'] = date("d-M-Y",$edate);
						$tentData[$i]['id'] = $detval->id;
					}
				}
				$i++;
			}
		}
		
		$data = array("sendData" => $sendData,"tendata"=>$tentData);
		$this->load->view('property_list', $data);
	}
	
	//get list of villa to present in list page
	function warehouse(){
		$dataArray = $this->property_model->getListBuilding("warehouse");
		$sendData="";
		$i =0;
		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["type"]= "Warehouse";
				$sendData[$i]["name"]= $val->name;
				$sendData[$i]["no"]= $val->number;
				$creDate = date("d-M-Y", strtotime($val->created_at));
				$sendData[$i]["date"] = $creDate;
				$sendData[$i]["id"] = $val->id;
				$i++;
			}
		}
		
		$propArray = $this->property_model->getListTenant();
		$tentData = "";
		$i = 0;
		if($propArray){
			
			foreach($propArray as $val){
				$tentData[$i]['name'] = $val->first_name." ".$val->last_name;
				$tentDetArray = $this->property_model->getTenantContract($val->id);
				if($tentDetArray){
					foreach($tentDetArray as $detval){
						if($detval->unit_type == "1"){
							$tentData[$i]['prop_type'] = "Building";
						}
						if($detval->unit_type == "2"){
							$tentData[$i]['prop_type'] = "Villa";
						}
						if($detval->unit_type == "3"){
							$tentData[$i]['prop_type'] = "Warehouse";
						}
						$tentData[$i]['rent'] = $detval->rent_value;
						$edate = strtotime($detval->contract_startdate);
						$tentData[$i]['std'] = date("d-M-Y",$edate);
						$edate = strtotime($detval->contract_enddate);
						$tentData[$i]['etd'] = date("d-M-Y",$edate);
						$tentData[$i]['id'] = $detval->id;
					}
				}
				$i++;
			}
		}
		
		$data = array("sendData" => $sendData,"tendata"=>$tentData);
		$this->load->view('property_list', $data);
	}
	
	//get list of individual property.
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
		$arrwhere = "";
		
		if(isset($_GET['occupy'])){
			if($_GET['occupy'] == 2){
				$arrwhere['occupied'] = "NO";
			}
		}
		
		$dataArray = $this->property_model->get_villa($arrwhere);
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
		$arrwhere = "";
		
		if($this->input->get('occupy') == 2){
			$arrwhere['occupied'] = "NO";
		}
		$dataArray = $this->property_model->get_warehouse($arrwhere);
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