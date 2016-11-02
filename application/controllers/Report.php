<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class Report extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'user', '', TRUE );
		$this->load->model( 'Finance_Model', 'finance');
		$this->load->model ( 'property_model');
		$this->load->library('excel');
		//$this->load->model('acl_model', 'acl');
	}
	
	function index(){
		$this->load->helper(array('form'));
		$this->load->library ( 'form_validation' );
		$sendData = "";
		$data = array("sendData" => $sendData);
		
		$this->form_validation->set_rules ( 'report_type', 'report_type', 'trim|required' );
		
		if ($this->form_validation->run () == FALSE) {
			//echo 'here i am fine failed';
			$this->load->view('report',$data);
 		}else{
			
		}
	}
	
	//to generate finance report.
	public function financereport(){
		$data = "";
		$sendData = "";
		$inputdata  = "";
		$export_url = "";
		
		if($this->input->post('report_type') == "Finance"){
			if($this->input->post('finreport_type') == "expense"){
				$fdate = $this->input->post('fin_data_from');
				$edate = $this->input->post('fin_data_to');
				$finData = $this->finance->getListExpFinance($fdate,$edate);
				
				$inputdata = $_POST;
				if($finData){
					$export_url = "?".http_build_query($inputdata);
					$i =0;
					foreach($finData as $val){
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
				$data = array("sendData" => $sendData,"incomedata" => $incomedata,"search_fv"=>$inputdata,"exp_url"=>$export_url);
			}
			if($this->input->post('finreport_type') == "income"){
				$fdate = $this->input->post('fin_data_from');
				$edate = $this->input->post('fin_data_to');
				$finData = $this->finance->getListIncFinance($fdate,$edate);
				$incomedata  = "";
				$sendData = "";
				$export_url = "";
				
				$inputdata = $_POST;
				if($finData){
					$export_url = "?".http_build_query($inputdata);
					$i =0;
					foreach($finData as $val){
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
				$data = array("sendData"=>$sendData, "incomedata" => $incomedata,"search_fv"=>$inputdata,"exp_url"=>$export_url);
			}
		}
		$this->load->view('finance_report',$data);
	}
	
	public function propertyreport(){
		$data = "";
		$sendData = "";
		$arrcond = "";
		
		if($this->input->post('report_type') == "Property"){
			$type = $this->input->post('propreport_type');
			if($this->input->post('prop_country') != ""){
				$arrcond['country'] = $this->input->post('prop_country');
			}
			if($type != "Building"){
				$arrcond['occupied'] = $this->input->post('prop_occupied');
			}
			
			$propData = $this->property_model->getSearchPropertyDetails($type,$arrcond);
			$inputdata = $_POST;
			if($propData){
				$export_url = "?".http_build_query($inputdata);
				$i=0;
				foreach($propData as $val){
					$sendData[$i]["type"]= $type;
					$sendData[$i]["name"]= $val->name;
					if($type == "Building"){
						$sendData[$i]["no"]= $val->builder_number;
					}
					if($type == "Villa"){
						$sendData[$i]["no"]= $val->no;
					}
					if($type == "Warehouse"){
						$sendData[$i]["no"]= $val->number;
					}
					
					$sendData[$i]["country"] = $val->country;
					if($type != "Building"){
						$sendData[$i]["os"] = $val->occupied;
					}else{
						$sendData[$i]["os"] = "NA";
					}
					$i++;
				}
			}
			$data = array("sendData"=>$sendData);
		}
		$this->load->view('property_report',$data);
	}
	
	
	//todownload for excel report
	public function downfin(){
		if($this->input->get('report_type') == "Finance"){
			if($this->input->get('finreport_type') == "expense"){
				$fdate = $this->input->get('fin_data_from');
				$edate = $this->input->get('fin_data_to');
				$finData = $this->finance->getListExpFinance($fdate,$edate);
				
				if($finData){
					$i =1;
					$sendData[0]["exptype"] = "Expense Type";
					$sendData[0]["property"] = "Property Type";
					$sendData[0]["expdate"] = "Expense Date";
					$sendData[0]["amt"] = "Amount";
					
					foreach($finData as $val){
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
						$sendData[$i]["description"]= $val->description;
						$sendData[$i]["amt"]= $val->exp_amt;
						$i++;
					}
				}
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->setTitle('Finance Expense list');
				$this->excel->getActiveSheet()->setCellValue('A1', 'From: ');
				$this->excel->getActiveSheet()->setCellValue('B1', 'To: ');
				$this->excel->getActiveSheet()->fromArray($sendData);
				$filename='finance_custom_report'.date("y_m_d_hi").'.xls';
 
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0'); //no cache
							
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
		 
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
				//$data = array("sendData" => $sendData,"search_fv"=>$inputdata,"exp_url"=>$export_url);
			}
			
			//income details export
			if($this->input->get('finreport_type') == "income"){
				$fdate = $this->input->get('fin_data_from');
				$edate = $this->input->get('fin_data_to');
				$finData = $this->finance->getListIncFinance($fdate,$edate);
				$incomedata  = "";
				$sendData = "";
				$export_url = "";
				
				if($finData){
					$i =1;
					$incomedata[0]["property"] = "Property Type";
					$incomedata[0]["prop_name"] = "Property Name - Flat Name";
					$incomedata[0]["paiddate"] = "Rent Paid Date";
					$incomedata[0]["amt"] = "Amount Paid";
					
					foreach($finData as $val){
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
						$i++;
					}
				}
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->setTitle('Finance Income list');
				$this->excel->getActiveSheet()->setCellValue('A1', 'From: ');
				$this->excel->getActiveSheet()->setCellValue('B1', 'To: ');
				$this->excel->getActiveSheet()->fromArray($incomedata);
				$filename='finance_custom_report_income'.date("y_m_d_hi").'.xls';
 
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0'); //no cache
							
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
		 
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
				//$data = array("sendData" => $sendData,"search_fv"=>$inputdata,"exp_url"=>$export_url);
			}
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