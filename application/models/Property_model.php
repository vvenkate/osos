<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_Model extends CI_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//function to add individual flat and shop in a building
	public function add_buliding_subprop(){
		//based on property type add villa
		$insdata= array();
		
		$insdata['builder_id']=$this->input->post('prop_building');
		if($this->input->post('prop_ftype') == "Flat"){			
			$insdata['flat_no']=$this->input->post('flat_no');
			$insdata['floor_no']=$this->input->post('flat_floor_no');
			$insdata['income']=$this->input->post('flatf_rent_amt');
			$insdata['created_at'] = date('Y-m-d H:i:s');
			$insdata['flat_type'] = "Studio";
			$insdata['occupied'] = "";
			$insdata['no_of_rooms'] = $this->input->post('fno_rooms');
						
			if($this->db->insert('builder_resedential',$insdata)){
				return true;
			}else{
				return false;
			}
		}
		
		if($this->input->post('prop_ftype') == "6roomflat"){
			$insdata['flat_no']=$this->input->post('flat1_no');
			$insdata['floor_no']="";
			$insdata['income']=$this->input->post('flatf1_rent_amt');
			$insdata['created_at'] = date('Y-m-d H:i:s');
			$insdata['occupied'] = "";
			$insdata['flat_type'] = "6 Bedroom House";
			$insdata['no_of_rooms'] = 6;
						
			if($this->db->insert('builder_resedential',$insdata)){
				return true;
			}else{
				return false;
			}
		}
		
		
		if($this->input->post('prop_ftype') == "Shop"){
			$insdata['builder_id']=$this->input->post('prop_building');
			$insdata['commerical_no']=$this->input->post('shopi_no');
			$insdata['commerical_name']=$this->input->post('shopi_name');
			$insdata['commerical_measure']=$this->input->post('shopi_measure');
			$insdata['commerical_size']=$this->input->post('shopi_size');
			$insdata['income'] = $this->input->post('shopi_rent');
			
			if($this->db->insert('builder_commercial',$insdata)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	public function add_tenant(){
		//based on property type add villa
		$insdata= array();
		
		$insdata['first_name'] = $this->input->post('first_name');
		$insdata['middle_name'] = $this->input->post('mid_name');
		$insdata['last_name'] = $this->input->post('last_name');
		$insdata['gender'] = $this->input->post('gender');
		$dobtime = strtotime ($this->input->post('dob'));
		$insdata['dob'] = date("Y-m-d",$dobtime);
		$insdata['mobile_no'] = $this->input->post('contact_no');
		$insdata['marital_status'] = $this->input->post('mstatus');
		$insdata['nationality'] = $this->input->post('nationality');
		$insdata['org_name'] = $this->input->post('company_name');
		$insdata['tenant_designation'] =$this->input->post('workas');
		
		if($this->db->insert('tenant_details',$insdata)){
			$insdata = "";
			$tentant_id = $this->db->insert_id();
			
			$insdata['tenant_id'] = $tentant_id;
			$insdata['unit_type'] = $this->input->post('prop_ttype');
			
			if($this->input->post('prop_ttype') == 1){
				$insdata['unit_id'] = $this->input->post('flat_name');
				$insdata['flat_no'] = $this->input->post('flat_no');
			}
			if($this->input->post('prop_ttype')==2){
				$insdata['unit_id'] = $this->input->post('villa_no');
			}
			if($this->input->post('prop_ttype')==3){
				$insdata['unit_id'] = $this->input->post('wh_no');
			}
			$insdata['rent_value'] = $this->input->post('tenant_rent');
			$insdata['rent_frequency'] = $this->input->post('tenant_rent_type');
			$insdata['mode_type'] = $this->input->post('payment_mode');
			$csd = strtotime ($this->input->post('tentcont_sd'));
			$insdata['contract_startdate'] = date("Y-m-d ",$csd)."00:00:00";
			$ced = strtotime ($this->input->post('tentcont_ed'));
			$insdata['contract_enddate'] = date("Y-m-d ",$ced)."23:59:59";
			$insdata['created_date'] = date("Y-m-d H:i:s");
			
			if($this->db->insert('tenant_contract',$insdata)){
				$insdata = "";
				$insdata['tenant_id'] = $tentant_id;
				$insdata['id_type'] = $this->input->post('idproof_type');
				$strtime = strtotime($this->input->post('idproof_edt'));
				$insdata['id_expiry_date'] = date("Y-m-d ",$strtime)+"00:00:00";
				$insdata['document_path'] = base_url()."/assets/uploads/".basename($this->upload('passport_doc', $tentant_id));
				$this->db->insert('tenant_documents',$insdata);
				
				if($this->input->post('prop_ttype') == 1){					
					$updata['occupied'] = "YES";
					
					$arrwhere["builder_id"] = $this->input->post('flat_name');
					$arrwhere["id"] = $this->input->post('flat_no');
					$this->db->where($arrwhere);
					$this->db->update('builder_resedential',$updata);
				}
				if($this->input->post('prop_ttype')==2){
					$updata['occupied'] = "YES";
					
					$arrwhere["id"] =$this->input->post('villa_no');
					$this->db->where($arrwhere);
					$this->db->update('villa_details',$updata);
				}
				if($this->input->post('prop_ttype')==3){
					$updata['occupied'] = "YES";
					
					$arrwhere["id"] = $this->input->post('wh_no');
					$this->db->where($arrwhere);
					$this->db->update('warehouse_details',$updata);
				}
				return true;
			}
		}else {
			return false;
		}
	}
	
	//update the tenant details...
	public function update_tenant(){
		//based on property type add villa
		$insdata= array();
		
		$insdata['first_name'] = $this->input->post('first_name');
		$insdata['middle_name'] = $this->input->post('mid_name');
		$insdata['last_name'] = $this->input->post('last_name');
		$insdata['gender'] = $this->input->post('gender');
		$dobtime = strtotime ($this->input->post('dob'));
		$insdata['dob'] = date("Y-m-d",$dobtime);
		$insdata['mobile_no'] = $this->input->post('contact_no');
		$insdata['marital_status'] = $this->input->post('mstatus');
		$insdata['nationality'] = $this->input->post('nationality');
		$insdata['org_name'] = $this->input->post('company_name');
		$insdata['tenant_designation'] =$this->input->post('workas');
		
		$this->db->where('id',$this->input->post('tenant_id'));
		
		if($this->db->update('tenant_details',$insdata)){
			$insdata = "";
			$contract_id = $this->input->post('contract_id');
			
			$insdata['rent_value'] = $this->input->post('tenant_rent');
			$insdata['rent_frequency'] = $this->input->post('tenant_rent_type');
			$insdata['mode_type'] = $this->input->post('payment_mode');
			$csd = strtotime ($this->input->post('tentcont_sd'));
			$insdata['contract_startdate'] = date("Y-m-d ",$csd)."00:00:00";
			$ced = strtotime ($this->input->post('tentcont_ed'));
			$insdata['contract_enddate'] = date("Y-m-d ",$ced)."23:59:59";
			$insdata['modified_date'] = date("Y-m-d H:i:s");
			
			$this->db->where('id',$contract_id);
			
			if($this->db->update('tenant_contract',$insdata)){
				return true;
			}
		}else {
			return false;
		}
	}
	
	public function getTenantDetails($where = ""){
		$this->db->select('*');
		$this->db->from('tenant_details');
		if($where != ""){
			$this->db->where($where);
		}
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	public function getTenantContractw($where = ""){
		$this->db->select('*');
		$this->db->from('tenant_contract');
		
		if($where != ""){
			$this->db->limit(1);
			$this->db->where($where);
		}
		
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	//to get list of building, to display in property list page
	public function getListBuilding($type=""){
		
		if($type == ""){
			$this->db->select('id,name,builder_number,created_at');
			$this->db->from('building_details');
		}else if($type == "villa"){
			$this->db->select('id,name,no,created_at');
			$this->db->from('villa_details');
		}else if($type == "warehouse"){
			$this->db->select('id,name,number,created_at');
			$this->db->from('warehouse_details');
		}
		
		$this->db->order_by('name',"asc");
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	//give just the columns need for the list box.
	public function get_building(){
		
		$this->db->select('id,name');
		$this->db->from('building_details');
		$this->db->order_by('name',"asc");
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	/*
	 * Generic file upload
	 * string file name
	 * returns true/false
	 */
	function upload($upload_file, $user_id){
			
 		//$upload_url_path = base_url()."assets/uploads/".$created_user_id."/";
		
		$file = $upload_file;
		$config =  array(
				//'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/",
				//'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/assets/uploads/".$created_user_id."/",
				'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/assets/uploads/",
				
				//'upload_path'     => $upload_url_path,
				
				'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
				'overwrite'       => TRUE,
				'max_size'        => "16000KB",
				'max_height'      => "768",
				'max_width'       => "1024"
		);
				
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
	
	//give just the columns need for the list box.
	public function get_villa($arrwhere=""){
		
		$this->db->select('id,name');
		$this->db->from('villa_details');
		
		if($arrwhere != ""){
			$this->db->where($arrwhere);
		}
		$this->db->order_by('name',"asc");
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	//give just the columns need for the list box.
	public function get_warehouse($arrwhere=""){

		$this->db->select('id,name');
		$this->db->from('warehouse_details');
		
		if($arrwhere != ""){
			$this->db->where($arrwhere);
		}
		$this->db->order_by('name',"asc");
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	
	//give specific building property
	public function getPropertyDetails($id,$type){
		
		$this->db->select('*');
		if($type == "Building" || $type == "1"){
			$this->db->from('building_details');
		}else if($type == "Villa" || $type == "2"){
			$this->db->from('villa_details');
		}else if($type == "Warehouse" || $type == "3"){
			$this->db->from('warehouse_details');
		}else if($type == "flat" || $type == "4"){
			$this->db->from('builder_resedential');
		}
		
		$this->db->where('id',$id);
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	//give report specific search building property
	public function getSearchPropertyDetails($type,$arrwhere=""){
		
		$this->db->select('*');
		if($type == "Building" || $type == "1"){
			$this->db->from('building_details');
		}else if($type == "Villa" || $type == "2"){
			$this->db->from('villa_details');
		}else if($type == "Warehouse" || $type == "3"){
			$this->db->from('warehouse_details');
		}else if($type == "flat" || $type == "4"){
			$this->db->from('builder_resedential');
		}
		
		if(count($arrwhere) > 0 && $arrwhere != ""){
			$this->db->where($arrwhere);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	//give join rent income and property table with dynamic condition
	public function getPropertyIncomeDetails($type,$arrwhere=""){
		$this->db->select('*');
		
		if($type == "Villa" || $type == "2"){
			$this->db->from('villa_details');
			$this->db->join('rent_income','villa_details.id = rent_income.property_no and rent_income.property_type = 2','left');
		}else if($type == "Warehouse" || $type == "3"){
			$this->db->from('warehouse_details');
			$this->db->join('rent_income','rent_income.property_no != warehouse_details.id and rent_income.property_type = 3','left');
		}else if($type == "flat" || $type == "4"){
			$this->db->from('builder_resedential');
			$this->db->join('rent_income','rent_income.property_no != builder_resedential.builder_id and rent_income.flat_no = builder_resedential.id and rent_income.property_type = 1','left');
		}
		
		$this->db->where($arrwhere);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
			
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
		
	}
	
	//get list of sub property of a building
	public function getListSubProperty($builder_id){
		$this->db->select('*');
		$this->db->from('builder_resedential');
		
		if($builder_id != "")
			$this->db->where('builder_id',$builder_id);		
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	///function to update the individual building, villa and warehouse.
	public function update_property(){
		//based on property type add villa
		$updata= array(
		'city' => $this->input->post('prop_city'),
		'country' => $this->input->post('prop_country'),
		);
		
		$property_id = $this->input->post('property_id');
		
		if($this->input->post('prop_type') == "Building"){
			$updata['builder_number']=$this->input->post('flat_no');
			$updata['name']=$this->input->post('flat_name');
			$updata['builder_address']=$this->input->post('flat_addr_line1');
			$updata['building_address1']=$this->input->post('flat_addr_line2');
			$updata['created_at'] = date('Y-m-d H:i:s');
			
			$this->db->where('id',$property_id);
			if($this->db->update('building_details',$updata)){
				return true;
			}else{
				return false;
			}
		}
		
		if($this->input->post('prop_type') == "Villa"){
			$updata['no']=$this->input->post('villa_no');
			$updata['name']=$this->input->post('villa_name');
			$updata['address']=$this->input->post('villa_addr_line1');
			$updata['address1']=$this->input->post('villa_addr_line2');
			$updata['rooms'] = $this->input->post('no_rooms');
			$updata['yard'] = $this->input->post('villa_yard')== "yes" ? 1 : 0;
			$updata['swimming_pool'] = $this->input->post('villa_swim')== "yes" ? 1 : 0;
			$updata['parking'] = $this->input->post('villa_parking')== "yes" ? 1 : 0;
			$updata['income'] = $this->input->post('villa_rent_amt');
			//$updata['occupied'] = $this->input->post('villa_occupied');
			$updata['created_at'] = date('Y-m-d H:i:s');
			
			$this->db->where('id',$property_id);
			
			if($this->db->update('villa_details',$updata)){
				return true;
			}else{
				return false;
			}
		}
		
		if($this->input->post('prop_type') == "Warehouse"){
			$updata['number']=$this->input->post('wh_no');
			$updata['name']=$this->input->post('wh_name');
			$updata['address']=$this->input->post('wh_addr_line1');
			$updata['address1']=$this->input->post('wh_addr_line2');
			$updata['income'] = $this->input->post('wh_rent');
			$updata['recurring'] = $this->input->post('wh_rent_type');
			$updata['created_at'] = date('Y-m-d H:i:s');
			
			if($this->input->post('wh_size') == "Sq.Ft"){
				$updata['measurement_is_sq_ft_value'] = $this->input->post('wh_measure');
				$updata['measurement_is_sq_ft_value'] = 1;
			}else if($this->input->post('wh_size') == "Sq.Mtr"){
				$updata['measurement_is_sq_value'] = $this->input->post('wh_measure');
				$updata['measurement_is_sq_meter'] = 1;
			}
			
			$this->db->where('id',$property_id);
			if($this->db->update('warehouse_details',$updata)){
				return true;
			}else{
				return false;
			}
		}
		
		if($this->input->post('prop_type') == "Shop"){
			$updata['number']=$this->input->post('shopi_no');
			$updata['name']=$this->input->post('shopi_name');
			$updata['address']=$this->input->post('shopi_addr_line1');
			$updata['address1']=$this->input->post('shopi_addr_line2');
			$updata['income'] = $this->input->post('shopi_rent');
			$updata['created_at'] = date('Y-m-d H:i:s');
			
			if($this->input->post('shopi_size') == "Sq.Ft"){
				$updata['measurement_is_sq_ft_value'] = $this->input->post('shopi_measure');
				$updata['measurement_is_sq_ft'] = 1;
			}else if($this->input->post('shopi_size') == "Sq.Mtr"){
				$updata['measurement_is_sq_value'] = $this->input->post('shopi_measure');
				$updata['measurement_is_sq_meter'] = 1;
			}
			
			$this->db->where('id',$property_id);
			if($this->db->update('shop_details',$updata)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	//function to add individual building, villa and warehouse
	public function add_property(){
		//based on property type add villa
		$insdata= array(
		'city' => $this->input->post('prop_city'),
		'country' => $this->input->post('prop_country'),
		);
		if($this->input->post('prop_type') == "Building"){
			$insdata['builder_number']=$this->input->post('flat_no');
			$insdata['name']=$this->input->post('flat_name');
			$insdata['builder_address']=$this->input->post('flat_addr_line1');
			$insdata['building_address1']=$this->input->post('flat_addr_line2');
			$insdata['created_at'] = date('Y-m-d H:i:s');
			
			if($this->db->insert('building_details',$insdata)){
				return true;
			}else{
				return false;
			}
		}
		
		if($this->input->post('prop_type') == "Villa"){
			$insdata['no']=$this->input->post('villa_no');
			$insdata['name']=$this->input->post('villa_name');
			$insdata['address']=$this->input->post('villa_addr_line1');
			$insdata['address1']=$this->input->post('villa_addr_line2');
			$insdata['rooms'] = $this->input->post('no_rooms');
			$insdata['yard'] = $this->input->post('villa_yard')== "yes" ? 1 : 0;
			$insdata['swimming_pool'] = $this->input->post('villa_swim')== "yes" ? 1 : 0;
			$insdata['parking'] = $this->input->post('villa_parking')== "yes" ? 1 : 0;
			$insdata['income'] = $this->input->post('villa_rent_amt');
			$insdata['occupied'] = "";
			$insdata['created_at'] = date('Y-m-d H:i:s');
			
			if($this->db->insert('villa_details',$insdata)){
				return true;
			}else{
				return false;
			}
		}
		
		if($this->input->post('prop_type') == "Warehouse"){
			$insdata['number']=$this->input->post('wh_no');
			$insdata['name']=$this->input->post('wh_name');
			$insdata['address']=$this->input->post('wh_addr_line1');
			$insdata['address1']=$this->input->post('wh_addr_line2');
			$insdata['income'] = $this->input->post('wh_rent');
			$insdata['recurring'] = $this->input->post('wh_rent_type');
			$insdata['created_at'] = date('Y-m-d H:i:s');
			
			if($this->input->post('wh_size') == "Sq.Ft"){
				$insdata['measurement_is_sq_ft_value'] = $this->input->post('wh_measure');
				$insdata['measurement_is_sq_ft'] = 1;
			}else if($this->input->post('wh_size') == "Sq.Mtr"){
				$insdata['measurement_is_sq_value'] = $this->input->post('wh_measure');
				$insdata['measurement_is_sq_meter'] = 1;
			}
			
			if($this->db->insert('warehouse_details',$insdata)){
				return true;
			}else{
				return false;
			}
		}
		
		if($this->input->post('prop_type') == "Shop"){
			$insdata['number']=$this->input->post('shopi_no');
			$insdata['name']=$this->input->post('shopi_name');
			$insdata['address']=$this->input->post('shopi_addr_line1');
			$insdata['address1']=$this->input->post('shopi_addr_line2');
			$insdata['income'] = $this->input->post('shopi_rent');
			$insdata['created_at'] = date('Y-m-d H:i:s');
			
			if($this->input->post('shopi_size') == "Sq.Ft"){
				$insdata['measurement_is_sq_ft_value'] = $this->input->post('shopi_measure');
				$insdata['measurement_is_sq_ft_value'] = 1;
			}else if($this->input->post('shopi_size') == "Sq.Mtr"){
				$insdata['measurement_is_sq_value'] = $this->input->post('shopi_measure');
				$insdata['measurement_is_sq_meter'] = 1;
			}
			
			if($this->db->insert('shop_details',$insdata)){
				return true;
			}else{
				return false;
			}
		}
		
	}
	
	//list of Tenant
	public function getListTenant(){
		$this->db->select('*');
		$this->db->from('tenant_details');
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
            $row = $query->result();
			return $row;
        } else {
            return false;
        }
	}
	
	public function getTenantContract($id){
		$this->db->select('*');
		$this->db->from('tenant_contract');
		$this->db->where('tenant_id',$id);
		
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result();
			return $row;
        } else {
            return false;
        }
	}
	
	public function isPropExist(){
		extract($_POST);
		
		$country = $this->input->post('prop_country');
        $city = $this->input->post('prop_city');
		$this->db->select('*');
		if($prop_type == "Building"){
			$this->db->from('building_details');
			$this->db->where('builder_number',$flat_no);
			$this->db->where('name',$flat_name);			
		}else if($prop_type == "Villa"){
			$this->db->from('villa_details');
			$this->db->where('no',$villa_no);
			$this->db->where('name',$villa_name);
		}else if($prop_type == "Warehouse"){
			$this->db->from('warehouse_details');
			$this->db->where('number',$wh_no);
			$this->db->where('name',$wh_name);
		}else if($prop_type == "Shop"){
			$this->db->from('shop_details');
			$this->db->where('no',$shopi_no);
			$this->db->where('name',$shopi_name);
		}
		
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
		
	}
	
	public function isSubPropertyExist(){
		$prop_type = $this->input->post("prop_ftype");
		$this->db->select('*');
		if($prop_type == "Flat"){
			$this->db->from('builder_resedential');
			$this->db->where('flat_no',$this->input->post('flat_no'));
			$this->db->where('floor_no',$this->input->post('flat_floor_no'));
			$this->db->where('builder_id',$this->input->post('prop_building'));			
		}else if($prop_type == "6roomflat"){
			$this->db->from('builder_resedential');
			$this->db->where('flat_no',$this->input->post('flat1_no'));
			$this->db->where('builder_id',$this->input->post('prop_building'));			
		}
		else if($prop_type == "Shop"){
			$this->db->from('builder_commercial');
			$this->db->where('commerical_no',$this->input->post('shopi_no'));
			$this->db->where('builder_id',$this->input->post('prop_building'));
		}
		
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
	}
	
	
}
?>