<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Property Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>


<script src="<?php echo base_url()?>assets/js/custom.js"></script>

<script src="<?php echo base_url()?>assets/js/ajaxfileupload.js"></script>
    
<script>
$(function () {
	$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

	if (!screenfull.enabled) {
		return false;
	}
	
	$('#toggle').click(function () {
		screenfull.toggle($('#container')[0]);
	});
});
</script>
</head>
<body>
<div id="wrapper">
       <?php $this->load->view('common/header_menu');?>
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">

 	 <!--faq-->
 	<div class="blank">
		<div class="blank-page">
			<div class="grid_3 grid_5">
                 <!--h3 class="head-top">Tabs</h3-->
                 <div class="but_list">
                   <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">                    
                    	<li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/staff" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Employees</a></li>
                      	<li role="presentation"><a href="<?php echo base_url(); ?>index.php/staff/newstaff" role="tab" id="profile-tab">New Employee</a></li>                    
                    </ul>
                <?php echo form_open('staff/editStaffDocsInfo'); ?>
                <?php echo form_hidden('createdStaffId', $created_staff_id); ?>
                
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  	<h2 class="h2.-bootstrap-heading group-mail">Passport, VISA and Govt Details</h2>
                    <!-- Passport and Visa details Details -->
                    <div class="row">
						<div class="col-md-12 group-mail div_disable" style="color:#C03" id="errorfields">
							Please fill all mandatory fields/upload files.
						</div>
					</div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="passport_no">Passport Number</label>
                        <input id="passport_no" name="passport_no" class="form-control" required type="text" placeholder="Passport No" value="<?php echo $staff_personal_list->passport_no;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="passort_idt">Passport Issue Date</label>
                        <div class="input-group">
                        	<input id="passort_idt" name="passort_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy"  value="<?php echo $staff_personal_list->passport_issue_date;?>"><span class="input-group-addon"><a onClick="javascript:$('#passort_idt').focus();">
                        	<img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>/assets/images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="passort_edt">Passport Expiry Date</label>
                        <div class="input-group">
                        <input id="passort_edt" name="passort_edt" class="form-control" type="text" required placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->passport_expiry_date;?>"><span class="input-group-addon"><a onClick="javascript:$('#passort_edt').focus();">
                        <img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>/assets/images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="passport_doc">Upload Passport Document</label>
                        <input type="file" id="passport_doc" name="user_file1">
                        <a href="<?php echo $staff_personal_list->passport_url;?>"><?php echo basename($staff_personal_list->passport_url);?></a>                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_no">Visa Number</label>
                        <input id="visa_no" name="visa_no" class="form-control" required type="text" placeholder="Visa Number" value="<?php echo $staff_personal_list->visa_number;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_idt">Visa Issue Date</label>
                        <div class="input-group">
                        <input id="visa_idt" name="visa_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->visa_issue_date;?>"/><span class="input-group-addon"><a onClick="javascript:$('#visa_idt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_edt">Visa Expiry Date</label>
                        <div class="input-group">
                        <input id="visa_edt" name="visa_edt" class="form-control" type="text" required placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->visa_expiry_date;?>"/><span class="input-group-addon"><a onClick="javascript:$('#visa_edt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_doc">Upload Visa Document</label>
                        <input type="file" id="visa_doc" name="user_file2">
                        <a href="<?php echo $staff_personal_list->visa_url;?>"><?php echo basename($staff_personal_list->visa_url);?></a>                    
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_no">Emirates ID Number</label>
                        <input id="govt_no" name="govt_no" class="form-control" type="text" required placeholder="Emirates ID" value="<?php echo $staff_personal_list->emirates_id_number;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_idt">Issue Date</label>
                        <div class="input-group">
                        <input id="govt_idt" name="govt_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->emirates_id_issue_date;?>"><span class="input-group-addon"><a onClick="javascript:$('#govt_idt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_edt">Expiry Date</label>
                        <div class="input-group">
                        <input id="govt_edt" name="govt_edt" class="form-control" type="text" placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->emirates_id_expiry_date;?>"><span class="input-group-addon"><a onClick="javascript:$('#govt_edt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_doc">Upload Emirates ID Document</label>
                        <input type="file" id="govt_doc" name="user_file3">                        
                        <a href="<?php echo $staff_personal_list->emirates_id_url;?>"><?php echo basename($staff_personal_list->emirates_id_url);?></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_no">Driving License</label>
                        <input id="dl_no" name="dl_no" class="form-control" type="text" required placeholder="DL No" value="<?php echo $staff_personal_list->driving_license_number;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_idt">Issue Date</label>
                        <div class="input-group">
                        <input id="dl_idt" name="dl_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->driving_license_issue_date;?>"><span class="input-group-addon"><a onClick="javascript:$('#dl_idt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_edt">Expiry Date</label>
                        <div class="input-group">
                        <input id="dl_edt" name="dl_edt" class="form-control" type="text" placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->driving_license_expiry_date;?>"><span class="input-group-addon"><a onClick="javascript:$('#dl_edt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_doc">Upload DL Document</label>
                        <input type="file" id="dl_doc" name="user_file4">
                        <a href="<?php echo $staff_personal_list->driving_license_url;?>"><?php echo basename($staff_personal_list->driving_license_url);?></a>
                        </div>
                    </div>
                    
                    <h3 class="h3.-bootstrap-heading group-mail">Health Insurance</h3>
                    <!-- Insurance Details -->
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="insurance_no">Insurance Policy Number</label>
                        <input id="insurance_no" name="insurance_no" class="form-control" type="text" placeholder="Insurance No" value="<?php echo $staff_personal_list->health_insurance_policy_number;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="insurance_comp">Insurance Company</label>
                        <input id="insurance_comp" name="insurance_comp" class="form-control" type="text" placeholder="Company" value="<?php echo $staff_personal_list->health_insurance_policy_company;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="insurance_edt">Expiry Date</label>
                        <div class="input-group">
                        <input id="insurance_edt" name="insurance_edt" class="form-control" type="text" placeholder="dd-mm-yyyy" value="<?php echo $staff_personal_list->health_insurance_policy_expiry;?>"><span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    
                    <h2 class="h2.-bootstrap-heading group-mail">Dependents Details</h2>
                    <!-- Dependents Details -->
                    <div id="dep_main">
                    	<?php
                    		$i= 1;														
							foreach ($staff_dependent_list as $value):																	
						?>                    	
                    	<div id="dep_rows">
                            <div class="row">
                            	<input type="hidden" name="deprows" id="deprows" value="<?php echo $i;?>" />
                            	
                            	<input type="hidden" name="staff_dependent_id<?php echo $i;?>" id="staff_dependent_id<?php echo $i;?>" value="<?php echo $value->id;?>" />
                            	
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dep_name">Full Name</label>
                                <input id="dep_name<?php echo $i;?>" name="dep_name<?php echo $i;?>" class="form-control" type="text" placeholder="Full Name" value="<?php echo $value->dependent_name;?>">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dep_rel">Relationship</label>
								<select class="form-control1" id="dep_rel<?php echo $i;?>" name="dep_rel<?php echo $i;?>">
                                	<option value="">-- select one --</option>
									<?php														
										foreach ($relationship_list as $key):
										
										if($key->name == $value->dependent_type){
											$isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
										} else {
											$isSelected = ''; // else we remove any tag
										}
									?>
									<option value="<?php echo $key->name;?>" <?php echo $isSelected ?>><?php echo $key->name;?></option>														
									<?php
                                		endforeach;
                            		?>
                                 </select>
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dep_age">Age</label>
                                <input id="dep_age<?php echo $i;?>" name="dep_age<?php echo $i;?>" class="form-control" type="text" placeholder="22" maxlength="2" value="<?php echo $value->dependent_age;?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-md-4">
                            
                            </div>
                            <div class="col-xs-6 col-md-4">
                            
                            </div>
                            <div class="col-xs-6 col-md-4 text-right">
                            <a id="addDep"><img src="<?php echo base_url(); ?>assets/images/plus.png" width="30" height="30"/></a>
                            </div>
                        </div>
                    	<?php
                    		$i++;
                    		endforeach;
                    	?>
                    </div>
                    
                    <h2 class="h2.-bootstrap-heading group-mail">Education Details</h2>
                    <!-- Education Details -->
                    <div id="edu_main">
                    	<?php
                    		$i=1;												
							foreach ($staff_education_list as $value):												
						?>
                    	<div id="edu_rows">
                            <div class="row">
                            	<input type="hidden" name="edurows" id="edurows" value="<?php echo $i;?>" />
                            	<input type="hidden" name="staff_education_id<?php echo $i;?>" id="staff_education_id".<?php echo $i;?> value="<?php echo $value->id;?>" />
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="edu_degree">Degree</label>
                                <input id="edu_degree<?php echo $i;?>" name="edu_degree<?php echo $i;?>" class="form-control" type="text" placeholder="B.Sc or B.S" value="<?php echo $value->degreee_name;?>">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="edu_year">Year of Passing</label>
                                <input id="edu_year<?php echo $i;?>" name="edu_year<?php echo $i;?>" class="form-control" type="text" placeholder="YYYY" value="<?php echo $value->education_year_of_pass;?>">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="edu_college">University/College</label>
                                <input id="edu_college<?php echo $i;?>" name="edu_college<?php echo $i;?>" class="form-control" type="text" placeholder="College" value="<?php echo $value->university_name;?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-md-4">
                            
                            </div>
                            <div class="col-xs-6 col-md-4">
                            
                            </div>
                            <div class="col-xs-6 col-md-4 text-right">
                            <a id="addEdu"><img src="<?php echo base_url(); ?>assets/images/plus.png" width="30" height="30"/></a>
                            </div>
                        </div>
                        <?php
                        	$i++;
                    		endforeach;
                    	?>
                    </div>
                    
                    <h2 class="h2.-bootstrap-heading group-mail">Work Experience Details</h2>
                    <!-- Work Experience Details -->
                    <div id="we_main">
                    	<?php
                    		$i=1;												
							foreach ($staff_experience_list as $value):
						?>
                    	<div id="we_rows">
                            <div class="row">
                           		<input type="hidden" name="workrows" id="workrows" value="<?php echo $i;?>" />
                           		<input type="hidden" name="staff_experience_id<?php echo $i;?>" id="staff_experience_id".<?php echo $i;?> value="<?php echo $value->id;?>" />
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dl_idt">Duration</label><br/>
                                From:
                                <div class="input-group">                                 
                                <input id="we_fdt<?php echo $i;?>" name="we_fdt<?php echo $i;?>" class="form-control" type="text" placeholder="dd-mm-yyyy" value="<?php echo $value->work_start_from;?>"><span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                                </div>
                                To:
                                <div class="input-group">                                
                                <input id="we_tdt<?php echo $i;?>" name="we_tdt<?php echo $i;?>" class="form-control" type="text" placeholder="dd-mm-yyyy" value="<?php echo $value->work_start_to;?>"><span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                                </div>
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="we_role">Designation</label>
                                <input id="we_role<?php echo $i;?>" name="we_role<?php echo $i;?>" class="form-control" type="text" placeholder="Role" value="<?php echo $value->company_name;?>">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="we_company">Company Name</label>
                                <input id="we_company<?php echo $i;?>" name="we_company<?php echo $i;?>" class="form-control" type="text" placeholder="Company Name" value="<?php echo $value->designation;?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-md-4">
                            
                            </div>
                            <div class="col-xs-6 col-md-4">
                            
                            </div>
                            <div class="col-xs-6 col-md-4 text-right">
                            <a id="addwe"><img src="<?php echo base_url(); ?>assets/images/plus.png" width="30" height="30"/></a>
                            </div>
                        </div>
                        <?php
                        	$i++;
                    		endforeach;
                    	?>
                    </div>
                                        
                    <!-- footer-->
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                            	<input type="hidden" name="emp_id" value="XXX" />
                                <button id="save2" class="btn-primary btn">Save</button>
                                <button id="save2n" class="btn-default btn">Save & Next</button>
                                <button class="btn-inverse btn" type="reset">Reset</button>
                            </div>
                        </div>
                     </div>
                  </div>
                </div>
                </form>
           </div>
           </div>
          </div>
	    </div>
	</div>
	
	<!--//faq-->
		<!---->
<div class="copy">
            <p> &copy; 2016 Virtual Desk. All Rights Reserved | Developed by <a href="http://fomaxtech.com/" target="_blank">Avohi</a> </p>	    </div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     
<!---->
<!--scrolling js-->

	<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/js/scripts.js" type="text/javascript" charset="utf-8"></script>       	
	
    <script language="javascript">
		$('#passort_idt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		$('#passort_edt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		$('#visa_idt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		$('#visa_edt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		
		$('#govt_idt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		$('#govt_edt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		
		$('#dl_idt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		$('#dl_edt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
	</script>
    </script>
	<!--//scrolling js-->
</body>
</html>