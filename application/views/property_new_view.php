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
										  <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property" role="tab" id="profile-tab">Home</a></li>
                                          <li role="presentation" class="active"><a href="#" role="tab" id="profile-tab">New Building/Villa/Warehouse</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addflat" role="tab" id="profile-tab">New Flat/6 Room House</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addtenant" role="tab" id="profile-tab">New Tenant</a></li>
									</ul>
                                    <?php echo form_open('property/addproperty'); ?>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         <h2 class="h2.-bootstrap-heading group-mail">New Property</h2>
                    				<div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="prop_country">Country</label>
                                            <select name="prop_country" id="prop_country" class="form-control" required>
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
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="prop_city">City</label>
                                            <input id="prop_city" name="prop_city" class="form-control" required type="text" placeholder="City" />
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-4 group-mail">
                                        <label for="prop_type">Property Type</label>
                                        <div class="radio block"><input id="prop_type" name="prop_type" type="radio" value="Building"  /><label>Building</label></div>
                                        <div class="radio block"><input id="prop_type" name="prop_type" type="radio" value="Villa" checked="true"/><label>Villa</label></div>
                                        <div class="radio block"><input id="prop_type" name="prop_type" type="radio" value="Warehouse" /><label> Warehouse</label></div>
                                        <!--div class="radio block"><input id="prop_type" name="prop_type" type="radio" value="Shop" /><label> Shops</label></div-->
                                        </div>
                                        <div class="col-xs-6 col-md-4 group-mail">
                                        </div>
                                        <div class="col-xs-6 col-md-4 group-mail">
                                        </div>
                                    </div>
                                    
                                    <!-- villa details -->
                                    <div id="villa" class="div_enable">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_name">Villa Name</label>
                                            <input id="villa_name" name="villa_name" class="form-control" type="text" placeholder="Villa name">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_no">Villa No</label>
                                            <input id="villa_no" name="villa_no" class="form-control" type="text" placeholder="No XXXX">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="no_rooms">No of Rooms</label>
                                            <input id="no_rooms" name="no_rooms" class="form-control" type="text" placeholder="Rooms">
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_addr_line1">Address Line 1</label>
                                            <input id="villa_addr_line1" name="villa_addr_line1" class="form-control" type="text" placeholder="Address 1">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_addr_line2">Address Line 2</label>
                                            <input id="villa_addr_line2" name="villa_addr_line2" class="form-control" type="text" placeholder="AXXX"/>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_yard">Yard</label>
                                            <div class="radio block"><label><input type="radio" name="villa_yard" id="villa_yard" value="yes" checked> Yes</label></div>
                                            <div class="radio block"><label><input type="radio" name="villa_yard" id="villa_yard" value="no"> No</label></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_swim">Swimming Pool</label>
                                            <div class="radio block"><label><input type="radio" name="villa_swim" id="villa_swim" value="yes" checked> Yes</label></div>
                                            <div class="radio block"><label><input type="radio" name="villa_swim" id="villa_swim" value="no"> No</label></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_parking">Parking</label>
                                            <div class="radio block"><label><input type="radio" name="villa_parking" id="villa_parking" value="yes" checked> Yes</label></div>
                                            <div class="radio block"><label><input type="radio" name="villa_parking" id="villa_parking" value="no"> No</label></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="villa_rent_amt">Rental Value &nbsp;(AED)</label>
                                            <input id="villa_rent_amt" name="villa_rent_amt" class="form-control" type="text" placeholder="XXX" />
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <!--label for="villa_swim">Occupied</label>
                                            <div class="radio block"><label><input type="radio" name="villa_occupied" id="villa_occupied" value="yes" checked> Yes</label></div>
                                            <div class="radio block"><label><input type="radio" name="villa_occupied" id="villa_occupied" value="no"> No</label></div-->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Flat/Building details -->
                                    <div id="flat" class="div_disable">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="flat_name">Building Name</label>
                                            <input id="flat_name" name="flat_name" class="form-control" type="text" placeholder="Building name">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="flat_no">Building No</label>
                                            <input id="flat_no" name="flat_no" class="form-control" type="text" placeholder="No XXXX">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            &nbsp;
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="flat_addr_line1">Address Line 1</label>
                                            <input id="flat_addr_line1" name="flat_addr_line1" class="form-control" type="text" placeholder="Address 1">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="flat_addr_line2">Address Line 2</label>
                                            <input id="flat_addr_line2" name="flat_addr_line2" class="form-control" type="text" placeholder="AXXX"/>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- Warehouse details -->
                                    <div id="warehouse" class="div_disable">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="wh_name">Warehouse Name</label>
                                            <input id="wh_name" name="wh_name" class="form-control" type="text" placeholder="Warehouse name">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="wh_no">Warehouse No</label>
                                            <input id="wh_no" name="wh_no" class="form-control" type="text" placeholder="No XXXX">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="wh_addr_line1">Address Line 1</label>
                                            <input id="wh_addr_line1" name="wh_addr_line1" class="form-control" type="text" placeholder="Address 1">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="wh_addr_line2">Address Line 2</label>
                                            <input id="wh_addr_line2" name="wh_addr_line2" class="form-control" type="text" placeholder="AXXX"/>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3 group-mail">
                                            <label for="wh_measure">Measurement</label>
                                            <input id="wh_measure" name="wh_measure" class="form-control" type="text" placeholder="1xxx or 2xxxx">
                                            </div>
                                            <div class="col-md-2">
                                            <label>&nbsp; </label>
                                            <select class="form-control" id="wh_size" name="wh_size">
                                                  <option value="Sq.Ft">Sq.Ft</option>
                                                  <option value="Sq.Mtr">Sq.Mtr</option>
                                            </select>
                                            </div>
                                            <div class="col-md-7 group-mail">
                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 group-mail">
                                            <label for="wh_rent">Rent Amount (AED)</label>
                                            <input id="wh_rent" name="wh_rent" class="form-control" type="text" placeholder="1xxx or 2xxxx">
                                            </div>
                                            <div class="col-md-2">
                                            <label>&nbsp; </label>
                                            <select class="form-control" id="wh_rent_type" name="wh_rent_type">
                                                  <option value="Monthly">Monthly</option>
                                                  <option value="Quarterly">Quarterly</option>
                                                  <option value="Half Yearly">Half Yearly</option>
                                                  <option value="Yearly">Yearly</option>
                                                 </select>
                                            </div>
                                            <div class="col-md-7 group-mail">
                                           
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- Shop details -->
                                    <div id="shop" class="div_disable">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="shopi_name">Shop Name</label>
                                            <input id="shopi_name" name="shopi_name" class="form-control" type="text" placeholder="Warehouse name">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="shopi_no">Shop No</label>
                                            <input id="shopi_no" name="shopi_no" class="form-control" type="text" placeholder="No XXXX">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="shopi_addr_line1">Address Line 1</label>
                                            <input id="shopi_addr_line1" name="shopi_addr_line1" class="form-control" type="text" placeholder="Address 1">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="shopi_addr_line2">Address Line 2</label>
                                            <input id="shopi_addr_line2" name="shopi_addr_line2" class="form-control" type="text" placeholder="AXXX"/>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3 group-mail">
                                            <label for="shopi_measure">Measurement</label>
                                            <input id="shopi_measure" name="shopi_measure" class="form-control" type="text" placeholder="1xxx or 2xxxx">
                                            </div>
                                            <div class="col-md-2">
                                            <label>&nbsp; </label>
                                            <select class="form-control" id="shopi_size" name="shopi_size">
                                                  <option value="Sq.Ft">Sq.Ft</option>
                                                  <option value="Sq.Mtr">Sq.Mtr</option>
                                            </select>
                                            </div>
                                            <div class="col-md-7 group-mail">
                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 group-mail">
                                            <label for="shopi_rent">Rent Value (AED)</label>
                                            <input id="shopi_rent" name="shopi_rent" class="form-control" type="text" placeholder="1xxx or 2xxxx">
                                            </div>
                                            <div class="col-md-2">
                                            <label>&nbsp; </label>
                                            <select class="form-control" id="shopi_rent_type" name="shopi_rent_type">
                                                  <option value="Monthly">Monthly</option>
                                                  <option value="Quaterly">Quaterly</option>
                                                  <option value="Half Yearly">Half Yearly</option>
                                                  <option value="Yearly">Yearly</option>
                                                 </select>
                                            </div>
                                            <div class="col-md-7 group-mail">
                                           
                                            </div>
                                        </div>
                                    </div>
                                        
                                        <!-- footer-->
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button id="propsave" name="propsave" class="btn-primary btn">Save</button>
                                                    <!--button id="propsaven" name="propsaven" class="btn-default btn">Save & Next</button-->
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

