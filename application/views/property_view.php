<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Property Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/unit_mgmt.js"></script>
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
		<?php $this->load->view('common/header_menu');?>
		
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="content-main">

				<!--banner-->
				<div class="banner">
					<h2>
						<a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <span>Property
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
										<li role="presentation"><a href="property_home" id="home-tab" role="tab">Home</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/addproperty" role="tab" id="profile-tab">New Building/Villa/Warehouse</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/addflat" role="tab" id="profile-tab">New Flat/Shop</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/propertylist" role="tab" id="profile-tab">Properties List</a></li>
									</ul>
                                   
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         	<h2 class="h2.-bootstrap-heading group-mail">Property Details</h2>
                                            <div class="row">
                                                <div class="col-md-11">
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="<?php echo base_url(); ?>index.php/edit_property?id=<?php echo $id;?>"><i class="fa fa-pencil"></i></a>
                                                </div>
                                            </div>
                                            <div class="row commonsize group-mail">
                                                <div class="col-md-3">
                                                    Property Type
                                                </div>
                                                <div class="col-md-9">
                                                    <?php echo $val['type']; ?>
                                                </div>
                                            </div>
                                            <div class="row commonsize group-mail">
                                                <div class="col-md-3">
                                                    Villa Name
                                                </div>
                                                <div class="col-md-9">
                                                   <?php echo $val['name']; ?>
                                                </div>
                                            </div>
                                            <div class="row commonsize group-mail">
                                                <div class="col-md-3">
                                                    No. of Rooms
                                                </div>
                                                <div class="col-md-9">
                                                   <?php echo $val['rooms']; ?>
                                                </div>
                                            </div>
                                            <div class="row commonsize group-mail">
                                                <div class="col-md-3">
                                                    Address
                                                </div>
                                                <div class="col-md-9">
                                                    <?php echo $val['address'],"<br>",$val['city']; ?>
                                                </div>
                                            </div>
                                            <div class="row commonsize group-mail">
                                                <div class="col-md-3">
                                                    Amenities
                                                </div>
                                                <div class="col-md-9">
                                                    <?php echo $val['amenities']; ?>
                                                </div>
                                            </div>
                                            <div class="row commonsize group-mail">
                                                <div class="col-md-3">
                                                    Rent Value (AED)
                                                </div>
                                                <div class="col-md-9">
                                                    <?php echo $val['amt']; ?>
                                                </div>
                                            </div>
                                            <div class="row commonsize group-mail">
                                                <div class="col-md-3">
                                                    Occupancy Status
                                                </div>
                                                <div class="col-md-9">
                                                    <?php echo $val['occ_status']; ?>
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

