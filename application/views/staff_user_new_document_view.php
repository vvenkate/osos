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
						<li role="presentation"><a href="<?php echo base_url(); ?>index.php/staff" id="home-tab">Employees</a></li>
						<li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/staff/newstaff" role="tab" id="profile-tab">New Employee</a></li>
                    </ul>
                <!-- <form enctype="multipart/form-data" action="addstaff/basic" method="post" name="profile_others">-->
                
               
<!--                 <form action="http://localhost/OSOS2/index.php/staff/addStaffDocsInfo" method="POST" enctype="multipart/form-data" > -->
                
                <?php echo form_open_multipart('staff/addStaffDocsInfo'); ?>
                <?php echo form_hidden('createdStaffId', $createdStaffId); ?>
                
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
                        <input id="passport_no" name="passport_no" class="form-control" required type="text" placeholder="Passport No">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="passort_idt">Passport Issue Date</label>
                        <div class="input-group">
                        	<input id="passort_idt" name="passort_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#passort_idt').focus();">
                        	<img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>/assets/images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="passort_edt">Passport Expiry Date</label>
                        <div class="input-group">
                        <input id="passort_edt" name="passort_edt" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#passort_edt').focus();">
                        <img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>/assets/images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="passport_doc">Upload Passport Document</label>
                        <input type="file" id="passport_doc" name="user_file1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_no">Visa Number</label>
                        <input id="visa_no" name="visa_no" class="form-control" required type="text" placeholder="Visa Number">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_idt">Visa Issue Date</label>
                        <div class="input-group">
                        <input id="visa_idt" name="visa_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy" /><span class="input-group-addon"><a onClick="javascript:$('#visa_idt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_edt">Visa Expiry Date</label>
                        <div class="input-group">
                        <input id="visa_edt" name="visa_edt" class="form-control" type="text" required placeholder="dd-mm-yyyy" /><span class="input-group-addon"><a onClick="javascript:$('#visa_edt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="visa_doc">Upload Visa Document</label>
                        <input type="file" id="visa_doc" name="user_file2">                        
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_no">Emirates ID Number</label>
                        <input id="govt_no" name="govt_no" class="form-control" type="text" required placeholder="Emirates ID">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_idt">Issue Date</label>
                        <div class="input-group">
                        <input id="govt_idt" name="govt_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#govt_idt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_edt">Expiry Date</label>
                        <div class="input-group">
                        <input id="govt_edt" name="govt_edt" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#govt_edt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="govt_doc">Upload Emirates ID Document</label>
                        <input type="file" id="govt_doc" name="user_file3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_no">Driving License</label>
                        <input id="dl_no" name="dl_no" class="form-control" type="text" required placeholder="DL No">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_idt">Issue Date</label>
                        <div class="input-group">
                        <input id="dl_idt" name="dl_idt" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#dl_idt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_edt">Expiry Date</label>
                        <div class="input-group">
                        <input id="dl_edt" name="dl_edt" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#dl_edt').focus();"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        <label for="dl_doc">Upload DL Document</label>
                        <input type="file" id="dl_doc" name="user_file4">
                        </div>
                    </div>
                    
                    <h3 class="h3.-bootstrap-heading group-mail">Health Insurance</h3>
                    <!-- Insurance Details -->
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="insurance_no">Insurance Policy Number</label>
                        <input id="insurance_no" name="insurance_no" class="form-control" type="text" placeholder="Insurance No">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="insurance_comp">Insurance Company</label>
                        <input id="insurance_comp" name="insurance_comp" class="form-control" type="text" placeholder="Company">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="insurance_edt">Expiry Date</label>
                        <div class="input-group">
                        <input id="insurance_edt" name="insurance_edt" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                        </div>
                        </div>
                    </div>
                    
                    <h2 class="h2.-bootstrap-heading group-mail">Dependents Details</h2>
                    <!-- Dependents Details -->
                    <div id="dep_main">
                    	<div id="dep_rows">
                            <div class="row">
                            	<input type="hidden" name="deprows" id="deprows" value="1" />
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dep_name">Full Name</label>
                                <input id="dep_name" name="dep_name1" class="form-control" type="text" placeholder="Full Name">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dep_rel">Relationship</label>
                                <select class="form-control1" id="dep_rel1" name="dep_rel1">
                                  <option value="">-- select one --</option>
                                  <option value="Spouse">Spouse</option>
                                  <option value="Father">Father</option>
                                  <option value="Mother">Mother</option>
                                  <option value="Boy Child">Boy Child</option>
                                  <option value="Girl Child">Girl Child</option>
                                 </select>
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dep_age">Age</label>
                                <input id="dep_age" name="dep_age1" class="form-control" type="text" placeholder="22" maxlength="2">
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
                    </div>
                    
                    <h2 class="h2.-bootstrap-heading group-mail">Education Details</h2>
                    <!-- Education Details -->
                    <div id="edu_main">
                    	<div id="edu_rows">
                            <div class="row">
                            	<input type="hidden" name="edurows" id="edurows" value="1" />
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="edu_degree">Degree</label>
                                <input id="edu_degree" name="edu_degree1" class="form-control" type="text" placeholder="B.Sc or B.S">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="edu_year">Year of Passing</label>
                                <input id="edu_year" name="edu_year1" class="form-control" type="text" placeholder="YYYY">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="edu_college">University/College</label>
                                <input id="edu_college" name="edu_college1" class="form-control" type="text" placeholder="College">
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
                    </div>
                    
                    <h2 class="h2.-bootstrap-heading group-mail">Work Experience Details</h2>
                    <!-- Work Experience Details -->
                    <div id="we_main">
                    	<div id="we_rows">
                            <div class="row">
                           		 <input type="hidden" name="workrows" id="workrows" value="1" />
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="dl_idt">Duration</label><br/>
                                From:
                                <div class="input-group">                                 
                                <input id="we_fdt" name="we_fdt1" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                                </div>
                                To:
                                <div class="input-group">                                
                                <input id="we_tdt" name="we_tdt1" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                                </div>
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="we_role">Designation</label>
                                <input id="we_role" name="we_role1" class="form-control" type="text" placeholder="Role">
                                </div>
                                <div class="col-xs-6 col-md-4 group-mail">
                                <label for="we_company">Company Name</label>
                                <input id="we_company" name="we_company1" class="form-control" type="text" placeholder="Company Name">
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
<!--                 </form> -->
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