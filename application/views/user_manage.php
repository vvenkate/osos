<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Role Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
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
		<!----->
		<nav class="navbar-default navbar-static-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<h1>
					<a class="navbar-brand" href="index.html">Virtual Desk</a>
				</h1>
			</div>
			<div class=" border-bottom">
				<div class="full-left">
					<section class="full-top">
						<button id="toggle">
							<i class="fa fa-arrows-alt"></i>
						</button>
					</section>
					<form class=" navbar-left-right">
						<input type="text" value="Search..." onfocus="this.value = '';"
							onblur="if (this.value == '') {this.value = 'Search...';}"> <input
							type="submit" value="" class="fa fa-search">
					</form>
					<div class="clearfix"></div>
				</div>


				<!-- Brand and toggle get grouped for better mobile display -->

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="drop-men">
					<ul class=" nav_1">
						<li class="dropdown"><a href="#"
							class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span
								class=" name-caret">Admin<i class="caret"></i></span><img
								src="<?php echo base_url(); ?>assets/images/link.png"></a>
							<ul class="dropdown-menu " role="menu">
								<li><a href="profile.html"><i class="fa fa-user"></i>Edit
										Profile</a></li>
							</ul></li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
				<div class="clearfix"></div>
				<?php $this->load->view('common/side_menu');?>
		
		
		</nav>
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="content-main">

				<!--banner-->
				<div class="banner">
					<h2>
						<a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <span>User
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
										<li role="presentation"><a href="staff_mgmt_index.html"
											id="home-tab" role="tab">Home</a></li>
										<li role="presentation" class="active"><a href="#profile"
											role="tab" id="profile-tab" aria-expanded="true">New Employee</a></li>
										<li role="presentation"><a href="#profiles" role="tab"
											id="profile-tab">Employees</a></li>
									</ul>
									<!-- <form action="useraccess" method="post" name="profile_main"> -->
									
									<?php echo form_open('useraccess'); ?>
										<div id="myTabContent" class="tab-content">
											<div role="tabpanel" class="tab-pane fade in active">
                                            <h2 class="h2.-bootstrap-heading group-mail">Edit User Role Management</h2>
                                            <div class="row">
                                                <div class="col-md-2 group-mail">
                                                    <label for="fullname">Full Name:</label>
                                                </div>
                                                <div class="col-md-3 group-mail">
                                                USER 1
                                                </div>
                                                <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="dept">Department</label>
                                                </div>
                                                <div class="col-xs-3 group-mail">
                                                Maintenance
                                                </div>
                                                <div class="col-md-7">&nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-2 group-mail">
                                                    <label for="dept">Role</label>
                                                </div>
                                                <div class="col-xs-3 group-mail">
                                                <select id="role" name="role" class="form-control1" required>
                                                    <option value="">--Role--</option>
                                                    <option value="Super Admin">Super Admin</option>
                                                    <option value="Staff Admin">Staff Admin</option>
                                                    <option value="Finanace Admin">Finance Admin</option>
                                                    <option value="User Admin">User Admin</option>
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
															<button class="btn-primary btn">Save</button>
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

