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
<script language="javascript" type="text/javascript">
$(function () {
	$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

	if (!screenfull.enabled) {
		return false;
	}
	
	$('#toggle').click(function () {
		screenfull.toggle($('#container')[0]);
	});
});
$(document).ready( function() {
	$.ajax({url: "ticket/getmuser", success: function(result){
           var arrBuilders = jQuery.parseJSON(result);
		  // $('#by_user_id').empty();
		   $.each(arrBuilders, function (index1, value1) {
				$('#by_user_id').append($('<option/>', { 
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
                   <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/finance" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Report</a></li>
                     
                    </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  	<h3 class="h3.-bootstrap-heading">Report</h3>
                   	<?php $attributes = array('id' => 'genfrmreport','name' =>'genfrmreport'); echo form_open('#',$attributes); ?>
					<div class="row">
                    	<div class="col-xs-6 col-md-4 group-mail">
                        	<label for="report_type">Report Type</label>
                            <select class="form-control1" id="report_type" name="report_type">
                              <option value="">-- select one --</option>
                              <option value="Property">Property</option>
                              <option value="Finance">Finance</option>
                              <option value="Ticket">Maintenance Ticket</option>
                              <option value="Contract">Tenant Contract</option>
                             </select>
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        </div>
                        <div class="col-xs-6 col-md-4 group-mail">
                        </div>
                    </div>
                    
                    <div id="staff" class="div_disable">
                        <div class="row">
                            <div class="col-xs-6 col-md-4 group-mail">
                                <label for="streport_type">Staff Report</label>
                                <select class="form-control1" id="streport_type" name="streport_type">
                                  <option value="employeelist">Employee Joined</option>
                                  <option value="Finance">Leave</option>
                                 </select>
                            </div>
                            <div class="col-xs-6 col-md-4 group-mail">
                            </div>
                            <div class="col-xs-6 col-md-4 group-mail">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Start of Finance -->
                    <div id="finance" class="div_disable">
                        <div class="row">
                            <div class="col-xs-4 col-md-4 group-mail">
                                <label for="finreport_type">Finance Report</label>
                                <select class="form-control1" id="finreport_type" name="finreport_type">
                                  <option value="income">Income</option>
                                  <option value="expense">Expense</option>
                                 </select>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	<label for="fin_data_from">From Date</label>
                                <div class="input-group">
                                    <input id="fin_data_from" name="fin_data_from" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#fin_data_from').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>
                            	</div>
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	<label for="fin_data_to">To Date</label>
                                <div class="input-group">
                                    <input id="fin_data_to" name="fin_data_to" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#fin_data_to').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span></div>
                            </div>
                    	</div>
                        <div id="incomefin" class="row div_enable">
                        	<div class="col-xs-4 col-md-4 group-mail">
                                <label for="income_pm">Payment Mode</label>
                                <select class="form-control1" id="income_pm" name="income_pm">
                               	  <option value="All">All</option>
                                  <option value="Cash">Cash</option>
                                  <option value="Cheque">Cheque</option>
                                  <option value="Online Transfer">Bank Transfer</option>
                                 </select>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                            </div>
                        </div>
                        <div id="expensefin" class="row div_disable">
                        	<div class="col-xs-4 col-md-4 group-mail">
                                <label for="expense_type">Expense Type</label>
                                <select class="form-control1" id="expense_type" name="expense_type">
                               	  <option value="All">All</option>
                                  <option value="office">Office</option>
                                  <option value="property">Property</option>
                                 </select>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-md-4 group-mail">
                                <button id="genreport" name="genreport" class="btn-primary btn">Generate Report</button>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                            </div>
                    	</div>
                  	</div>
                    <!-- End of Finance-->
                    
                    <!-- Start of Ticket -->
                    <div id="ticket" class="div_disable">
                        <div class="row">
                            <div class="col-xs-4 col-md-4 group-mail">
                                <label for="ticket_status">Ticket Reports</label>
                                <select class="form-control1" id="ticket_status" name="ticket_status">
                                  <option value="all">All</option>
                                  <option value="New">New</option>
                                  <option value="Inprogress">In Progress</option>
                                  <option value="Done">Fixed</option>
                                  <option value="Review">Review</option>
                                  <option value="Closed">Closed</option>
                                 </select>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	<label for="ticket_open_date">From Date</label>
                                <div class="input-group">
                                    <input id="ticket_open_date" name="ticket_open_date" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#ticket_open_date').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>
                            	</div>
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	<label for="ticket_open_date_to">To Date</label>
                                <div class="input-group">
                                    <input id="ticket_open_date_to" name="ticket_open_date_to" class="form-control" type="text" placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#ticket_open_date_to').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span></div>
                            </div>
                    	</div>
                        
                        <div class="row">
                            <div class="col-xs-4 col-md-4 group-mail">
                                <label for="by_user_id">Maintenance User</label>
                                <select class="form-control1" id="by_user_id" name="by_user_id">
                                  <option value="all">All</option>
                                 </select>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                            </div>
                    	</div>

                        
                        <div class="row">
                            <div class="col-xs-4 col-md-4 group-mail">
                                <button id="ticketgenreport" name="ticketgenreport" class="btn-primary btn">Generate Report</button>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                            </div>
                    	</div>
                  	</div>
                    <!-- End of Ticket-->
                    
                    
                     <!-- Start of Property -->
                    <div id="property" class="div_disable">
                        <div class="row">
                            <div class="col-xs-4 col-md-4 group-mail">
                                <label for="propreport_type">Property Type</label>
                                <select class="form-control1" id="propreport_type" name="propreport_type">
                                  <option value="Building">Building</option>
                                  <option value="Villa">Villa</option>
                                  <option value="Warehouse">Warehouse</option>
                                  <option value="flat">Flat</option>
                                 </select>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                                <label for="prop_country">Country</label>
                                <select name="prop_country" id="prop_country" class="form-control">
                                    <option value="">--None--</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="Yemen">Yemen</option>
                                </select>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                                <label for="prop_occupied">Occupied Status</label>
                                <select name="prop_occupied" id="prop_occupied" class="form-control">
                                    <option value="">--None--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                    	</div>
                        <div class="row">
                            <div class="col-xs-4 col-md-4 group-mail">
                                <button id="propgenreport" name="propgenreport" class="btn-primary btn">Generate Report</button>
                            </div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                        	</div>
                            <div class="col-xs-4 col-md-4 group-mail">
                            	
                            </div>
                    	</div>
                  	</div>
                    <!-- End of Property-->        
                  
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