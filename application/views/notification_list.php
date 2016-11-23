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
										  <li role="presentation" class="active"><a href="#" id="home-tab" role="tab">Notification List</a></li>
                                          <!--li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addtenant" role="tab" id="profile-tab">New Tenant</a></li-->
									</ul>
                                   
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         	<h2 class="h2.-bootstrap-heading group-mail">List of Property to Pay Rent yet</h2>
                                            
                                            <div class="row show-grid">
                                                <div class="col-md-1">
                                                    S.No
                                                </div>
                                                <div class="col-md-2">
                                                    Property Type
                                                </div>
                                                <div class="col-md-2">
                                                    Property Name
                                                </div>
                                                <div class="col-md-3">
                                                    Building/Villa/Warehouse No
                                                </div>
                                                <div class="col-md-2">
                                                    Last Paid Date
                                                </div>
                                                <div class="col-md-2">
                                                    Rent Value
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
                                                    <?php echo $val['name'];?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php echo $val['no'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['date'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['rent'];?>
                                                </div>
                                            </div>
                                            <?php $i++; }}else{?>
                                            <div class="row commonsize">
                                            	<div class="col-md-1"></div>
                                                <div class="col-md-10" align="center">-- No Property Found --</div>
                                                <div class="col-md-1"></div>
                                            </div>
                                            <?php }?>
                                            
                                            <h2 class="h2.-bootstrap-heading group-mail">List of Post dated cheque (due in a week)</h2>
                                            <div class="row show-grid">
                                                <div class="col-md-1">
                                                    S.No
                                                </div>
                                                <div class="col-md-4">
                                                    Property Details
                                                </div>
                                                <div class="col-md-2">
                                                    Cheque Date
                                                </div>
                                                <div class="col-md-3">
                                                    Cheque No
                                                </div>
                                                <div class="col-md-2">
                                                    Amount
                                                </div>
                                            </div>
                                            <?php $i =1;
											 if($cheqdata){
											 foreach($cheqdata as $val){?>
                                            <div class="datarow row commonsize">
                                                <div class="col-md-1">
                                                    <?php echo $i;?>
                                                </div>
                                                <div class="col-md-4">
                                                    <?php echo $val['prop_det']; ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['chq_date'];?>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php echo $val['chq_no'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['amt'];?>
                                                </div>
                                            </div>
                                            <?php $i++; }}else{?>
                                            <div class="row commonsize">
                                            	<div class="col-md-1"></div>
                                                <div class="col-md-10" align="center">-- No Posted Cheque Found for upcoming one week--</div>
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

