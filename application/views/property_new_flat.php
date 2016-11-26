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
<script language="javascript" type="text/javascript">
$(document).ready( function() {
	 $.ajax({url: "getlbbuilder", success: function(result){
           var arrBuilder = jQuery.parseJSON(result);
		   $.each(arrBuilder, function (index, value) {
			  	console.log(value.val);
				$('#prop_building').append($('<option/>', { 
					value: value.key,
					text :  value.val
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
										  <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property" id="home-tab" role="tab">Home</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addproperty" role="tab" id="profile-tab">New Building/Villa/Warehouse</a></li>
                                          <li role="presentation" class="active"><a href="#" role="tab" id="profile-tab">New Flat/Shop</a></li>
									</ul>
                                    <?php echo form_open('property/addflat'); ?>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         <h2 class="h2.-bootstrap-heading group-mail">New Flat/Shop</h2>
                    				<div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="prop_building">Building Name</label>
                                            <select name="prop_building" id="prop_building" class="form-control" required>
                                            	<option value="">--None--</option>
                                                
                                            </select>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                           
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-4 group-mail">
                                        <label for="prop_ftype">Property Type</label>
                                        <div class="radio block"><input id="prop_ftype" name="prop_ftype" type="radio" value="Flat" checked="true"/><label>Studio</label></div>
                                        <div class="radio block"><input id="prop_ftype" name="prop_ftype" type="radio" value="Shop" /><label>6 Bedroom House</label></div>
                                        <!--div class="radio block"><input id="prop_type" name="prop_type" type="radio" value="Shop" /><label> Shops</label></div-->
                                        </div>
                                        <div class="col-xs-6 col-md-4 group-mail">
                                        </div>
                                        <div class="col-xs-6 col-md-4 group-mail">
                                        </div>
                                    </div>
                                    
                                    <!-- flat details -->
                                    <div id="flatf" class="div_enable">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="flat_floor_no">Floor No</label>
                                            <input id="flat_floor_no" name="flat_floor_no" class="form-control" type="text" placeholder="Flat Floor No">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="flat_no">Flat No</label>
                                            <input id="flat_no" name="flat_no" class="form-control" type="text" placeholder="No XXXX">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="fno_rooms">No of Rooms</label>
                                            <input id="fno_rooms" name="fno_rooms" class="form-control" type="text" placeholder="Rooms">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-md-3 group-mail">
                                            <label for="flatf_rent_amt">Rental Value &nbsp;(AED)</label>
                                            <input id="flatf_rent_amt" name="flatf_rent_amt" class="form-control" type="text" placeholder="XXX" />
                                            </div>
                                            <div class="col-md-2">
                                            <label>&nbsp; </label>
                                            <select class="form-control" id="flatf_rent_type" name="flatf_rent_type">
                                                  <option value="Monthly">Monthly</option>
                                                  <option value="Quarterly">Quarterly</option>
                                                  <option value="Half Yearly">Half Yearly</option>
                                                  <option value="Yearly">Yearly</option>
                                                 </select>
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                                <!--label for="flatf_occpied">Occupied</label>
                                                <div class="radio block"><label><input type="radio" name="flatf_occpied" id="flatf_occpied" value="YES" checked> Yes</label></div>
                                                <div class="radio block"><label><input type="radio" name="flatf_occpied" id="flatf_occpied" value="NO"> No</label></div-->
                                            </div>
                                            <div class="col-xs-6 col-md-3 group-mail">
                                            <!--label for="flat_parking">Parking</label>
                                            <div class="radio block"><label><input type="radio" name="flat_parking" id="flat_parking" value="yes" checked> Yes</label></div>
                                            <div class="radio block"><label><input type="radio" name="flat_parking" id="flat_parking" value="no"> No</label></div-->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- Shop details -->
                                    <div id="shopf" class="div_disable">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="shopi_name">Shop Name</label>
                                            <input id="shopi_name" name="shopi_name" class="form-control" type="text" placeholder="Shop name">
                                            </div>
                                            <div class="col-xs-6 col-md-4 group-mail">
                                            <label for="shopi_no">Shop No</label>
                                            <input id="shopi_no" name="shopi_no" class="form-control" type="text" placeholder="No XXXX">
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
                                                  <option value="sqft">Sq.Ft</option>
                                                  <option value="sqmtr">Sq.Mtr</option>
                                            </select>
                                            </div>
                                            <div class="col-md-7 group-mail">
                                           
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 group-mail">
                                            <label for="shopi_rent">Rent Amount (AED)</label>
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
                                                    <button id="propflsave" name="propflsave" class="btn-primary btn">Save</button>
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

