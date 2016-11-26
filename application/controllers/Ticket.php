<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class Ticket extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'user', '', TRUE );
		$this->load->model ( 'Property_model' , 'property_model');
		$this->load->model ( 'Mainticket_model', 'mainticket_model');
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$dataArray = $this->mainticket_model->getTicketList();	
		
		$sendData="";
		$i =0;
		/*var_dump($dataArray);
		exit;*/
		
		if(count($dataArray) > 1) { 
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
				$usdata = $this->mainticket_model->getUserSpec($val->assigned_user_id);
				if($usdata){
					foreach($usdata as $userval){
						$sendData[$i]["assigned_to"] = $userval->first_name." ".$userval->last_name;
					}
				}
			}
			$sendData[$i]["id"] = $val->id;
			$i++;
		}
		$data = array("sendData" => $sendData);
		}
		else {
			$data = "";
		
		}		
		$this->load->view('mainticket_list', $data);
	}
	
	function viewticket(){
		$ticket_id= "";
		$arrCond="";
		
		if(isset($_GET['id'])){
			$ticket_id = $_GET['id'];
		}
		
		if($ticket_id == "" & isset($_POST['id'])){
			$ticket_id = $_POST['id'];
		}
		if($ticket_id != ""){
			$arrCond['id'] = $ticket_id;
		}
		$ticketMaintenance = $this->mainticket_model->getTicketList($arrCond);
		if($ticketMaintenance){
			$data['summary'] = $ticketMaintenance[0]->ticket_summary;
			
			// Get the Priority Info
			$priorityData = $this->mainticket_model->get_prior($ticketMaintenance[0]->priority_type);
			
			if($priorityData)
				$data['priority'] = $priorityData[0]->description;
			
			$issueData = $this->mainticket_model->get_issuetype($ticketMaintenance[0]->issue_type);
			$data['issue_type'] = $issueData[0]->description;
			
			$unitData = $this->mainticket_model->get_unittype($ticketMaintenance[0]->unit_type);
			$data['unit_type'] = $unitData[0]->description;
			
			$type = $unitData[0]->description;
			
			$pridata = $this->property_model->getPropertyDetails($ticketMaintenance[0]->unit_number, $ticketMaintenance[0]->unit_type);
			
			if($type == "Building" || $type == "1"){
				$data['address'] = $pridata[0]->name." ".$pridata[0]->builder_number." ".$pridata[0]->builder_address;
			}else if($type == "Villa" || $type == "2"){
				$data['address'] = $pridata[0]->name." ".$pridata[0]->no." ".$pridata[0]->address;				
			}else if($type == "Warehouse" || $type == "3"){
				$data['address'] = $pridata[0]->name." ".$pridata[0]->number." ".$pridata[0]->address;				
			}

			$data['ticket_number']	= $ticketMaintenance[0]->id;
			$data['flat_no'] 		= $ticketMaintenance[0]->flat_no;
			
			$data['con_number'] 		= $ticketMaintenance[0]->contact_number;
			$data['alt_contact_number'] 		= $ticketMaintenance[0]->alternate_contact_number;
			
			$created_att = $ticketMaintenance[0]->created_at;
			
			//strtotime($date)
			$convert_date = strtotime($created_att);
			$month = date('M',$convert_date);
			$year = date('Y',$convert_date);
			//$name_day = date('l',$convert_date);
			$day = date('j',$convert_date);
			
			$data['date'] = $day.'-'.$month.'-'.$year;
			
			// $temparr[] = array('status' => 200, 'message' => 'success', 'data' => $data);
			$temparr[] = $data;						
			//add the header here
			
			header('Content-Type: application/json');
			echo json_encode( array('status' => 200, 'message' => 'success', 'data' => $temparr) );
			
		} else {
			$arr = array('status' => 404, 'message' => 'No Tickets has been found for the user', 'data_message' => 'No Tickets has been found for the user');
			header('Content-Type: application/json');
			echo json_encode( $arr );
		}
	}
	
	//function viewTicketByUserId($assigned_user_id){
	function viewTicketByUserId(){

		/// Checks for Active
		
		$actionStatus = '';
		$priotityStatus = '';
		
		if(empty($_POST['status'])){
			$actionStatus = 'Active';
			$status_list = array('New', 'Inprogress');
			
			$priority_list = array(1,2,3,4,5);
			$priorityStatus = 'All';
		}
		
		if(empty($_POST['user_id'])){
			$user_id = 9;
		}else{
			$user_id = $_POST['user_id'];
		}
		
		if(!empty($_POST['status'])){
			if($_POST['status'] == 'Active' || strtolower($_POST['status']) == "active") {
				$actionStatus = 'Active';
				$status_list = array('New', 'Inprogress');
				
				$priority_list = array(1,2,3,4,5);
				$priorityStatus = 'All';
			}
			
			if($_POST['status'] == 'Inactive' || strtolower($_POST['status']) == "inactive") {
				$actionStatus = 'Inactive';
				$status_list = array('Done', 'Closed');
				
				$priority_list = array(1,2,3,4,5);
				$priorityStatus = 'All';
			}
		}

		//echo $actionStatus;
		
		if($actionStatus != 'Inactive' && $actionStatus != 'Active'){
			if(strpos( $_POST['status'], ',')){
				$status_list = explode("," , $_POST['status']);
				$actionStatus = 'MUL';
			} else {
				if($_POST['status'] != ""){
					$status_list[0] = $_POST['status'];
					$actionStatus = $_POST['status'];
				}
			}
		}
		
		/// Checks for Priority
		if(!empty($_POST['priority'])){
			if(strtolower($_POST['priority']) == 'all') {
				$priority_list = array(1,2,3,4,5);
				$priorityStatus = 'All';
			} else {
				if(strpos( $_POST['priority'], ',')){
					$priority_list = explode("," , $_POST['priority']);
					$priotityStatus = 'MUL';
				}else{
					if($_POST['priority'] != ""){
						$priority_list[0] = $_POST['priority'];
						$priotityStatus =  $_POST['priority'];
					}
				}
			}
		}
		
		$ticketMaintenance = $this->mainticket_model->getTicketDetailByUserActive($user_id, count($status_list), $status_list, count($priority_list), $priority_list);
				
		$temparr = array();
		
		if($ticketMaintenance){
			foreach($ticketMaintenance as $ticketMaintenanceData){
				//if($ticketMaintenanceData){
					
					$data['summary'] 		= $ticketMaintenanceData->ticket_summary;
					//$data['priority'] 		= $ticketMaintenanceData['priority_type'];
					
					// Get the Priority Info
					$priorityData = $this->mainticket_model->get_prior($ticketMaintenanceData->priority_type);
					
					if($priorityData)
						$data['priority'] = $priorityData[0]->description;
					
					$issueData = $this->mainticket_model->get_issuetype($ticketMaintenanceData->issue_type);
					$data['issue_type'] = $issueData[0]->description;
					
					$unitData = $this->mainticket_model->get_unittype($ticketMaintenanceData->unit_type);
					//$data['unit_type'] = strtolower($unitData[0]->description);
					$data['unit_type'] = $unitData[0]->description;
					
					$type = $unitData[0]->description;
					
					$pridata = $this->property_model->getPropertyDetails($ticketMaintenanceData->unit_number, $ticketMaintenanceData->unit_type);
					
					if($type == "Building" || $type == "1"){
						$data['address'] = $pridata[0]->name." ".$pridata[0]->builder_number." ".$pridata[0]->builder_address;
						//$data['ticket_number']	= "BL_".$ticketMaintenanceData->id;
					}else if($type == "Villa" || $type == "2"){
						
						$data['address'] = $pridata[0]->name." ".$pridata[0]->no." ".$pridata[0]->address;
						//$data['ticket_number']	= "VL_".$ticketMaintenanceData->id;
						
					}else if($type == "Warehouse" || $type == "3"){
						$data['address'] = $pridata[0]->name." ".$pridata[0]->number." ".$pridata[0]->address;
						//$data['ticket_number']	= "WH_".$ticketMaintenanceData->id;
						
					}

					$data['ticket_number']	= $ticketMaintenanceData->id;
					$data['flat_no'] 		= $ticketMaintenanceData->flat_no;
					
					$data['con_number'] 		= $ticketMaintenanceData->contact_number;
					$data['alt_contact_number'] 		= $ticketMaintenanceData->alternate_contact_number;
					
					$created_att = $ticketMaintenanceData->created_at;
					
					//strtotime($date)
					$convert_date = strtotime($created_att);
					$month = date('M',$convert_date);
					$year = date('Y',$convert_date);
					//$name_day = date('l',$convert_date);
					$day = date('j',$convert_date);
					
					$data['date'] = $day.'-'.$month.'-'.$year;
					
					// $temparr[] = array('status' => 200, 'message' => 'success', 'data' => $data);
					$temparr[] = $data;						
					//add the header here
				
			}
			
			header('Content-Type: application/json');
			echo json_encode( array('status' => 200, 'message' => 'success', 'data' => $temparr) );
			
		} else {
			$arr = array('status' => 404, 'message' => 'No Tickets has been found for the user', 'data_message' => 'No Tickets has been found for the user');
			header('Content-Type: application/json');
			echo json_encode( $arr );
		}
	}
		
	
	function Comments(){
		log_message('error', 'COMES IN');
		log_message('error', 'COMMENTS'.$_POST['ticket_comments']);
		
		try {
			log_message('error', 'TOTAL FILES ARE:- '.$_POST['totalFiles']);
			
			//$pridata = $this->mainticket_model->insertTicketComments($_POST);
			//$arr = array('status' => 200, 'message' => 'success', 'ticket_id' => $pridata, 'total_files' => $_POST['totalFiles']);
			//$arr = array('status' => 200, 'message' => 'success', 'ticket_id' => '1', 'total_files' => $_POST['totalFiles']);
			//header('Content-Type: application/json');
			//echo json_encode( $arr );
			
			
			//return $_POST['totalFiles'];
			//die(0);
			
			if ($_POST['totalFiles'] > 0)
			{
				for($i = 1; $i<=$_POST['totalFiles']; $i++){
					$image_url  = $this->upload('files_'.$i);
					$pridata = $this->mainticket_model->insertTicketComments($_POST, $image_url);
				}
			
				
// 				$arr = array('status' => 200, 'message' => 'success');
// 				header('Content-Type: application/json');
// 				echo json_encode( $arr );
			}
						
			
			
			$arr = array('status' => 200, 'message' => 'success');
			header('Content-Type: application/json');
			echo json_encode( $arr );
			
		}catch (Exception $e){
			log_message('error', 'EXCEPTION :- '.$e->getMessage());
			
			$arr = array('status' => 400, 'message' => 'Failure');
			header('Content-Type: application/json');
			echo json_encode( $arr );
			die(0);				
		}		
		
// 		if(isset($pridata)){
// 			$arr = array('status' => 200, 'message' => 'success', 'ticket_id' => $pridata);
// 			header('Content-Type: application/json');
// 			echo json_encode( $arr );
			
// 		} else {
// 			$arr = array('status' => 404, 'message' => 'failure', 'data_message' => 'Not able to create the comments against the tickets');
// 			header('Content-Type: application/json');
// 			echo json_encode( $arr );
// 		}
	}
	
	/*
	 * Generic file upload
	* string file name
	* returns true/false
	*/
	function upload($upload_file){
		log_message('error', 'UPLOAD FILE NAME:- '.$upload_file);
		
		$file = $upload_file;
		
		$config =  array(
				'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/",
				//'upload_url'      => base_url()."files/",
				'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
				'overwrite'       => TRUE,
				//'max_size'        => "1000KB",
// 				'max_height'      => "768",
// 				'max_width'       => "1024",
				//'file_name'       => 'temp.jpg',
				//'file_name' => ($file['tmp_name']),
		);
	
		$this->load->library('upload', $config);
		//$this->upload->do_upload("uploaded_file");
		
		//echo 'here';
	
		if($this->upload->do_upload($file))
		{
			//echo $this->upload->display_errors();
			
			//log_message('success', 'UPLOAD SUCCESS  :- '.$upload_file);
			
			//log_message('error', 'ERROR ON UPLOAD FILE NAME :- '.$this->upload->display_errors());
			
			//echo " file upload success";
			//die(0);
		
			$file_name = $this->upload->data('file_name');
			return $file_name;
// 			//return dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/".$file_name;
			
// 			$arr = array('status' => 200, 'message' => 'success', 'file_name' => dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/".$file_name);
// 			header('Content-Type: application/json');
// 			echo json_encode( $arr );
// 			die(0);
			
			
			// Update the Table as well .. later ...
			
		}
		else
		{
			log_message('error', 'ERROR ON UPLOAD FILE NAME :- '.$this->upload->display_errors());
			return false;
			
			$arr = array('status' => 400, 'message' => 'Failure');
			header('Content-Type: application/json');
			echo json_encode( $arr );
			die(0);
			
			//echo $this->upload->display_errors();
			//echo "file upload failed";
			//die(0);
			return false;
		}
		//die(0);
	
	
	
	}	
	
	
	
	//to add maintenance ticket.
	function addticket(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		
		$this->form_validation->set_rules ( 'ticket_sum', 'ticket_sum', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			$this->load->view('mainticket_new');
 		}else{
			//if($this->mainticket_model->isSimilarTktFnd()){
			if($this->mainticket_model->add_main_ticket()){
				
				redirect ('ticket', 'refresh' );
			}else{
				$this->load->view('mainticket_new');
			}
		}
	}
	
	//to update maintenance ticket.
	function ticketupdate(){
		$this->load->helper(array('form'));
		
		if($this->input->get('id') != ""){
			$id = $this->input->get('id');
			$arrData = $this->mainticket_model->getTicketDetail($id);
			//$comData = $this->mainticket_model->getTicketCommDetail($id);
			$json = "";
			
			foreach($arrData as $val){
				$sendData = $val;
			}
			/*if($comData){
				$sentCom = "";
				$ic = 0;
				foreach($comData as $val){
					$sentCom[$ic] = $val;
					$ic++;
				}
				$sendData->comments = $sentCom;
			}*/
			$a["json"] = json_encode($sendData);
			$this->load->view('mainticket_update', $a);
		}
		else{
			
			$this->load->library ( 'form_validation' );
		
			$this->form_validation->set_rules ( 'ticket_sum', 'ticket_sum', 'trim|required' );
			
			if ($this->form_validation->run () == TRUE) {
				if($this->mainticket_model->update_ticket()){				
					redirect ( 'ticket', 'refresh' );
				}else{
					$this->load->view('mainticket_update', $a);
				}
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
		$arrwhere = "";
		
		if($this->input->get("id") != ""){
			$arrwhere['id'] = $this->input->get("id");
		}
		
		if($this->input->get("occupy") == 2){
			$arrwhere['occupied'] = "NO";
		}
		$dataArray = $this->mainticket_model->getFlat($arrwhere);
		
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
	
	//to get list of user of maintenance department
	function getmuser(){
		$dataArray = $this->mainticket_model->getMaintanUser();
		$sendData="";
		$i =0;

		if($dataArray){
			foreach($dataArray as $val){
				$sendData[$i]["key"]= $val->id;
				$sendData[$i]["val"] = $val->first_name." ".$val->last_name;
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