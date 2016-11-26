<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Role Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<script type="text/javascript">
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
								<div class="bs-example bs-example-tabs" role="tabpanel"
									data-example-id="togglable-tabs">
									 <ul id="myTab" class="nav nav-tabs" role="tablist">
                      					<li role="presentation" class="active"><a href="#" id="home-tab" role="tab" >Employees</a></li>                      					
                    				</ul>
									<!-- <form action="useraccess" method="post" name="profile_main"> -->
									
									<?php echo form_open('useraccess'); ?>
									<?php echo form_hidden('user_id', $user_id); ?>
										<div id="myTabContent" class="tab-content">
											<div role="tabpanel" class="tab-pane fade in active">
                                            <h2 class="h2.-bootstrap-heading group-mail">Edit User Role Management</h2>
                                            <div class="row">
                                                <div class="col-md-2 group-mail">
                                                    <label for="fullname">Full Name:</label>
                                                </div>
                                                <div class="col-md-3 group-mail">
                                                <?php echo ucfirst($first_name)." ".ucfirst($last_name);?>
                                                </div>
                                                <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="dept">Department</label>
                                                </div>
                                                <div class="col-xs-3 group-mail">
                                                <?php echo ucfirst($department_name);?>
                                                </div>
                                                <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="dept">Role</label>
                                                </div>
                                                <div class="col-xs-3 group-mail">
 											
 											<select class="form-control1" id="role" name="role" required>
                                                <option value="">--Select--</option>
                                                <?php
	                                            foreach ($roles_list as $roles):
	                                            if($roles->id == $roles_id){
	                                            	$isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
	                                            } else {
	                                            	$isSelected = ''; // else we remove any tag
	                                            }
												?>
												<option value="<?php echo $roles->id;?>" <?php echo $isSelected ?>><?php echo $roles->name;?></option>
												<?php
	                                			endforeach;
	                            				?>
                                            </select>
                                            
                                            
                                              
                                                </div>
                                                <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-12 group-mail">
                                                    <label for="maint_prop_type">Module/Role</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="staff_role">Staff Management</label>
                                                </div>
                                                <div class="col-xs-6 col-md-3 group-mail">
                                                <select id="staffmgmt" name="staffmgmt" class="form-control1" required>
                                                    <option value="">--Role--</option>
                                                    <option value="128">Read</option>
                                                    <option value="160">Write</option>
                                                    <option value="240">Full</option>
                                                    <option value="0">NA</option>
                                                </select>
                                                 </div>
                                                 <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="fin_role">Finance Management</label>
                                                </div>
                                                <div class="col-xs-6 col-md-3 group-mail">
                                                    <select id="finmgmt" name="finmgmt" class="form-control1" required>
                                                        <option value="">--Role--</option>
                                                        <option value="32768">Read</option>
                                                        <option value="40960">Write</option>
                                                        <option value="61440">Full</option>
                                                        <option value="0">NA</option>
                                                    </select>
                                                 </div>
                                                 <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="prop_role">Property Management</label>
                                                </div>
                                                <div class="col-xs-6 col-md-3 group-mail">
                                                    <select id="propmgmt" name="propmgmt" class="form-control1" required>
                                                        <option value="">--Role--</option>
                                                        <option value="2048">Read</option>
                                                        <option value="2560">Write</option>
                                                        <option value="3840">Full</option>
                                                        <option value="NA">NA</option>
                                                    </select>
                                                 </div>
                                                 <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="user_role">User Management</label>
                                                </div>
                                                <div class="col-xs-6 col-md-3 group-mail">
                                                    <select id="usermgmt" name="usermgmt" class="form-control1" required>
                                                        <option value="">--Role--</option>
                                                        <option value="8">Read</option>
                                                        <option value="10">Write</option>
                                                        <option value="15">Full</option>
                                                        <option value="0">NA</option>
                                                    </select>
                                                 </div>
                                                 <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="maint_role">Maintenance Management</label>
                                                </div>
                                                <div class="col-xs-6 col-md-3 group-mail">
                                                    <select id="mainmgmt" name="mainmgmt" class="form-control1" required>
                                                        <option value="">--Role--</option>
                                                        <option value="524288">Read</option>
                                                        <option value="655360">Write</option>
                                                        <option value="983040">Full</option>
                                                        <option value="0">NA</option>
                                                    </select>
                                                 </div>
                                                 <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="rept_role">Report Management</label>
                                                </div>
                                                <div class="col-xs-6 col-md-3 group-mail">
                                                    <select id="reportmgmt" name="reportmgmt" class="form-control1" required>
                                                        <option value="">--Role--</option>
                                                        <option value="8388608">Read</option>
                                                        <option value="10485760">Write</option>
                                                        <option value="15728640">Full</option>
                                                        <option value="NA">NA</option>
                                                    </select>
                                                 </div>
                                                 <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            
											
											<!-- footer-->
												<div class="panel-footer">
													<div class="row">
														<div class="col-sm-8 col-sm-offset-2">
															<input type="submit" value="Save"/>
															<input type="reset" value="Reset"/>
															<!-- <button class="btn-primary btn">Save</button> -->
															<!-- <button class="btn-inverse btn" type="reset">Reset</button> -->
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
</body>
</html>

