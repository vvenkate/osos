<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Property Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>

</head>
<body style="background-image: url(<?php echo base_url(); ?>assets/images/3-bedroom.jpg); background-repeat:no-repeat;">
   
   <?php echo form_open('verifylogin/login'); ?>
   <?php echo form_hidden('format','html'); ?>
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
				<a href="<?php echo base_url(); ?>index.php"><img src="<?php echo base_url(); ?>assets/images/OSOS-WEB-LOGO.png" alt="OSOS LOGO" width="250" height="70"/> </a>
			</div>
			<div class=" border-bottom">
				<div class="clearfix"></div>

				<div class="navbar-default sidebar" role="navigation">
				</div>
		
		</nav>
		
		<div id="page-wrapper" class="gray-bg dashbard-1" >
			<div class="content-main">

				<!--//banner-->
				<!--faq-->
				<div class="blank">
					<div class="blank-page">
						<div class="grid_3 grid_5" style="background-image: url(<?php echo base_url(); ?>assets/images/3-bedroom.jpg); background-repeat:no-repeat;">
							<!--h3 class="head-top">Tabs</h3-->
							<div class="but_list">
								<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
 										<div id="myTabContent" class="tab-content">
											<div role="tabpanel" class="tab-pane fade in active"
												id="home" aria-labelledby="home-tab">
												<h2 class="h2.-bootstrap-heading group-mail">Login</h2>
												<!-- Personal Details -->
												<div class="row">
													<div class="col-xs-6 col-md-4 group-mail">
														&nbsp;<?php echo validation_errors(); ?>
													</div>
													<div class="col-xs-6 col-md-4 group-mail">
														<label for="dob">Email</label>
														<div class="input-group">
															<input type="text" size="20" id="username" name="username"/>
														</div>
													</div>
													<div class="col-xs-6 col-md-4 group-mail">
														&nbsp;
													</div>
												</div>
												<div class="row">
													<div class="col-xs-6 col-md-4 group-mail">
													&nbsp;
													</div>
													<div class="col-xs-6 col-md-4 group-mail">
														<label for="dob">Password</label>
														<div class="input-group">
															<input type="password" size="20" id="passowrd" name="password"/>
														</div>
													</div>
													<div class="col-xs-6 col-md-4 group-mail">
														&nbsp;
													</div>
												</div>

												<!-- footer-->
												<div class="panel-footer">
													<div class="row">
														<div class="col-sm-8 col-sm-offset-2">
															<!-- <button class="btn-primary btn">Login</button> -->
															<input type="submit" value="Login"/>
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
				<div class="copy" >
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