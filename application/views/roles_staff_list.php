<!DOCTYPE HTML>
<html>
<head>
<title>Virtual Desk - Property Management</title>
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
                      <li role="presentation" class="active"><a href="<?php echo base_url(); ?>index.php/staff" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Employees</a></li>
                      <!--li role="presentation"><a href="<?php echo base_url(); ?>index.php/UserRoles/userinfo" role="tab" id="profile-tab">New Employee</a></li-->
                    </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                  	<h3 class="h3.-bootstrap-heading">Staff List</h3>
                    <div class="row show-grid">
                    	<div class="col-md-1">
                        	S.No
                        </div>
                        <div class="col-md-2">
                        	First Name
                        </div>
                        <div class="col-md-2">
                        	Last Name
                        </div>
                        <div class="col-md-2">
                        	Designation
                        </div>
                        <div class="col-md-2">
                        	Department
                        </div>
                        <div class="col-md-2">
                        	Date of Joining
                        </div>
                        <div class="col-md-1">
                        	Action
                        </div>
                    </div>
                    <?php
                    $i = 1;
                    foreach ($staff_list as $item):
                    ?>
                    <div class="datarow row commonsize">
                    	<div class="col-md-1">
                        	<?php echo $i;?>
                        </div>
                    	<div class="col-md-2">
                        	<?php echo $item->first_name;?>
                        </div>
                        <div class="col-md-2">
                        	<?php echo $item->last_name;?>
                        </div>
                        <div class="col-md-2">
                        	<?php echo $item->designation;?>
                        </div>
                        <div class="col-md-2">
                        	<?php echo $item->name;?>
                        </div>
                        <div class="col-md-2">
                        	<?php 
                        	$dt = new DateTime($item->created_at);
                        	
                        	$date = $dt->format('m/d/Y');
                        	echo $date;
                        	
                        	?>
                        </div>                        
                        <div class="col-md-1">	
                        <?php 
							$url = base_url()."index.php/Userroles/Userinfo/".$item->id;
						?>
                        	<a href="<?php echo $url;?>">View</a>
                        </div>
                    </div>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <p>Create Employee</p>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="profiles" aria-labelledby="profile-tab">
                    <p>List of Employees - last first or with search will given here</p>
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