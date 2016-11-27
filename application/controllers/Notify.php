<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
class Notify extends CI_Controller {
	function __construct() {
		parent::__construct ();
		ini_set('display_errors', true);
		//$this->load->model ( 'user', '', TRUE );
		$this->load->model ( 'property_model');
		$this->load->model( 'Finance_Model', 'finance_model');
		$this->load->model( 'Country_model', 'country');
		//$this->load->model('acl_model', 'acl');
	}
	
	public function index(){
		$sendData = "";
		$cheqData = "";
		
		$arrwhere['occupied'] = "YES";
		$i = 0;
		$type = 2;
		$villaData = $this->property_model->getPropertyIncomeDetails($type, $arrwhere);
		
		if($villaData != ""){
			foreach($villaData as $villa){
				//$sendData[$i]['type'] = $type;
				//$sendData[$i]['name'] = $villadata->;
				
				$i++;
			}
		}
		$type = 3;
		$wareData = $this->property_model->getPropertyIncomeDetails($type, $arrwhere);
		if($wareData != ""){
			foreach($wareData as $ware){
				//$sendData[$i]['type'] = $type;
				
			}
		}
		$type = 4;
		$flatData = $this->property_model->getPropertyIncomeDetails($type, $arrwhere);
		if($flatData != ""){
			foreach($flatData as $flats){
				//$sendData[$i]['type'] = $type;
			}
		}
		
		
		$cheqwhere['payment_mode'] = 'Cheque';
		$fdate = date('Y-m-d');
		$tdate = date('Y-m-d',strtotime('+7 days'));
		$cheqwhere['paid_date >='] = $fdate;
		$cheqwhere['paid_date <='] = $tdate;
		
		$arrCheqData = $this->finance_model->getListFinance('income',$cheqwhere);
		$i= 0;
		if($arrCheqData){
			foreach($arrCheqData as $val){
				$propdata = $this->property_model->getPropertyDetails($val->property_no,$val->property_type);
				if($val->property_type == 1){
					$cheqData[$i]['prop_det'] = "Building";
				}else if($val->property_type == 2){
					$cheqData[$i]['prop_det'] = "Villa";
				}else if($val->property_type == 3){
					$cheqData[$i]['prop_det'] = "Warehouse";
				}
				$cheqData[$i]['prop_det'] .= $propdata[0]->name;
				
				$edate = strtotime($val->paid_date);
				$cheqData[$i]['chq_date'] = date("d-M-Y",$edate);
				$cheqData[$i]['amt'] = $val->amount_paid;
				$cheqData[$i]['chq_no'] = $val->cheque_no;
				
				$i++;
			}
		}
		$data = array("sendData" => $sendData,"cheqdata"=>$cheqData);
		$this->load->view('notification_list', $data);
	}
}
?>