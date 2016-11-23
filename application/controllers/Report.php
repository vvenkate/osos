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
		$this->load->model ( 'mainticket_model');
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
				$exp_type = "";
				if($this->input->post('expense_type') != "All"){
					$exp_type = $this->input->post('expense_type');
				}
				$finData = $this->finance->getListExpFinance($fdate,$edate,$exp_type);
				
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
				$income_type = "";
				if($this->input->post('income_pm') != "" && $this->input->post('income_pm') != "All"){
					$income_type = $this->input->post('income_pm');
				}
				$finData = $this->finance->getListIncFinance($fdate,$edate,$income_type);
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
		$inputdata  = "";
		$export_url = "";
		$arrcond = "";
		
		if($this->input->post('report_type') == "Property"){
			$type = $this->input->post('propreport_type');
			if($this->input->post('prop_country') != ""){
				$arrcond['country'] = $this->input->post('prop_country');
			}
			if($type != "Building" && $this->input->post('prop_occupied') != ""){
				$arrcond['occupied'] = $this->input->post('prop_occupied');
			}
			
			$propData = $this->property_model->getSearchPropertyDetails($type,$arrcond);
			$inputdata = $_POST;
			$export_url = "?".http_build_query($inputdata);
			
			$sendData = $this->getPropReport($propData);
			
			$data = array("sendData"=>$sendData,"search_fv"=>$inputdata,"exp_url"=>$export_url);
		}
		$this->load->view('property_report',$data);
	}
	
	public function getPropReport($propData,$k=0){
		$sendData = "";
		
		if($propData){			
			$i = 0;
			if($k != 0){
				$i = $k;
			}
			$type = $this->input->post('propreport_type');
			if($type == ""){
				$type = $this->input->get('propreport_type');
			}
			
			foreach($propData as $val){
				$sendData[$i]["type"]= $type;
				if($type == "flat"){
					$sendData[$i]["type"] = $val->flat_type;
				}
				if($type != "flat"){
					$sendData[$i]["name"]= $val->name;
				}else{
					$sendData[$i]["name"]= $val->floor_no;
				}
				
				if($type == "Building"){
					$sendData[$i]["no"]= $val->builder_number;
				}
				if($type == "Villa"){
					$sendData[$i]["no"]= $val->no;
				}
				if($type == "Warehouse"){
					$sendData[$i]["no"]= $val->number;
				}
				if($type == "flat"){
					$sendData[$i]["no"]= $val->flat_no;
				}
				if($type != "flat"){
					$sendData[$i]["country"] = $val->country;
				}else{
					$arrbw['id'] = $val->builder_id;
					$builddata = $this->property_model->getSearchPropertyDetails("Building",$arrbw);
					if($builddata){
						$sendData[$i]["country"] = $builddata[0]->country;
					}else{
						$sendData[$i]["country"] = "";
					}
				}
				if($type != "Building"){
					$sendData[$i]["os"] = $val->occupied;
				}else{
					$sendData[$i]["os"] = "NA";
				}
				$i++;
			}
		}
		return $sendData;
	}
	
	public function ticketreport(){
		$data = "";
		$sendData = "";
		$inputdata  = "";
		$export_url = "";
		$arrcond = "";
		
		if($this->input->post('report_type') == "Ticket"){
			$type = $this->input->post('ticket_status');
			if($this->input->post('ticket_status') != "" && $this->input->post('ticket_status') != "all"){
				$arrcond['ticket_status'] = $this->input->post('ticket_status');
			}
			if($this->input->post('ticket_open_date') != ""){
				$fdatetmp = date("Y-m-d",strtotime($this->input->post('ticket_open_date')));
				$arrcond['updated_at >='] = $fdatetmp;
			}
			if($this->input->post('ticket_open_date_to') != ""){
				$fdatetmp = date("Y-m-d",strtotime($this->input->post('ticket_open_date_to')));
				$arrcond['updated_at <='] = $fdatetmp;
			}
			if($this->input->post('by_user_id') != "" && $this->input->post('by_user_id') != "all"){
				$arrcond['assigned_user_id'] = $this->input->post('by_user_id');
			}
			
			$propData = $this->mainticket_model->getTicketList($arrcond);
			$sendData = $this->getTicketReport($propData);
			$inputdata = $_POST;
			$export_url = "?".http_build_query($inputdata);
			
			$data = array("sendData"=>$sendData,"search_fv"=>$inputdata,"exp_url"=>$export_url);
		}
		$this->load->view('ticketreport',$data);
	}
	
	public function getTicketReport($propData,$k=0){
		$sendData = "";
		
		if($propData){
			
			$i = 0;
			if($k != 0){
				$i = $k;
			}
			$type = $this->input->post('report_type');
			if($type == ""){
				$type = $this->input->get('report_type');
			}
			
			foreach($propData as $val){
				$sendData[$i]["id"] = $val->id;
				$sendData[$i]["summary"]= $val->ticket_summary;
			
				$pridata = $this->mainticket_model->get_prior($val->priority_type);
				if($pridata){
					$sendData[$i]["priority"] = $pridata[0]->description;
				}else{
					$sendData[$i]["priority"] = "";
				}
				$pridata = "";
				
				$pridata = $this->mainticket_model->get_issuetype($val->issue_type);
				if($pridata){
					$sendData[$i]["issue"] = $pridata[0]->description;
				}else{
					$sendData[$i]["issue"] = "";
				}
				$pridata = "";
				
				$pridata = $this->property_model->getPropertyDetails($val->unit_number,$val->unit_type);
				if($pridata){
					$sendData[$i]["unit"] = $pridata[0]->name;
				}else{
					$sendData[$i]["unit"]  = "";
				}
				$pridata = "";
				
				if($val->flat_no != "" && $val->flat_no != NULL){
					$pridata = $this->mainticket_model->getFlatDetail($val->flat_no);
					if($pridata){
						$sendData[$i]["unit"] .= $pridata[0]->floor_no."_".$pridata[0]->flat_no;
					}
				}
				
				if($val->assigned_user_id == 0){
					$sendData[$i]["assigned_to"] = "Mani";
				}else{
					$userdata = $this->mainticket_model->getUserSpec($val->assigned_user_id);
					$sendData[$i]["assigned_to"] = $userdata[0]->first_name." ".$userdata[0]->last_name;
				}
				
				$creDate = date("d-M-Y", strtotime($val->created_at));
				$sendData[$i]["date"] = $creDate;
				
				$i++;
			}
		}
		return $sendData;
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
					$sendData[0]["description"] = "Description";
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
					$incomedata[0]["pay_mode"] = "Payment Mode";
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
						$incomedata[$i]["pay_mode"] = $val->payment_mode;
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
		
		//Property Report
		if($this->input->get('report_type') == "Property"){
			$arrcond = "";
			
			$type = $this->input->get('propreport_type');
			if($this->input->get('prop_country') != ""){
				$arrcond['country'] = $this->input->get('prop_country');
			}
			if($type != "Building"){
				if($this->input->get('prop_occupied') != ""){
					$arrcond['occupied'] = $this->input->get('prop_occupied');
				}
			}

			$propData = $this->property_model->getSearchPropertyDetails($type,$arrcond);
			$sendData1 = $this->getPropReport($propData,$type);
			$sendData = "";
			
			$sendData[0]['type'] = "Property Type";
			$sendData[0]['name'] = "Property Name";
			$sendData[0]['no'] = "Building/Villa/Warehouse No";
			$sendData[0]['country'] = "Country";
			$sendData[0]['os'] = "Occupied Status";
			
			$i = 1;
			foreach($sendData1 as $indivProp){
				$sendData[$i] = $indivProp;
				$i++;
			}
			
			
			if(count($sendData) > 0){
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->setTitle('Property Details');
				$this->excel->getActiveSheet()->setCellValue('A1', 'From: ');
				$this->excel->getActiveSheet()->setCellValue('B1', 'To: ');
				$this->excel->getActiveSheet()->fromArray($sendData);
				$filename='property_custom_report_details'.date("y_m_d_hi").'.xls';
	
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0'); //no cache
							
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
		 
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
			}
		}
		
		//Maintenance Ticket Report
		if($this->input->get('report_type') == "Ticket"){
			$arrcond = "";
			
			$type = $this->input->get('ticket_status');
			if($this->input->get('ticket_status') != "" && $this->input->get('ticket_status') != "all"){
				$arrcond['ticket_status'] = $this->input->get('ticket_status');
			}
			if($this->input->get('ticket_open_date') != ""){
				$fdatetmp = date("Y-m-d",strtotime($this->input->get('ticket_open_date')));
				$arrcond['updated_at >='] = $fdatetmp;
			}
			if($this->input->get('ticket_open_date_to') != ""){
				$fdatetmp = date("Y-m-d",strtotime($this->input->get('ticket_open_date_to')));
				$arrcond['updated_at <='] = $fdatetmp;
			}
			if($this->input->get('by_user_id') != "" && $this->input->get('by_user_id') != "all"){
				$arrcond['assigned_user_id'] = $this->input->get('by_user_id');
			}
			
			$propData = $this->mainticket_model->getTicketList($arrcond);
			$sendData1 = $this->getTicketReport($propData);
			$sendData = "";
			
			$sendData[0]['id'] = "Ticket No";
			$sendData[0]['summary'] = "Ticket Summary";
			$sendData[0]['priority'] = "Priority";
			$sendData[0]['issue'] = "Issue";
			$sendData[0]['unit'] = "Building/Villa/Warehouse No";
			$sendData[0]['assigned_to'] = "Assigned To";
			$sendData[0]['date'] = "Created Date";
			
			$i = 1;
			foreach($sendData1 as $indivProp){
				$sendData[$i] = $indivProp;
				$i++;
			}
			
			
			if(count($sendData) > 0){
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->setTitle('Maintenance Ticket Details');
				$this->excel->getActiveSheet()->setCellValue('A1', 'From: ');
				$this->excel->getActiveSheet()->setCellValue('B1', 'To: ');
				$this->excel->getActiveSheet()->fromArray($sendData);
				$filename='maintenance_custom_report_details'.date("y_m_d_hi").'.xls';
	
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0'); //no cache
							
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
		 
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');
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