<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Property Management</title>
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
									<!--ul id="myTab" class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/staff">Dashboard</a></li>
									</ul-->
									<h2 class="h2.-bootstrap-heading group-mail">Dashboard</h2>
                                    <div class="row show-grid">
                                        <div class="col-md-3">
                                            <br/>
                                        </div>
                                        <div class="col-md-3">
                                            No of Units<br/>
                                        </div>
                                        <div class="col-md-2">
                                            No of Units Occupied<br/>
                                        </div>
                                        <div class="col-md-4">
                                            <br/>
                                        </div>
                                    </div>
                                     <div class="datarow row commonsize">
                                         	<div class="col-md-3">
                                               Building - Studio/6 Bed Room House
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $sendData["building_flat_cnt"]; ?>
                                            </div>
                                            <div class="col-md-2">
                                               <?php echo $sendData["building_flat_occ_cnt"]; ?>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                     </div>
                                     <div class="datarow row commonsize">
                                         	<div class="col-md-3">
                                               Villa 
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $sendData["villa_cnt"]; ?>
                                            </div>
                                            <div class="col-md-2">
                                               <?php echo $sendData["villa_occ_cnt"]; ?>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                     </div>
                                     <div class="datarow row commonsize">
                                         	<div class="col-md-3">
                                               Warehouse
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $sendData["warehouse_cnt"]; ?>
                                            </div>
                                            <div class="col-md-2">
                                               <?php echo $sendData["warehouse_occ_cnt"]; ?>
                                            </div>
                                            <div class="col-md-4">
                                                
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
</body>
</html>

