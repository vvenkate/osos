<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Property Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/tenant_mgmt.js"></script>
<script>
$(function () {
	$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

	if (!screenfull.enabled) {
		return false;
	}
	
	$('#toggle').click(function () {
		screenfull.toggle($('#container')[0]);
	});
	getListBoxUpdate('#villa_no',"property/getlbvilla");
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
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addflat" role="tab" id="profile-tab">New Flat/Shop</a></li>
                                          <li role="presentation" class="active"><a href="" role="tab" id="profile-tab">New Tenant</a></li>
									</ul>
                                   
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                         <?php echo form_open_multipart('property/addtenant'); ?>
                                         	<h2 class="h2.-bootstrap-heading group-mail">New Tenant</h2>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="prop_ttype">Property Type</label>
                                                <div class="radio block"><input id="prop_ttype" name="prop_ttype" type="radio" value="1"  /><label>Building - FLAT/Shop</label></div>
                                                <div class="radio block"><input id="prop_ttype" name="prop_ttype" type="radio" value="2" checked/><label>Villa</label></div>
                                                <div class="radio block"><input id="prop_ttype" name="prop_ttype" type="radio" value="3" /><label> Warehouse</label></div>
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
                                                    <label for="villa_no">Villa No</label>
                                                    <select class="form-control1" id="villa_no" name="villa_no">
                                                      <option value="">-- select one --</option>
                                                      <option value="Villa A101">Villa A101</option>
                                                      <option value="Villa A102">Villa A102</option>
                                                      <option value="Villa B101">Villa B101</option>
                                                      <option value="Villa B111">Villa B111</option>
                                                     </select>
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    <!--label for="villa_no">Villa Name</label>
                                                    <input id="villa_no" name="villa_no" class="form-control" disabled type="text" placeholder="Automatic Populate"-->
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Flat/Building details -->
                                            <div id="flat" class="div_disable">
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    <label for="flat_name">Building Name</label>
                                                    <select class="form-control1" id="flat_name" name="flat_name">
                                                      <option value="">-- select one --</option>
                                                      <option value="building1">Building 1</option>
                                                      <option value="building2">Building 2</option>
                                                      <option value="building3">Building 3</option>
                                                      <option value="building4">Building 4</option>
                                                     </select>
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    <label for="flat_no">Flat No</label>
                                                    <select class="form-control1" id="flat_no" name="flat_no">
                                                        <option value="">-- select one --</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Warehouse details -->
                                            <div id="warehouse" class="div_disable">
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    <label for="wh_no">Warehouse No</label>
                                                    <select class="form-control1" id="wh_no" name="wh_no">
                                                      <option value="">-- select one --</option>
                                                      <option value="building1">Warehouse 1</option>
                                                      <option value="building2">Warehouse 2</option>
                                                      <option value="building3">Warehouse 3</option>
                                                      <option value="building4">Warehouse 4</option>
                                                     </select>
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    <!--label for="warehouse_name">Warehouse Name</label>
                                                    <input id="warehouse_name" name="warehouse_name" class="form-control" type="text" disabled placeholder="Autofill"-->
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <!-- Shop details -->
                                            <div id="shop" class="div_disable">
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    <label for="shopi_no">Shop No</label>
                                                    <select class="form-control1" id="shopi_no" name="shopi_no">
                                                      <option value="">-- select one --</option>
                                                      <option value="building1">Shop 1</option>
                                                      <option value="building2">Shop 2</option>
                                                      <option value="building3">Shop 3</option>
                                                      <option value="building4">Shop 4</option>
                                                     </select>
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    <label for="shopi_name">Shop Name</label>
                                                    <input id="shopi_name" name="shopi_name" class="form-control" type="text" disabled placeholder="Autofill">
                                                    </div>
                                                    <div class="col-xs-6 col-md-4 group-mail">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!--div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="tent_rent_amt">Rent Value (AED)</label>
                                                <input id="tent_rent_amt" name="tent_rent_amt" class="form-control" required type="text" placeholder="123">
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                	<label for="tentcont_sd">Contract Start Date</label>
                                                    <div class="input-group">
                                                        <input id="tentcont_sd" name="tentcont_sd" class="form-control" type="text" required placeholder="dd-mm-yyyy" /><span class="input-group-addon"><a onClick="javascript:$('#tentcont_sd').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                	<label for="tentcont_ed">Contract End Date</label>
                                                    <div class="input-group">
                                                        <input id="tentcont_ed" name="tentcont_ed" class="form-control" type="text" required placeholder="dd-mm-yyyy" /><span class="input-group-addon"><a onClick="javascript:$('#tentcont_ed').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>	
                                                    </div>
                                                </div>
                                            </div-->
                                            
                                            <div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="first_name">First Name</label>
                                                <input id="first_name" name="first_name" class="form-control" required type="text" placeholder="First name">
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="mid_name">Middle Name</label>
                                                <input id="mid_name" name="mid_name" class="form-control" type="text" placeholder="Middle name">
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="last_name">Last Name</label>
                                                <input id="last_name" name="last_name" class="form-control" required type="text" placeholder="Last name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                    <label for="gender">Gender</label>
                                                    <div class="radio block"><label><input type="radio" name="gender" id="gender" value="Male" checked> Male</label></div>
                                                    <div class="radio block"><label><input type="radio" name="gender" id="gender" value="Female"> Female</label></div>
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="dob">Date of Birth</label>
                                                <div class="input-group">
                                                    <input id="dob" name="dob" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#dob').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>
                                                </div>
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="contact_no">Mobile Number</label>
                                                <input id="contact_no" name="contact_no" class="form-control" required type="text" maxlength="11" placeholder="9XXXXXXX8">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="mstatus">Martial Status</label>
                                                    <div class="radio block"><label><input type="radio" name="mstatus" id="mstatus" value="Single"> Single</label></div>
                                                    <div class="radio block"><label><input type="radio" name="mstatus" id="mstatus" value="Married"> Married</label></div>
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                    <label for="nationality">Nationality</label>
                                                    <select class="form-control1" id="nationality" name="nationality">
                                                          <option value="">-- select one --</option>
                                                          <?php
															foreach ($nationalities_list as $value):
														?>
															<option value="<?php echo $value->Nationality;?>"><?php echo $value->Nationality;?></option>
														<?php
														endforeach;
														?>
                                                    </select>
                                                </div>                        
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                &nbsp;
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="company_name">Organization Name</label>
                                                <input id="company_name" name="company_name" class="form-control" required type="text" placeholder="Organization name">
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="workas">Designation</label>
                                                <input id="workas" name="workas" class="form-control" type="text" placeholder="Designation">
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="idproof_type">ID Proof Type</label>
                                                <select class="form-control1" id="idproof_type" name="idproof_type">
                                                  <option value="Emirates ID">Emirates ID</option>
                                                  <option value="Passport">Passport</option>
                                                 </select>
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="idproof_no">ID Number</label>
                                                <input id="idproof_no" name="idproof_no" class="form-control" type="text" required placeholder="No ..">
                                                </div>
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="idproof_edt">Valid Until Date</label>
                                                <div class="input-group">
                                                <input id="idproof_edt" name="idproof_edt" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a href="#"><img width="21" height="20" alt="DT" src="images/date.png"></a></span>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-4 group-mail">
                                                <label for="passport_doc">Upload ID Proof Document</label>
                                                <input type="file" id="passport_doc" name="passport_doc">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-4 group-mail">
                                                <label for="tentcont_sd">Contract Start Date</label>
                                                <div class="input-group">
                                                    <input id="tentcont_sd" name="tentcont_sd" class="form-control" type="text" required placeholder="dd-mm-yyyy"><span class="input-group-addon"><a onClick="javascript:$('#tentcont_sd').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>
                                                </div>
                                                </div>
                                                <div class="col-md-4">
                                                <!--label for="rent_duration">Rent Duration</label>
                                                <input id="rent_duration" name="rent_duration" class="form-control" type="text" placeholder="1 month or 2 months"-->
                                               		<label for="tentcont_ed">Contract End Date</label>
                                                    <div class="input-group">
                                                        <input id="tentcont_ed" name="tentcont_ed" class="form-control" type="text" required placeholder="dd-mm-yyyy" /><span class="input-group-addon"><a onClick="javascript:$('#tentcont_ed').focus();"><img width="21" height="20" alt="DT" src="<?php echo base_url(); ?>assets/images/date.png"></a></span>	
                                                    </div>
                                                </div>
                                                <div class="col-md-4 group-mail">
                                                <label>Payment Mode</label>
                                                <select class="form-control" id="payment_mode" name="payment_mode">
                                                      <option value="Cash">Cash</option>
                                                      <option value="Cheque">Cheque</option>
                                                      <option value="Online Transfer">Online Transfer</option>
                                                     </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-4 group-mail">
                                                <label for="tenant_rent">Rent Value (AED)</label>
                                                <input id="tenant_rent" name="tenant_rent" class="form-control" type="text" placeholder="1xxx or 2xxxx">
                                                </div>
                                                <div class="col-md-4">
                                                <label>&nbsp; </label>
                                                <select class="form-control" id="tenant_rent_type" name="tenant_rent_type">
                                                      <option value="Monthly">Monthly</option>
                                                      <option value="Quarterly">Quarterly</option>
                                                      <option value="Half Yearly">Half Yearly</option>
                                                      <option value="Yearly">Yearly</option>
                                                     </select>
                                                </div>
                                                <div class="col-md-4 group-mail">
                                               
                                                </div>
                                            </div>
                                                
                                            <!-- footer-->
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <button id="tenant_save" name="tenant_save" class="btn-primary btn">Save</button>
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
    <script language="javascript">
		$('#tentcont_sd').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		$('#tentcont_ed').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		$('#idproof_edt').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		
		$('#dob').datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
		
	</script>
</body>
</html>

