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
                                <label>Report Type: Maintenance Report</label>
                            </div>
                            <div class="col-md-4">
                            	<label>Ticket Status: <?php echo $search_fv["ticket_status"];?></label>
                            </div>
                            <div class="col-md-4">
                            	<label>From : <?php echo $search_fv["ticket_open_date"];?> &nbsp; To : <?php echo $search_fv["ticket_open_date_to"];?></label><br/>
                                <label>Assigned to User : <?php echo $search_fv["by_user_id"];?></label>
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
                            <div class="col-md-2">
                                Ticket No<br/>
                                &nbsp;
                            </div>
                            <div class="col-md-3">
                                Summary<br/>
                                &nbsp; 
                            </div>
                            <div class="col-md-1">
                                Priority<br/>
                                &nbsp;
                            </div>
                            <div class="col-md-2">
                                Building-Villa/Flat/Warehouse
                            </div>
                            <div class="col-md-2">
                                Creation Date<br/>
                                &nbsp;
                            </div>
                            <div class="col-md-2">
                                Assigned to<br/>
                                &nbsp;
                            </div>
                        </div>
                        <?php $i =1;
                             foreach($sendData as $val){?>
                        <div class="datarow row commonsize">
                            <div class="col-md-2">
                                <?php echo $val["id"]; ?>
                            </div>
                            <div class="col-md-3">
                                <?php echo $val["summary"]; ?>
                            </div>
                            <div class="col-md-1">
                                <?php echo $val["priority"]; ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo $val["unit"]; ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo $val["date"]; ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo $val["assigned_to"]; ?>
                            </div>
                        </div>
                        <?php $i++; }}else{?>
                        <div class="row commonsize">
                            <div class="col-md-1"></div>
                            <div class="col-md-10" align="center">-- No Ticket Found --</div>
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