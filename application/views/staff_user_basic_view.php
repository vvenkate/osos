<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Property Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/user_add.js"></script>
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

				<!--banner-->
				<div class="banner">
					<h2>
						<a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <span>Staff
							Management</span>
					</h2>
				</div>
				<!--//banner-->
				<!--faq-->
				<div class="blank">
					<div class="blank-page">
						<div class="grid_3 grid_5">
							<!--h3 class="head-top">Tabs</h3-->
							<div class="but_list">
								<div class="bs-example bs-example-tabs" role="tabpanel"
									data-example-id="togglable-tabs">
									<ul id="myTab" class="nav nav-tabs" role="tablist">
                      					<li role="presentation"><a href="<?php echo base_url(); ?>index.php/staff" id="home-tab">Employees</a></li>
                      					<li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/staff/newstaff" role="tab" id="profile-tab">New Employee</a></li>
									</ul>
                                    <?php echo form_open('staff/addStaffPersonal'); ?>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                            <h2 class="h2.-bootstrap-heading group-mail">Personal Details</h2>
                                        <!-- Personal Details -->
                                        <div class="row">
                                            <div class="col-md-12 group-mail div_disable" style="color:#C03" id="errorfields">
                                                Please fill all mandatory fields.
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="first_name">First Name</label>
                                            <input id="first_name" name="first_name" class="form-control" required type="text" placeholder="First name">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="mid_name">Middle Name</label>
                                            <input id="mid_name" name="mid_name" class="form-control" type="text" placeholder="Middle name">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="last_name">Last Name</label>
                                            <input id="last_name" name="last_name" class="form-control" required type="text" placeholder="Last name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="gender">Gender</label>
                                                <div class="radio block"><label><input type="radio" name="gender" id="gender" value="Male" checked> Male</label></div>
                                                <div class="radio block"><label><input type="radio" name="gender" id="gender" value="Female"> Female</label></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="dob">Date of Birth</label>
                                            <div class="input-group">
                                                <input id="dob" name="dob" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#dob').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>
                                            </div>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="contact_no">Mobile Number</label>
                                            <input id="contact_no" name="contact_no" class="form-control" required type="text" placeholder="9XXXXXXX8">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="mstatus">Marital Status</label>
                                                <div class="radio block"><label><input type="radio" name="mstatus" id="mstatus" value="Single" checked> Single</label></div>
                                                <div class="radio block"><label><input type="radio" name="mstatus" id="mstatus" value="Married"> Married</label></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="nationality">Nationality</label>
                                                <select class="form-control1" id="nationality" name="nationality" required>
													<option value="">-- select one --</option>
													<?php
														foreach ($nationalities_list as $value):
													?>
														<option value="<?php echo $value->Nationality;?>"><?php echo $value->Nationality;?></option>
													<?php
		                                			endforeach;
		                            				?>
                                                </select>
                                            </div>                        
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="bgroup">Blood Group</label>
                                            <input id="bgroup" name="bgroup" class="form-control" type="text" placeholder="O+ve">
                                            </div>
                                        </div>
                                        
                                        <h3 class="h3.-bootstrap-heading group-mail">Permanent Address</h3>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="address1">Address Line 1</label>
                                            <input id="address1" name="address1" class="form-control" required type="text" placeholder="Address">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="address2">Address Line 2</label>
                                            <input id="address2" name="address2" class="form-control" type="text" placeholder="">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="city">City</label>
                                            <input id="city" name="city" class="form-control" required type="text" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="state">State/Province</label>
                                            <input id="state" name="state" class="form-control" required type="text" placeholder="State">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="zipcode">Zipcode</label>
                                            <input id="zipcode" name="zipcode" class="form-control" type="text" placeholder="45X6S">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="country">Country</label>
                                            <select  class="form-control1" name="country" required>
                                                <option value="">Country...</option>
                                                <?php
												foreach ($country_list as $value):
												?>
												<option value="<?php echo $value->Country;?>"><?php echo $value->Country;?></option>
												<?php
		                                		endforeach;
		                            			?>
                                             </select>
                                            </div>
                                        </div>
                                        <h3 class="h3.-bootstrap-heading group-mail">Current Address</h3>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="caddress1">Address Line 1</label>
                                            <input id="caddress1" name="caddress1" class="form-control" required type="text" placeholder="Address">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="caddress2">Address Line 2</label>
                                            <input id="caddress2" name="caddress2" class="form-control" type="text" placeholder="">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="ccity">City</label>
                                            <input id="ccity" name="ccity" class="form-control" required type="text" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="ccountry">Country</label>
                                            <select class="form-control1" name="ccountry">
                                                <option value="">Country...</option>
                                                <?php
												foreach ($country_list as $value):
												?>
												<option value="<?php echo $value->Country;?>"><?php echo $value->Country;?></option>
												<?php
		                                		endforeach;
		                            			?>
                                             </select>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <!--label for="cstate">State/Province</label>
                                            <input id="cstate" name="cstate" class="form-control" required type="text" placeholder="Address"-->
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <!--label for="czipcode">Zipcode</label>
                                            <input id="czipcode" name="czipcode" class="form-control" required type="text" placeholder=""-->
                                            </div>
                                        </div>
                                        <h2 class="h2.-bootstrap-heading group-mail">Organization Details</h2>
                                        <!-- Organization Details -->
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="empid">Employee ID</label>
                                            
                                            
                                            <input id="empid" name="empid" class="form-control" required type="text" placeholder="Employee ID">
                                            
                                            
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="designation">Designation</label>
                                            <input id="designation" name="designation" class="form-control" required type="text" placeholder="Designation">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="dept">Department</label>
                                            <select class="form-control1" id="dept" name="dept" required>
                                            	<option value="">--Select--</option>
                                            <?php
                                            foreach ($department_list as $item):
											?>
												<option value="<?php echo $item->id;?>"><?php echo $item->name;?></option>
											<?php
                                			endforeach;
                            				?>
                            				</select>
                                            </div>
                                        </div>
                                        <div class="row">
<!--                                             <div class="col-xs-6 col-md-4 group-mail"> -->
<!--                                             <label for="reportsto">Reports To:</label> -->
<!--                                             <select class="form-control1" id="reportsto" name="reportsto" required> -->
<!--                                                 <option value="">--Select--</option> -->
<!--                                                 <option value="1">Manager 1</option> -->
<!--                                                 <option value="2">Manager 2</option> -->
<!--                                                 <option value="3">Manager 3</option> -->
<!--                                             </select> -->
<!--                                             </div> -->
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="reportsto">Module Access/Role:</label>
                                            
                                            <select class="form-control1" id="role" name="role" required>
                                                <option value="">--Select--</option>
                                                 <?php
                                            foreach ($roles_list as $roles):
											?>
												<option value="<?php echo $roles->id;?>"><?php echo $roles->name;?></option>
											<?php
                                			endforeach;
                            				?>
                                            </select>
                                            
                                            
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="workemail">Work Email ID</label>
                                            <input id="workemail" name="workemail" class="form-control" required type="email" placeholder="Email ID">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="personalemail">Personal Email ID</label>
                                            <input id="personalemail" name="personalemail" class="form-control" required type="email" placeholder="Email ID">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        <!-- footer-->
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button id="save1" class="btn-primary btn">Save</button>
                                                    <button id="save1n" class="btn-default btn">Save & Next</button>
                                                    <button class="btn-inverse btn" type="reset">Reset</button>
                                                </div>
                                            </div>
                                         </div>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--//faq-->
				<!---->
				<div class="copy">
					<p>
						&copy; 2016 Virtual Desk. All Rights Reserved | Developed by <a
							href="http://fomaxtech.com/" target="_blank">Avohi</a>
					</p>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<!---->
	<!--scrolling js-->
	<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"
		type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>assets/js/scripts.js"
		type="text/javascript" charset="utf-8"></script>
	<!--//scrolling js-->
    <script>
		$('#dob').datepicker({dateFormat: "dd-mm-yy", changeMonth: true,
      changeYear: true});
	</script>
</body>
</html>

