<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finance_Model extends CI_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//function to add individual flat and shop in a building
	public function add_expense($inv_filename =""){
		$insdata= array();
		
		$insdata['expense_type'] = $this->input->post('exp_type');
		
		if($this->input->post('exp_type') == "property"){
			$insdata['property_type'] = $this->input->post('prop_ftype');
			if($this->input->post('prop_ftype') == 1){
				$insdata['property_no'] = $this->input->post('flat_name');
				$insdata['flat_no'] = $this->input->post('flat_no');
			}
			if($this->input->post('prop_ftype')==2){
				$insdata['property_no'] = $this->input->post('villa_no');
			}
			if($this->input->post('prop_ftype')==3){
				$insdata['property_no'] = $this->input->post('wh_no');
			}
		}
		$insdata['description'] = $this->input->post('exp_desc');
		$ced = strtotime ($this->input->post('expense_date'));
		$insdata['expense_date'] = date("Y-m-d ",$ced);
		$ped = strtotime ($this->input->post('pay_date'));
		$insdata['payment_date'] = date("Y-m-d ",$ped);
		$insdata['exp_amt'] = $this->input->post('exp_amt');
		$insdata['payment_mode'] = $this->input->post('payment_mode');
		$insdata['created_date'] = date("Y-m-d H:i:s");
		if($inv_filename){
			$insdata['invoice_img_path'] = base_url()."/assets/uploads/".$inv_filename;
		}
		
		if($this->db->insert('expense_detail',$insdata)){
			return true;
		}else{
			return false;
		}
	}
	
	//function to add individual flat and shop in a building
	public function add_income(){
		$insdata= array();
		
		$insdata['property_type'] = $this->input->post('prop_ftype');
		if($this->input->post('prop_ftype') == 1){
			$insdata['property_no'] = $this->input->post('flat_name');
			$insdata['flat_no'] = $this->input->post('flat_no');
		}
		if($this->input->post('prop_ftype')==2){
			$insdata['property_no'] = $this->input->post('villa_no');
		}
		if($this->input->post('prop_ftype')==3){
			$insdata['property_no'] = $this->input->post('wh_no');
		}
		
		$ced = strtotime ($this->input->post('rent_date'));
		$insdata['actual_date'] = date("Y-m-d ",$ced);
		$ped = strtotime ($this->input->post('pay_date'));
		$insdata['paid_date'] = date("Y-m-d ",$ped);
		$insdata['amount_paid'] = $this->input->post('inc_amt');
		$insdata['payment_mode'] = $this->input->post('inpayment_mode');
		
		if($this->input->post('inpayment_mode') == "Cheque"){
			$insdata['cheque_no'] = $this->input->post('cheque_no');
			$insdata['bank_name'] = $this->input->post('cheque_bank');
		}
		
		$insdata['modified_date'] = date("Y-m-d H:i:s");
		if($this->db->insert('rent_income',$insdata)){
			return true;
		}else{
			return false;
		}
	}
	
	//to get the all the expense details
	public function getListFinance($datatype = "expense"){
		$this->db->select('*');
		if($datatype == "expense"){
			$this->db->from('expense_detail');
		}
		if($datatype == "income"){
			$this->db->from('rent_income');
		}
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	
	public function getListExpFinance($fdate="",$edate=""){
		$this->db->select('*');
		$this->db->from('expense_detail');
		
		if($fdate != ""){
			$fdatetmp = date("Y-m-d",strtotime($fdate));
			$this->db->where("expense_date >=",$fdatetmp);
		}
		if($edate != ""){
			$edatetmp = date("Y-m-d",strtotime($edate));
			$this->db->where("expense_date <=",$edatetmp);
		}
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	public function getListIncFinance($fdate="",$edate=""){
		$this->db->select('*');
		$this->db->from('rent_income');
		
		if($fdate != ""){
			$fdatetmp = date("Y-m-d",strtotime($fdate));
			$this->db->where("paid_date >=",$fdatetmp);
		}
		if($edate != ""){
			$edatetmp = date("Y-m-d",strtotime($edate));
			$this->db->where("paid_date <=",$edatetmp);
		}
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	
}
?>