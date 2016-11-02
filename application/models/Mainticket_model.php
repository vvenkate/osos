<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MainTicket_Model extends CI_Model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//function to if any similar ticket has been found.
	public function isSimilarTktFnd(){
		$unit_number =$this->input->post('maint_prop_unit_no');
		$unit_type = $this->input->post('maint_prop_type');
		
		$this->db->select('*');
		$this->db->from('ticket_details');
		$this->db->where('ticket_summary',$unit_number);
		
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
	}
	
	public function add_main_ticket(){
		$insdata= array();
		
		$insdata['ticket_summary']=$this->input->post('ticket_sum');
		$insdata['ticket_desc']=$this->input->post('ticket_desc');
		if($this->input->post('emp_logged_in') == ""){
			$insdata['created_by']="Super Admin";
		}else{
			$insdata['created_by']=$this->input->post('emp_logged_in');
		}
		$insdata['unit_number']=$this->input->post('maint_prop_unit_no');
		if($this->input->post('maint_prop_type') == 1){
			$insdata['flat_no']=$this->input->post('maint_prop_flat_no');
		}
		$insdata['unit_type'] = $this->input->post('maint_prop_type');
		$insdata['issue_type'] = $this->input->post('issue_type');
		$insdata['priority_type'] = $this->input->post('maint_prior');
		$insdata['ticket_status'] = "New";
		$insdata['created_at'] = date('Y-m-d H:i:s');
		$insdata['assigned_user_id'] = $this->input->post('maint_assigned');
					
		if($this->db->insert('ticket_details',$insdata)){
			return true;
		}else{
			return false;
		}
	}
	
	public function update_ticket(){
		$insdata= array();
		
		$insdata['ticket_summary']=$this->input->post('ticket_sum');
		$insdata['ticket_desc']=$this->input->post('ticket_desc');
		if($this->input->post('emp_logged_in') == ""){
			$insdata['created_by']="Super Admin";
		}else{
			$insdata['created_by']=$this->input->post('emp_logged_in');
		}
		$insdata['unit_number']=$this->input->post('maint_prop_unit_no');
		if($this->input->post('maint_prop_type') == 1){
			$insdata['flat_no']=$this->input->post('maint_prop_flat_no');
		}
		$insdata['unit_type'] = $this->input->post('maint_prop_type');
		$insdata['issue_type'] = $this->input->post('issue_type');
		$insdata['priority_type'] = $this->input->post('maint_prior');
		$insdata['ticket_status'] = $this->input->post('ticket_status');
		$insdata['updated_at'] = date('Y-m-d H:i:s');
		$insdata['assigned_user_id'] = $this->input->post('maint_assigned');
		
		$this->db->where('id',$this->input->post('ticket_id'));
					
		if($this->db->update('ticket_details',$insdata)){
			if($this->input->post('ticket_comment') != ""){
				$inscdata['ticket_id'] = $this->input->post('ticket_id');
				$inscdata['ticket_comments'] = $this->input->post('ticket_comment');
				$inscdata['user_id'] = 1;
				$this->db->insert('ticket_comments',$inscdata);
			}
			return true;
		}else{
			return false;
		}
	}
	
	//get Flat based on Builder Id.
	public function getFlat($id){
		$this->db->select('*');
		$this->db->from('builder_resedential');
		$this->db->where('builder_id',$id);
		
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	public function getFlatDetail($id){
		$this->db->select('*');
		$this->db->from('builder_resedential');
		$this->db->where('id',$id);
		
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	public function getTicketDetail($id){
		$this->db->select('*');
		$this->db->from('ticket_details');
		
		$this->db->where('id',$id);
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	public function getTicketCommDetail($id){
		$this->db->select('*');
		$this->db->from('ticket_comments');
		
		$this->db->where('ticket_id',$id);
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	//give just the columns need for the list box for Unit Type.
	public function get_unittype($id=""){
		
		$this->db->select('id,description');
		$this->db->from('unit_type');
		if($id != ""){
			$this->db->where('id',$id);
		}
		$this->db->order_by('description',"asc");
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	
	//give just the columns need for the list box for Unit Type.
	public function get_issuetype($id=""){
		
		$this->db->select('id,description');
		$this->db->from('issue_type');
		if($id != ""){
			$this->db->where('id',$id);
		}
		$this->db->order_by('description',"asc");
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	//give just the columns need for the list box for Unit Type.
	public function get_prior($id=""){
		
		$this->db->select('id,description');
		$this->db->from('priority');
		if($id != ""){
			$this->db->where('id',$id);
		}
		$this->db->order_by('description',"asc");
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
	//get list of tickets
	public function getTicketList(){
		$this->db->select('*');
		$this->db->from('ticket_details');
		$this->db->order_by('created_by',"asc");
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0) {
			$row = $query->result();
            return $row;
        } else {
            return false;
        }
	}
	
// 	//get the ticket details.
// 	public function getTicketDetails($id){
		
	
// 	}
	
	public function getTicketDetailByUser($assigned_user_id, $tkt_status){
		
		$this->db->select('*');
		$this->db->from('ticket_details');
	
		$this->db->where('assigned_user_id', $assigned_user_id);
		$this->db->where('ticket_status', $tkt_status);
		
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	//to get list of users
	public function getMaintanUser(){
		$this->db->select('*');
		$this->db->from('user_personal_details');
	
		$this->db->where('department_id', 5);
		
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
	//to get users specific details
	public function getUserSpec($id){
		$this->db->select('*');
		$this->db->from('user_personal_details');
	
		$this->db->where('id', $id);
		
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			$row = $query->result();
			return $row;
		}else {
			return false;
		}
	}
	
		
	public function insertTicketComments($ticketCommentsData,$image_url){
		extract($ticketCommentsData);

		$curr_date = date('Y-m-d H:i:s');
		
		//Inserting into company_master starts here
		$ticketComments = array(
				///// user_personal_details table ....
				'ticket_id' => $ticket_id,
				'ticket_comments' => $ticket_comments,
				'user_id' => $user_id,
				'image_url' => $image_url,
				'comment_date' => $curr_date,
		);

		$this->db->insert('ticket_comments', $ticketComments);
			
		$insert_id = $this->db->insert_id();
		//echo $insert_id;
		return $ticket_id;
	}
}
?>