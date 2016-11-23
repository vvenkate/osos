<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Maintenance Ticket Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>
<!--script src="<?php echo base_url(); ?>assets/js/main_mgmt.js"></script-->
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
//funciton to display the hiddent div or element
var hostname = "localhost";

function divDisplay(elementid){
	$(elementid).removeClass("div_disable");
	$(elementid).addClass("div_enable");
}
//GEneric ajax call update.
	//url value should be get after "index.php/"
	//listboxid - should be id of the select/listbox
	function getListBoxUpdate(listboxid,parturl){
		$(listboxid+' option').remove();
		$(listboxid).append($('<option/>',{value:"",text:"---None---"}));

		$.ajax({url: "http://"+hostname+"/OSOSFinal/index.php/"+parturl, success: function(result){
		var arrBuilder = jQuery.parseJSON(result);
		 $(listboxid).empty();
		$.each(arrBuilder, function (index, value) {
				$(listboxid).append($('<option/>', { 
					value: value.key,
					text :  value.val
				}));
			}); 
		}});
	}
	
$(document).ready( function() {
		
	getListBoxUpdate('#issue_type',"ticket/getlbissuetype");
	getListBoxUpdate('#maint_assigned',"ticket/getmuser");
	getListBoxUpdate('#maint_prior',"ticket/getlbpriortype");
		
	var jsondata = '<?php echo $json; ?>';
	if(jsondata){
		var upprop = jQuery.parseJSON(jsondata);
		$("#ticket_sum").val(upprop.ticket_summary);
		$("#ticket_desc").val(upprop.ticket_desc);
		$("#ticket_id").val(upprop.id);
		$("#maint_prop_type").val(upprop.unit_type);
		
		//adding Building details
		if(upprop.unit_type == 1){
			divDisplay("#maint_prop_flat_no");
			divDisplay("#label_flat");			
			getListBoxUpdate('#maint_prop_unit_no',"property/getlbbuilder");
			getListBoxUpdate('#maint_prop_flat_no',"ticket/getlbflat?id="+upprop.unit_number);
			$("#maint_prop_flat_no").val(upprop.flat_no);
		}
		
		//adding Villa details
		if(upprop.unit_type == 2){
			getListBoxUpdate('#maint_prop_unit_no',"property/getlbvilla");
		}
		
		//adding Warehouse details
		if(upprop.unit_type == 3){
			getListBoxUpdate('#maint_prop_unit_no',"property/getlbwarehouse");
		}
		
		//$("input:radio[name=maint_prop_type1][val="+upprop.unit_type+"]").attr('checked', true);
		$("input:radio[name=maint_prop_type1][value="+upprop.unit_type+"]").attr("checked",true);
		$("#ticket_id").val(upprop.id);
		
		console.log(upprop.issue_type);
		setTimeout(function(){
			$("#maint_prop_unit_no").val(upprop.unit_number);
			$("#issue_type").val(upprop.issue_type);
			$("#maint_prior").val(upprop.priority_type);
			$("#maint_assigned").val(upprop.assigned_user_id);
			$("#ticket_status").val(upprop.ticket_status);
		},2000);
	}
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
                                      	<li role="presentation" class="active"><a href="#" role="tab" id="profile-tab">Edit Maintenance Ticket</a></li>
									</ul>
                                    <?php echo form_open('ticket/ticketupdate'); ?>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         <h2 class="h2.-bootstrap-heading group-mail">Update Ticket</h2>
                                        <!-- Maintenance Ticket -->
                                        <input type="hidden" name="ticket_id" id="ticket_id" value="" />
                                        <input type="hidden" name="maint_prop_type" id="maint_prop_type" value="" />
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
                                                <div class="radio block"><input id="maint_prop_type1" name="maint_prop_type1" type="radio" value="1"  disabled/><label>Building/FLAT</label></div>
                                                <div class="radio block"><input id="maint_prop_type1" name="maint_prop_type1" type="radio" value="2"  disabled checked/><label>Villa</label></div>
                                                <div class="radio block"><input id="maint_prop_type1" name="maint_prop_type1" type="radio" value="3" disabled /><label> Warehouse</label></div>
                                                <!--div class="radio block"><input id="maint_prop_type" name="maint_prop_type" type="radio" value="4" /><label> Shops</label></div-->
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="maint_prop_unit_no">Unit Number</label>
                                                <select class="form-control1" id="maint_prop_unit_no" name="maint_prop_unit_no" disabled required>
                                                      <option value="">-- select one --</option>
                                                      <option value="villa1">Villa 1-02</option>
                                                      <option value="villa2">Villa 2-12</option>
                                                      <option value="villa2">Villa 4-11</option>
                                                      <option value="villa2">Villa 5-12</option>
                                                </select>
                                                <label for="maint_prop_flat" id="label_flat" style="margin-top:15px;" class="div_disable">FlatNumber</label>
                                                <select class="form-control1 div_disable" id="maint_prop_flat_no" name="maint_prop_flat_no" disabled>
                                                      <option value="">-- select one --</option>
                                                      
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
                                                      <!--option value="">-- select one --</option>
                                                      <option value="plumbing">Plumbing</option>
                                                      <option value="electrical">Electrical</option>
                                                      <option value="commonarea">Common Area Issue</option>
                                                      <option value="construction">Construction</option>
                                                      <option value="furniture">Furniture</option-->
                                                </select>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="maint_prior">Priority</label>
                                                <select class="form-control1" id="maint_prior" name="maint_prior">
                                                      <!--option value="Critical">Critical</option>
                                                      <option value="High">High</option>
                                                      <option value="Normal" selected>Normal</option>
                                                      <option value="Medium">Medium</option>
                                                      <option value="Low">Low</option-->
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
                                            <label for="ticket_status">Status</label>
                                                <select class="form-control1" id="ticket_status" name="ticket_status" required>
                                                      <option value="Open">Open</option>
                                                      <option value="Inprogress">In Progress</option>
                                                      <option value="Done">Fixed</option>
                                                      <option value="Review">Review</option>
                                                      <option value="Closed">Closed</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-8 group-mail">
                                            <label for="issue_type">Ticket Comments</label>
                                            <textarea class="form-control1" id="ticket_comment" name="ticket_comment">
                                            
                                            </textarea>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
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
</body>
</html>

