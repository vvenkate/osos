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
	
	cur_page = $(location).attr('href');
	if(cur_page.indexOf("villa") > 0){
		$("#prop_list_change").val("villa");
	}else if(cur_page.indexOf("warehouse") > 0){
		$("#prop_list_change").val("warehouse");
	}else {
		$("#prop_list_change").val("");
	}
	
	$("#prop_list_change").change(function(){
		var value = $(this).val();
		var newpage = "<?php echo base_url(); ?>index.php/";

		//newpage = $(location).attr('href');
		if(value == "villa"){
			page = "property/villa";
		}else if(value == "warehouse"){
			page = "property/warehouse";
		}else {
			page = "property/index";
		}
		
		newpage = newpage+page;
		$(location).attr('href', newpage);
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
										  <li role="presentation" class="active"><a href="#" id="home-tab" role="tab">Home</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addproperty" role="tab" id="profile-tab">New Building/Villa/Warehouse</a></li>
                                          <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addflat" role="tab" id="profile-tab">New Flat/6 Room House</a></li>
                                           <li role="presentation"><a href="<?php echo base_url(); ?>index.php/property/addtenant" role="tab" id="profile-tab">New Tenant</a></li>
									</ul>
                                   
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active"
                                            id="home" aria-labelledby="home-tab">
                                         	<h2 class="h2.-bootstrap-heading group-mail">Property List</h2>
                                            <form name="property_form" method="get">
                                            <div class="row">
                                            	<div class="col-md-2">
                                                <label for="propery">Property Type</label>
                                            	<select class="form-control1" id="prop_list_change" name="prop_list_change">
                                                	<option value="">Building</option>
                                                	<option value="villa">Villa</option>
                                                    <option value="warehouse">Warehouse</option>
                                            	</select>
                                                </div>
                                            </div>
                                            </form>
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
                                                    Creation Date
                                                </div>
                                                <div class="col-md-2">
                                                    Action
                                                </div>
                                            </div>
                                            <?php $i =1;
											 if($sendData){
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
                                                    <?php echo $val['date'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="<?php echo base_url(); ?>index.php/property/update_property?id=<?php echo $val['id'];?>&type=<?php echo $val['type'];?>">View</a>
                                                    <?php if($val['type'] == 'Building') {?>
                                                    &nbsp; &nbsp;<a href="<?php echo base_url(); ?>index.php/property/buildingsublist?id=<?php echo $val['id'];?>">View Flats Detail</a>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <?php $i++; }}else{?>
                                            <div class="row commonsize">
                                            	<div class="col-md-1"></div>
                                                <div class="col-md-10" align="center">-- No Property Found --</div>
                                                <div class="col-md-1"></div>
                                            </div>
                                            <?php }?>
                                            
                                            <div class="row show-grid">
                                                <div class="col-md-1">
                                                    S.No
                                                </div>
                                                <div class="col-md-2">
                                                    Tenant Name 
                                                </div>
                                                <div class="col-md-2">
                                                    Property Type
                                                </div>
                                                <div class="col-md-2">
                                                    Rent Amount
                                                </div>
                                                <div class="col-md-2">
                                                    Contract Start Date
                                                </div>
                                                <div class="col-md-2">
                                                    Contract End Date
                                                </div>
                                                <div class="col-md-1">
                                                    Action
                                                </div>
                                            </div>
                                            <?php $i =1;
											 if($tendata){
											 foreach($tendata as $val){?>
                                            <div class="datarow row commonsize">
                                                <div class="col-md-1">
                                                    <?php echo $i;?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['name']; ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['prop_type'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['rent'];?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php echo $val['std'];?>
                                                </div>
                                                <div class="col-md-2">
                                                     <?php echo $val['etd'];?>
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="<?php echo base_url(); ?>index.php/property/updatetenant?id=<?php echo $val['id'];?>">Renew Contract</a>
                                                </div>
                                            </div>
                                            <?php $i++; }}else{?>
                                            <div class="row commonsize">
                                            	<div class="col-md-1"></div>
                                                <div class="col-md-10" align="center">-- No Tenant Found --</div>
                                                <div class="col-md-1"></div>
                                            </div>
                                            <?php }?>
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

