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
										  <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property" id="home-tab" role="tab">Home</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addproperty" role="tab" id="profile-tab">New Building/Villa/Warehouse</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addflat" role="tab" id="profile-tab">New Flat/6 Room House</a></li>
                                           <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addtenant" role="tab" id="profile-tab">New Tenant</a></li>
									</ul>
                                   
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         	<h2 class="h2.-bootstrap-heading group-mail">Studio/6 Room House - Flat List</h2>
                                            <div class="row show-grid">
                                                <div class="col-md-1">
                                                    S.No
                                                </div>
                                                <div class="col-md-2">
                                                    Property Type
                                                </div>
                                                <div class="col-md-2">
                                                    Floor No
                                                </div>
                                                <div class="col-md-2">
                                                    Flat No
                                                </div>
                                                <div class="col-md-3">
                                                    Occupied Status
                                                </div>
                                                <div class="col-md-2">
                                                    Action
                                                </div>
                                            </div>
                                            <?php $i =1;
											 if($sendData){
											 foreach($sendData as $val){?>
                                            <div class="datarow row commonsize">
                                                <div class="col-md-1">
                                                    <?php echo $i;?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['type']; ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['floorno'];?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php echo $val['flatno'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['occupied'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <!--a href="<?php echo base_url(); ?>index.php/property/update_sub_property?id=<?php echo $val['id'];?>&type=<?php echo $val['type'];?>">View</a-->
                                                </div>
                                            </div>
                                            <?php $i++; }}else{?>
                                            <div class="row commonsize">
                                            	<div class="col-md-1"></div>
                                                <div class="col-md-10" align="center">-- No Property Found --</div>
                                                <div class="col-md-1"></div>
                                            </div>
                                            <?php }?>
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

