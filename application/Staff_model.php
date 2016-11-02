<?php
/*
  * Model class for Login  
  * Author : ManikandaRaja.S
  * Date created : 20 August 2016
  */

class Staff_Model extends CI_Model {
    
	/* 
    * This method validates the user credentials and checks if the user is active
	*/
	public function __construct() {
		$this->load->model( 'Roles', 'roles');
		
	}
	
	public function login(){
		
	}
	
	public function addUserLogin($userLoginData){
		extract($userLoginData);
		$curr_date = date('Y-m-d H:i:s');
		
		//Inserting into company_master starts here
		$userData = array(
				///// user_personal_details table ....
				'user_id' => $first_name,
				'username' => $mid_name,
				'password' => $last_name,
				'privilege_key' => $gender,
				'dob' => $dob,
				'contact_number' => $contact_no,
				'martial_status' => $mstatus,
				'modified_at' => $curr_date,
		);
		
		$this->db->insert('user_login_details', $userData);
			
		$insert_id = $this->db->insert_id();
		return $insert_id;
		
	}
	
	
	public function addStaffPersonal($personalData, $user_id=null){
		extract($personalData);
		
		$curr_date = date('Y-m-d H:i:s');
		
		//Inserting into company_master starts here
		$companydata = array(
				///// user_personal_details table ....
				'first_name' => $first_name,
				'middle_name' => $mid_name,
				'last_name' => $last_name,
				'gender' => $gender,
				'dob' => $dob,
				'contact_number' => $contact_no,
				'martial_status' => $mstatus,
		
				'blood_group' => $bgroup,
				'nationality' => $nationality,
				'designation' => $designation,
				'department_id' => $dept,
				'role_id' => $role,
		
				'permanent_address1' => $address1,
				'permanent_address2' => $address2,
				'permanent_city' => $city,
				'permanent_state' => $state,
				'permanent_zipcode' => $zipcode,
				'permanent_country' => $country,
		
				'current_address1' => $caddress1,
				'current_address2' => $caddress2,
				'current_city' => $ccity,
				'current_state' => $cstate,
				'current_zipcode' =>$czipcode,
				'current_country' => $ccountry,
		
				'emp_id' => $empid,
		
				'reports_to' => 1,
		
				'work_email' => $workemail,
				'personal_email' => $personalemail,
				
				'modified_at' => $curr_date,
		);
		
		$this->session->set_userdata('workemail', $workemail);
		$this->session->set_userdata('personal_email', $personalemail);
		
		
		//$workemail = $this->session->userdata('workemail', $workemail);		
				
		//	$this->session->userdata('role_id', $role);
		
		$staff_id = $user_id;
		
		if(!empty($user_id)){	
			$this->db->where('id', $user_id);
			$this->db->update('user_personal_details', $companydata);
			//return $user_id;
		}else{	
			$companydata['created_at'] = $curr_date;
			$this->db->insert('user_personal_details', $companydata);
			
			$insert_id = $this->db->insert_id();
			//return $insert_id;
			
			// Get the permission bit from the department id ...
			$groupPermission = $this->roles->getPermission($role);
			
			$username = explode("@", $workemail);
			//$data['username'] = $username;

			$userLoginData['user_id']  = $insert_id;
			$userLoginData['username'] = $username[0];
			$userLoginData['password'] = md5($username[0]);
		
			$userLoginData['privilege_key'] = $groupPermission;
			$userLoginData['status'] = 'ACTIVE';

			$userLoginData['lastlogedin'] = $curr_date;
			$userLoginData['created_at'] = $curr_date;
			
			// Now, need to insert into user login details with privileges key
			$this->db->insert('user_login_details', $userLoginData);
					
		}
		
		return $insert_id;
		
	}

	public function addStaffDocsRef($docsRefData, $docArr, $staffId){
// 		var_dump($docsRefData);
// 		var_dump($docArr);		
// 		echo "staffId".$staffId;
		//die(0);
		
		extract($docsRefData);
		$curr_date = date('Y-m-d H:i:s');
	
		//Insert to user_reference_details starts here
		$staffDocdata = array(
				///// user_personal_details table ....
				'user_id' => $staffId,
				'passport_no' => $passport_no,
				'passport_issue_date' => $passort_idt,
				'passport_expiry_date' => $passort_edt,
				'passport_url' => $docArr['passport_url'],
				
				'visa_number' => $visa_no,
				'visa_issue_date' => $visa_idt,
				'visa_expiry_date' => $visa_edt,
				'visa_url' => $docArr['visa_url'],
				
				'emirates_id_number' => $govt_no,
				'emirates_id_issue_date' => $govt_idt,
				'emirates_id_expiry_date' => $govt_edt,
				'emirates_id_url' => $docArr['emirates_id_url'],
				
				'driving_license_number' => $dl_no,
				'driving_license_issue_date' => $dl_idt,
				'driving_license_expiry_date' => $dl_edt,
				'driving_license_url' => $docArr['insurance_url'],

				'health_insurance_policy_number' => $insurance_no,
				'health_insurance_policy_company' => $insurance_comp,
				'health_insurance_policy_expiry' => $insurance_edt,

				//'created_at' => $curr_date,
				'updated_at' => $curr_date,
		);
		
		//if(!empty($staffId)){
// 		if(empty($staffId)){

			//echo 'insert';
			$staffDocdata['created_at'] = $curr_date;
			$staff_id = $this->db->insert('user_document_details', $staffDocdata);
			
// 		}else{
			

// 			echo 'update';
// 			$this->db->where('user_id', $staffId);
// 			$staff_id = $this->db->update('user_document_details', $staffDocdata);
			
			
// 		}
// 		die(0);
		
		// $this->db->insert('user_document_details', $staffDocdata);
		
		// Dependent will go for multiple records
		//echo "Dep Rows".$deprows."<BR>";
		
		for($i = 1; $i <= $deprows; $i++) {
			$staffDependent = array(
					'user_id' => $staffId,
					//'id' => $_POST["staff_dependent_id".$i],
					'dependent_name' => $_POST["dep_name".$i],
					'dependent_type' => $_POST["dep_rel".$i],
					'dependent_age' => $_POST["dep_age".$i],
					'created_at' => $curr_date,
					'modified_at' => $curr_date,
			);
			
			//echo $_POST["staff_dependent_id".$i]."<BR>";
			
			if(!empty($_POST["staff_dependent_id".$i])){
				$this->db->where('id', $_POST["staff_dependent_id".$i]);
				$this->db->update('user_dependent_details', $staffDependent);
			}else{
				//$staffDependent['created_at'] = $curr_date;
				$staff_id = $this->db->insert('user_dependent_details', $staffDependent);
			}
		}
				
		// Education will go for multiple records
		for($i = 1; $i <= $edurows; $i++) {
			$staffEducate = array(
					//'id' => $_POST["staff_education_id".$i],
					'user_id' => $staffId,						
					'degreee_name' => $_POST["edu_degree".$i],
					'education_year_of_pass' => $_POST["edu_year".$i],
					'university_name' => $_POST["edu_college".$i],
					'created_at' => $curr_date,
					'updated_at' => $curr_date,
			);
			
			if(!empty($_POST["staff_education_id".$i])){
				$this->db->where('id', $_POST["staff_education_id".$i]);
				$this->db->update('user_dependent_details', $staffDependent);
			}else{
				$staffDependent['created_at'] = $curr_date;
				$this->db->insert('user_dependent_details', $staffDependent);
			}
			
			//$this->db->insert('user_education_details', $staffEducate);
		}
		
		// Work Experiences will go for multiple records
		for($i = 1; $i <= $workrows; $i++) {
			$staffWorkExperience = array(
					'user_id' => $staffId,
					'work_start_from' => $_POST["we_fdt".$i],
					'work_start_to' => $_POST["we_tdt".$i],
					'designation' => $_POST["we_role".$i],
					'company_name' => $_POST["we_company".$i],			
					'created_at' => $curr_date,
					'updated_at' => $curr_date,
			);
			
			if(!empty($_POST["staff_experience_id".$i])){
				$this->db->where('id', $_POST["staff_experience_id".$i]);
				$this->db->update('user_dependent_details', $staffDependent);
			}else{
				$staffDependent['created_at'] = $curr_date;
				$this->db->insert('user_dependent_details', $staffDependent);
			}
			
			//$this->db->insert('user_experience_details', $staffWorkExperience);
			
		}
		return $staffId;
	}
	
	public function addStaffBenefitInfo($benefitInfo){
		extract($benefitInfo);		
		$curr_date = date('Y-m-d H:i:s');
		
		//var_dump($benefitInfo);
		//echo 'createdStaffId'.$createdStaffId;		

		if(isset($createdStaffId)){
			$staffBenefitData = array(
					'salary' => $salary,
					'bonus' => $bonus,
					'annual_leave' => $anleave,
					'sick_leave' => $sileave,
					//'created_at' => $curr_date,
					'modified_at' => $curr_date,
			);
			
			$this->db->where('user_id', $createdStaffId);
			$this->db->update('user_benefit_details', $staffBenefitData);
		}else{
			$staffBenefitData = array(
					'user_id' => $createdStaffId,
					'salary' => $salary,
					'bonus' => $bonus,
					'annual_leave' => $anleave,
					'sick_leave' => $sileave,
					'created_at' => $curr_date,
					'modified_at' => $curr_date,
			);
			$this->db->insert($staffBenefitData);
		}
		
		return true;
		
		//die(0);
		
// 		if(!array_key_exists('user_id',$createdStaffId)){
			
// 					$staffBenefitData = array(
// 							///// user_personal_details table ....
// 							'user_id' => $createdStaffId,
// 							'salary' => $salary,
// 							'bonus' => $bonus,
// 							'annual_leave' => $anleave,
// 							'sick_leave' => $sileave,
// 							'created_at' => $curr_date,
// 							'modified_at' => $curr_date,
// 					);
			
// 			return $this->db->insert($data);
// 		}
		
		
// 		$row = $this->db->get_where('mytable',['id' => $data['id']])->row();
		
// 		if(!$row) return false;
		
// 		$this->db->where($row->id);
// 		return $this->db->update('my_table',$data);
		
// 		$sql = 'INSERT INTO user_benefit_details (user_id, salary, bonus, annual_leave, sick_leave, created_at,modified_at)
//         VALUES ($createdStaffId, $salary, $bonus, $anleave, $sileave, $curr_date, $curr_date)
//         ON DUPLICATE KEY UPDATE
//             user_id=$createdStaffId,
//             salary=$salary,
//             bonus=$bonus,
//             annual_leave=$anleave,
// 			sick_leave=$sileave,
// 			curr_date=$curr_date,
// 			modified_at=$curr_date';
				
// 		$query = $this->db->query($sql, array($createdStaffId, $salary, $bonus, $anleave, $sileave, $curr_date, $curr_date));
// 		var_dump($query);		
// 		die(0);
		
// 		$staffBenefitData = array(
// 				///// user_personal_details table ....
// 				'user_id' => $createdStaffId,
// 				'salary' => $salary,
// 				'bonus' => $bonus,
// 				'annual_leave' => $anleave,
// 				'sick_leave' => $sileave,
// 				'created_at' => $curr_date,
// 				'modified_at' => $curr_date,
// 		);
		
// 		$this->db->insert('user_benefit_details', $staffBenefitData);
		return $createdStaffId;		
	}
	
	public function editStaffBenefitInfo(){
		extract($_POST);
		$curr_date = date('Y-m-d H:i:s');
	
		$staffBenefitData = array(
				///// user_personal_details table ....
				'user_id' => $createdStaffId,
				'salary' => $salary,
				'bonus' => $bonus,
				'annual_leave' => $anleave,
				'sick_leave' => $sileave,
				'created_at' => $curr_date,
				'modified_at' => $curr_date,
		);
	
		$this->db->insert('user_benefit_details', $staffBenefitData);
		return $createdStaffId;
	}
	public function getStaffList(){
		$this->db->select('user.id, user.first_name, user.first_name, user.last_name, user.designation, depart.name, user.created_at');
		$this->db->from('user_personal_details user');
		$this->db->join('department depart','user.department_id=depart.id');
		
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			//return $query->row()->name;
			return $query->result();
		} else {
			return 0;
		}
	}
	// Structure user_benefit_details
	// 
	
	public function getStaffPerDocInfo($id){

		//$this->db->select('user.first_name, user.last_name, user.designation, depart.name, user.created_at');
		$this->db->select('*');
		$this->db->from('user_personal_details user');
		$this->db->join('user_document_details document','document.user_id=user.id');
		
		
		
 		//$this->db->join('user_benefit_details benefit','benefit.user_id=user.id');
 		
//  		$this->db->join('user_dependent_details dependent','dependent.user_id=user.id');
//   		$this->db->join('user_document_details document','document.user_id=user.id');
//  		$this->db->join('user_education_details education','education.user_id=user.id');
//   		$this->db->join('user_experience_details experience','experience.user_id=user.id');

		
 		$this->db->where('user.id', $id);
 		
 		
		
		$query = $this->db->get();
//  		print_r($this->db->last_query());
// 		die(0);
		
		if ($query->num_rows() > 0) {
			//return $query->row()->name;
			return $query->result();
		} else {
			return 0;
		}
	}
	
	/*
	 * Get Staff Dependent Info
	 */
	public function getStaffDependentInfo($user_id){	
		$this->db->select('*');
		$this->db->from('user_dependent_details');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	/*
	 * Get Staff Education Info
	 */
	public function getStaffEducationInfo($user_id){
		$this->db->select('*');
		$this->db->from('user_education_details');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
				
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}		
	}

	/*
	 * Get Staff Experience Info
	*/
	public function getStaffExperienceInfo($user_id){
		$this->db->select('*');
		$this->db->from('user_experience_details');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
			
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	/*
	 * Get Staff Benefit Info
	*/
	public function getStaffBenefitInfo($user_id){
		$this->db->select('*');
		$this->db->from('user_benefit_details');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
			
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}	
	
	public function save_staff() {
        extract($_POST);
        $curr_date = date('Y-m-d H:i:s');
        
        $staffdata = array(
        		'company_name' => $company_name,
        		'comp_regist_num' => $regno,
        		'business_type' => $business_type,
        		'business_size' => $business_s,
        		'comp_phone' => $phoneno,
        		'comp_fax' => $faxno,
        		'comp_address' => $street,
        		'comp_city' => $city,
        		'comp_state' => $pers_states,
        		'comp_cntry' => $company_country,
        		'comp_zip' => $zipcode,
        		'comp_scn' => '',
        		'company_status' => '',
        		'remarks' =>$comments,
        		'acct_activation_date_time' => $curr_date,
        		'acct_deactivation_date_time' => '0000-00-00',
        		'deactivation_reason' => '',
        		'deactivated_by' => '',
        		'created_by' => '',
        		'created_on' => $curr_date,
        		'last_modified_by' => '',
        		'last_modified_on' => $curr_date,
        );
        
        $uname = mysql_real_escape_string($username);
        $pwd = mysql_real_escape_string($password);
        //$pwd = mysql_real_escape_string(md5($password)); // NEED TO USE MD5 ENCRYPTED METHOD ONCE ALL THE PASSWORD HAS BEEN MERGED INTO ENCRYPTION - LATER
        $this->db->select('pers.first_name, pers.last_name, pers.tenant_id, usr.user_id, ten.logo, ten.copyrighttext, ten.currency, ten.country,ten.applicationname');
        $this->db->from('tms_users_pers pers');
        $this->db->join('tms_users usr','usr.tenant_id = pers.tenant_id and usr.user_id = pers.user_id');
        $this->db->join('tenant_master ten','usr.tenant_id=ten.tenant_id');
        $this->db->where('usr.user_name', $uname);
        $this->db->where('usr.password', $pwd);
        $this->db->where('usr.account_status', 'ACTIVE');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }
    
    
    /**
     * Get the Role Id for the user currently logged in
     * @input - tenant_id, user_id
     * @output - role_id
    */    
    public function getRoleId($tenant_id, $user_id) {
        $this->db->select('role_id');
        $this->db->from('internal_user_role');
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        //echo "I am in get role*********"; 
        if ($query->num_rows() > 0) {
            return $query->row()->role_id;
        } else {
            return 0;
        }
    }
    
    /*
     * Function used to check the user credentials while doing forgot username and password.
     * @output - username and password
     */
    public function check_user_credentials($forgot_setting, $email, $dob) {       
        $this->db->select('usr.user_name, usr.password');
        $this->db->from('tms_users_pers pers');
        $this->db->join('tms_users usr','usr.tenant_id = pers.tenant_id and usr.user_id = pers.user_id');
        $this->db->where('usr.registered_email_id', $email);
        $this->db->where('pers.dob', $dob);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }
    
    /*Update User Role Id alone*/
    
    public function updateUserRoleId($user_id, $role_id){
    	if(!empty($user_id)){
    		$updateUserRole['role_id'] =  $role_id;
    		    		
    		$this->db->where('id', $user_id);
    		$this->db->update('user_personal_details', $updateUserRole);
    		//return $user_id;
    	}
    }
    
    
    /*Update User Role Id alone*/
    
    public function updateUserPrivileges($user_id, $permission){
    	if(!empty($user_id)){
    		$updateUserPermission['privilege_key'] =  $permission;
    		
    		$this->db->where('user_id', $user_id);
    		//$this->db->where('id', $user_id);
    		$this->db->update('user_login_details', $updateUserPermission);
    		//return $user_id;
    	}
    }
    
    
    
    
    
}
    
    
    
?>    