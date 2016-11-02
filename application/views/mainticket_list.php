<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Maintenance Ticket Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/main_mgmt.js"></script>
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
<script language="javascript" type="text/javascript">
$(document).ready( function() {
	/*$.ajax({url: "ticket/getlbpriortype", success: function(result){
           var arrBuilders = jQuery.parseJSON(result);
		   $('#maint_prior').empty();
		   $.each(arrBuilders, function (index1, value1) {
				$('#maint_prior').append($('<option/>', { 
					value: value1.key,
					text :  value1.val
				}));
			}); 
        }});*/
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
										<li role="presentation" class="active"><a href="#" id="home-tab" aria-controls="home" aria-expanded="true">Home</a></li>
                                      	<li role="presentation"><a href="<?php echo base_url(); ?>index.php/ticket/addticket" role="tab" id="profile-tab">New Maintenance Ticket</a></li>
									</ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                        <h2 class="h2.-bootstrap-heading group-mail">Maintenance Ticket List</h2>
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
                                            <div class="col-md-1">
                                                Creation Date
                                            </div>
                                            <div class="col-md-2">
                                                Assigned to<br/>
                                                &nbsp;
                                            </div>
                                            <div class="col-md-1">
                                                Action<br/>
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
                                            <div class="col-md-1">
                                                <?php echo $val["date"]; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $val["assigned_to"]; ?>
                                            </div>
                                            <div class="col-md-1">
                                                <a href="<?php echo base_url(); ?>index.php/ticket/ticketupdate?id=<?php echo $val["id"]; ?>">View</a>
                                            </div>
                                        </div>
                                        <?php $i++; }?>
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

