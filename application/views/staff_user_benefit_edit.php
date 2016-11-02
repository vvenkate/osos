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
                <!-- <form action="http://localhost/OSOS2/index.php/staff/addStaffBenefit/" method="post" name="profile_main"> -->
				<?php echo form_open('staff/addStaffBenefit'); ?>
                <input type="hidden" name="createdStaffId" value="6">
                
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  	<h2 class="h2.-bootstrap-heading group-mail">Employee Benefit Details</h2>
                    <!-- Personal Details -->
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="salary">Salary</label>
                        <input id="salary" name="salary" class="form-control" type="text" placeholder="5xxx0" value="<?php echo $staff_benefit_list->salary;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="bonus">Accommodation Allowance</label>
                        <input id="bonus" name="bonus" class="form-control" type="text" placeholder="55xx">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                       	<label for="transport">Transport Allowance</label>
                        <input id="transport" name="transport" class="form-control" type="text" placeholder="55xx">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        <label for="telephone">Telephone Allowance</label>
                        <input id="telephone" name="telephone" class="form-control" type="text" placeholder="55xx">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                       
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                       	
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        	<label for="anleave">Annual Leave</label>
							<input id="anleave" name="anleave" class="form-control" type="text" placeholder="xx" value="<?php echo $staff_benefit_list->annual_leave;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                       		<label for="sileave">Sick Leave</label>
							<input id="sileave" name="sileave" class="form-control" type="text" placeholder="xx" value="<?php echo $staff_benefit_list->sick_leave;?>">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                       
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-6 col-md-4 group-mail">
                        
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        
                        </div>
                    </div>
                    
                    <!-- footer-->
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <!-- <button class="btn-default btn">Submit & Complete</button> -->
                                <input type="submit" value="Submit & Complete"/>
                                <button class="btn-inverse btn" type="reset">Reset</button>
                                <!-- <input type="submit" value="Reset"/> -->
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