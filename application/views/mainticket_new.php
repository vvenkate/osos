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
	$.ajax({url: "getlbpriortype", success: function(result){
           var arrBuilders = jQuery.parseJSON(result);
		   $('#maint_prior').empty();
		   $.each(arrBuilders, function (index1, value1) {
				$('#maint_prior').append($('<option/>', { 
					value: value1.key,
					text :  value1.val
				}));
			}); 
        }});
		
	$.ajax({url: "getmuser", success: function(result){
           var arrBuilders = jQuery.parseJSON(result);
		   $('#maint_assigned').empty();
		   $.each(arrBuilders, function (index1, value1) {
				$('#maint_assigned').append($('<option/>', { 
					value: value1.key,
					text :  value1.val
				}));
			}); 
        }});
		
	
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
										<li role="presentation"><a href="<?php echo base_url(); ?>index.php/ticket" id="home-tab" aria-controls="home" aria-expanded="true">Home</a></li>
                                      	<li role="presentation" class="active"><a href="#" role="tab" id="profile-tab">New Maintenance Ticket</a></li>
									</ul>
                                    <?php echo form_open('ticket/addticket'); ?>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         <h2 class="h2.-bootstrap-heading group-mail">New Ticket</h2>
                                        <!-- Maintenance Ticket -->
                                        
                                        <div class="row">
                                            <div class="col-md-12 group-mail">
                                            <label for="ticket_sum">Ticket Summary</label>
                                            <input id="ticket_sum" name="ticket_sum" class="form-control" required type="text" placeholder="Ticket Summary">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 group-mail">
                                            <label for="contact_no">Ticket Description</label>
                                            <textarea id="ticket_desc" name="ticket_desc" class="form-control" required placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="maint_prop_type">Property Type</label>
                                                <div class="radio block"><input id="maint_prop_type" name="maint_prop_type" type="radio" value="1"  /><label>Building/FLAT</label></div>
                                                <div class="radio block"><input id="maint_prop_type" name="maint_prop_type" type="radio" value="2" checked/><label>Villa</label></div>
                                                <div class="radio block"><input id="maint_prop_type" name="maint_prop_type" type="radio" value="3" /><label> Warehouse</label></div>
                                                <!--div class="radio block"><input id="maint_prop_type" name="maint_prop_type" type="radio" value="4" /><label> Shops</label></div-->
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="maint_prop_unit_no">Unit Number</label>
                                                <select class="form-control1" id="maint_prop_unit_no" name="maint_prop_unit_no" required>
                                                      <option value="">-- select one --</option>
                                                      <option value="villa1">Villa 1-02</option>
                                                      <option value="villa2">Villa 2-12</option>
                                                      <option value="villa2">Villa 4-11</option>
                                                      <option value="villa2">Villa 5-12</option>
                                                </select>
                                                <label for="maint_prop_flat" id="label_flat" style="margin-top:15px;" class="div_disable">FlatNumber</label>
                                                <select class="form-control1 div_disable" id="maint_prop_flat_no" name="maint_prop_flat_no">
                                                      <option value="">-- select one --</option>
                                                      <option value="villa1">Villa 1-02</option>
                                                      <option value="villa2">Villa 2-12</option>
                                                      <option value="villa2">Villa 4-11</option>
                                                      <option value="villa2">Villa 5-12</option>
                                                </select>
                                            </div>                        
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="maint_prop_tenant_name">Tenant Name</label>
                                            <input type="text" name="maint_prop_tenant_name" value="" required readonly class="form-control1">
                                            <!--select class="form-control1" id="maint_prop_tenant_name" name="maint_prop_tenant_name">
                                                      <option value="">select one</option>
                                                      <option value="tenant1">Tenant 1</option>
                                                      <option value="tenant2">Tenant 2</option>
                                                      <option value="tenant3">Tenant 3</option>
                                                      <option value="tenant4">Tenant 4</option>
                                                </select -->
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="issue_type">Issue Type</label>
                                                <select class="form-control1" id="issue_type" name="issue_type" required>
                                                      <option value="">-- select one --</option>
                                                      <option value="plumbing">Plumbing</option>
                                                      <option value="electrical">Electrical</option>
                                                      <option value="commonarea">Common Area Issue</option>
                                                      <option value="construction">Construction</option>
                                                      <option value="furniture">Furniture</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="maint_prior">Priority</label>
                                                <select class="form-control1" id="maint_prior" name="maint_prior">
                                                      <option value="Critical">Critical</option>
                                                      <option value="High">High</option>
                                                      <option value="Normal" selected>Normal</option>
                                                      <option value="Medium">Medium</option>
                                                      <option value="Low">Low</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="maint_assigned">Assigned To</label>
                                                <select class="form-control1" id="maint_assigned" name="maint_assigned">
                                                     <option value="">-- select one --</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                             <label for="maint_image">Upload Image</label>
                                             <input type="file" id="maint_image">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                           
                                            </div>
                                        </div>
                                        
                                        <!-- footer-->
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button name="main_ticket_btn" id="main_ticket_btn" class="btn-primary btn">Save</button>
                                                    <button class="btn-inverse btn" type="reset">Reset</button>
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

