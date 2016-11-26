<?php 
$aPrivileges = $this->session->userdata('privileges');

$UM_ALLOWED = false;
$FM_ALLOWED = false;
$SM_ALLOWED = false;
$MM_ALLOWED = false;
$RM_ALLOWED = false;
$PM_ALLOWED = false;
$LANDING_PAGE = 'Dashboard';


$ALLOWED_ALL_MODULES = array();

foreach ($aPrivileges as $values){
	if(
			($values['permission_bit'] === '1') ||
			($values['permission_bit'] === '2') ||
			($values['permission_bit'] === '4') ||
			($values['permission_bit'] === '8')
    ){
		$UM_ALLOWED = true;
		$LANDING_PAGE = 'Usermanage';
		
	}
	
	if(
  		($values['permission_bit'] == '16') ||
  		($values['permission_bit'] == '32') ||
  		($values['permission_bit'] == '64') ||
  		($values['permission_bit'] == '128')
	){
  		$SM_ALLOWED = true;
  		$LANDING_PAGE = 'Staff';
  		
	}
	
	if(
			($values['permission_bit'] == '256') ||
			($values['permission_bit'] == '512') ||
			($values['permission_bit'] == '1024') ||
			($values['permission_bit'] == '2048')
	){
		$PM_ALLOWED = true;
		$LANDING_PAGE = 'Property';
		
	}
		
	if(
			($values['permission_bit'] == '4096') ||
			($values['permission_bit'] == '8192') ||
			($values['permission_bit'] == '16384') ||
			($values['permission_bit'] == '32768')
	){
		$FM_ALLOWED = true;
		$LANDING_PAGE = 'Finance';
		
	}
	
	if(
			($values['permission_bit'] == '65536') ||
			($values['permission_bit'] == '131072') ||
			($values['permission_bit'] == '262144') ||
			($values['permission_bit'] == '524288')
	){
		$MM_ALLOWED = true;
		$LANDING_PAGE = 'Mainticket';
		
	}
	
	if(
			($values['permission_bit'] == '1048576') ||
			($values['permission_bit'] == '2097152') ||
			($values['permission_bit'] == '4194304') ||
			($values['permission_bit'] == '8388608')
	){
		$RM_ALLOWED = true;
		$LANDING_PAGE = 'Reports';
		
	}
	
}

$aPrivileges = $this->session->userdata('privileges');

?>

<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<div style="height:250px;">
			<div style="height:200px;">
			</div>
			<div class="nav-sidebar cur_profile">Welcome 
						&nbsp;<?php						
						echo $this->session->userdata('user_name');						
						?></div>
		</div>
		<ul class="nav" id="side-menu">

			<?php 
			if($SM_ALLOWED){
			?>						
			<li><a href="<?php echo base_url(); ?>index.php/staff/" class=" hvr-bounce-to-right"><span class="nav-label">STAFF</span> </a></li>
			<?php
			} else { 
			?>
			<li><a class=" hvr-bounce-to-right"><span class="nav-label">STAFF</span> </a></li>
			<?php
			} 
			?>						

			<?php 
			if($FM_ALLOWED){
			?>
			<li><a href="<?php echo base_url(); ?>index.php/finance" class=" hvr-bounce-to-right"><span class="nav-label">FINANCE</span> </a></li>
			<?php
			} else { 
			?>
			<li><a class=" hvr-bounce-to-right"><span class="nav-label">FINANCE</span> </a></li>			
			<?php
			} 
			?>
			
			<?php 
			if($UM_ALLOWED){
			?>
			<li><a href="<?php echo base_url(); ?>index.php/Userroles" class=" hvr-bounce-to-right"><span class="nav-label">USER ROLES</span> </a></li>
			<?php
			} else { 
			?>
			<li><a class=" hvr-bounce-to-right"><span class="nav-label">USER ROLES</span> </a></li>
			<?php
			} 
			?>

			<?php 
			if($MM_ALLOWED){
			?>									
			<li><a href="<?php echo base_url(); ?>index.php/ticket" class=" hvr-bounce-to-right"><span class="nav-label">MAINTENANCE TICKET</span> </a></li>
			<?php
			} else {
			?>
			<li><a class=" hvr-bounce-to-right"><span class="nav-label">MAINTENANCE TICKET</span> </a></li>
			<?php
			}
			?>						
			
			<?php 
			if($RM_ALLOWED){
			?>			
			<li><a href="<?php echo base_url(); ?>index.php/report" class=" hvr-bounce-to-right"><span class="nav-label">REPORTS</span><span class="fa arrow"></span></a></li>
			<?php
			} else { 
			?>
			<li><a class=" hvr-bounce-to-right"><span class="nav-label">REPORTS</span><span class="fa arrow"></span></a></li>
			<?php
			} 
			?>						

			<?php 
			if($PM_ALLOWED){
			?>			
			<li><a href="<?php echo base_url(); ?>index.php/property" class=" hvr-bounce-to-right"><span class="nav-label">PROPERTY</span></a></li>
			<?php
			} else { 
			?>
			<li><a class=" hvr-bounce-to-right"><span class="nav-label">PROPERTY</span></a></li>
			<?php
			} 
			?>						
		</ul>
	</div>
</div>