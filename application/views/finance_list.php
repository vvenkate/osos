<!DOCTYPE HTML>
<html>
<head>
<title>OSOS - Finance Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $this->load->view('common/includes');?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/user_add.js"></script>
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
                      <li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/finance" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Finance</a></li>
                      <li role="presentation"><a href="<?php echo base_url(); ?>index.php/finance/addexpense" role="tab" id="profile-tab">New Expenses</a></li>
                      <li role="presentation"><a href="<?php echo base_url(); ?>index.php/finance/addincome" role="tab" id="profile-tab">New Income</a></li>
                    </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  	<h3 class="h3.-bootstrap-heading">Finance List - Expense and Income</h3>
                    <div class="row show-grid">
                    	<div class="col-md-1">
                        	S.No
                        </div>
                        <div class="col-md-2">
                        	Expense Type
                        </div>
                        <div class="col-md-3">
                        	Expense Date
                        </div>
                        <div class="col-md-2">
                        	Amount
                        </div>
                       <div class="col-md-2">
                        	Property
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
                        	<?php echo $val['exptype']; ?>
                        </div>
                        <div class="col-md-3">
                        	<?php echo $val['expdate']; ?>
                        </div>
                        <div class="col-md-2">
                        	<?php echo $val['amt']; ?>
                        </div>
                       <div class="col-md-2">
                        	<?php echo $val['property']; ?>
                        </div>
                        <div class="col-md-2">
                        	<a href="#">View</a>
                        </div>                 
                    </div>
					<?php $i++;}}?>
                  </div>
                  <!-- Income Details -->
                  	<div class="row show-grid">
                    	<div class="col-md-1">
                        	S.No
                        </div>
                        <div class="col-md-2">
                        	Property Type
                        </div>
                        <div class="col-md-3">
                        	Property Name - Flat Name
                        </div>
                        <div class="col-md-2">
                        	Rent Paid Date
                        </div>
                        <div class="col-md-2">
                        	Rent Amount Paid
                        </div>
                        <div class="col-md-2">
                        	Action
                        </div>
                    </div>
                    <?php $i =1;
						 if($incomedata){
						 foreach($incomedata as $val){?>
					<div class="datarow row commonsize">
                    	<div class="col-md-1">
                        	 <?php echo $i;?>
                        </div>
                         <div class="col-md-2">
                        	<?php echo $val['property']; ?>
                        </div>
                        <div class="col-md-3">
                        	<?php echo $val['prop_name']; ?>
                        </div>
                        <div class="col-md-2">
                        	<?php echo $val['paiddate']; ?>
                        </div>
                        <div class="col-md-2">
                        	<?php echo $val['amt']; ?>
                        </div>
                        <div class="col-md-2">
                        	<a href="#">View</a>
                        </div>                 
                    </div>
                  <?php $i++;}}else{?>
                  <div class="datarow row commonsize">
                  	<div class="col-md-12">--No Income Yet--</div>
                  </div>
                  <?php }?>
                  <!-- Income Ends-->
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
		$('#dob').datepicker({dateFormat: "dd-mm-yy", changeMonth: true,
      changeYear: true});
	</script>
</body>
</html>