<!DOCTYPE HTML>
<html>
<head>
<title>OSOS - Reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/report.js"></script>
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
                      <li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/finance" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Report</a></li>
                     
                    </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  	<h3 class="h3.-bootstrap-heading">Custom Property Report</h3>
                    	<!-- Property search value-->
						<?php if($search_fv) {?>
                        <div class="datarow row commonsize">
                        	<div class="col-md-4">
                                <label>Report Type: Property Report></label>
                            </div>
                            <div class="col-md-4">
                            	<label>Property Type</label>
                            </div>
                            <div class="col-md-4">
                            	<label>Country : <?php echo $search_fv["fin_data_from"];?></label>
                                <label>Occupied Status : <?php echo $search_fv["fin_data_to"];?></label>
                            </div>
                        </div>
                        <?php }?>
                        <!-- Property search value End value-->
                        <!--Property Data start-->
                        <?php if($sendData){ ?>
                        <div class="datarow row commonsize">
                        	<div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4">
                            	
                            </div>
                            <div class="col-md-4">
                                <a href="<?php echo base_url(); ?>index.php/report/downfin<?php echo $exp_url;?>">Download in Excel</a>
                            </div>
                        </div>
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
                                Country
                            </div>
                            <div class="col-md-2">
                                Occupied Status
                            </div>
                        </div>
                        <?php $i =1;
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
                                <?php echo $val['country'];?>
                            </div>
                            <div class="col-md-2">
                               <?php echo $val['os']; ?>
                            </div>
                        </div>
                        <?php $i++; }}else{?>
                        <div class="row commonsize">
                            <div class="col-md-1"></div>
                            <div class="col-md-10" align="center">-- No Property Found --</div>
                            <div class="col-md-1"></div>
                        </div>
                        <?php }?>
                        <!--Property Data End -->  
                                      
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <p></p>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profiles" aria-labelledby="profile-tab">
                    <p></p>
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
		$('#fin_data_from').datepicker({dateFormat: "dd-mm-yy", changeMonth: true,
      changeYear: true});
	  $('#fin_data_to').datepicker({dateFormat: "dd-mm-yy", changeMonth: true,
      changeYear: true});
	</script>
</body>
</html>