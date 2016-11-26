<!--- -->
		<nav class="navbar-default navbar-static-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="index.html"><img src="<?php echo base_url(); ?>assets/images/OSOS-WEB-LOGO.png" alt="OSOS LOGO" width="250" height="70"/> </a>
			</div>
			<div class=" border-bottom">
				<div class="full-left">
					<section class="full-top">
						<button id="toggle">
							<i class="fa fa-arrows-alt"></i>
						</button>
					</section>
					<form class=" navbar-left-right">
						<input type="text" value="Search..." onfocus="this.value = '';"
							onblur="if (this.value == '') {this.value = 'Search...';}"> 
							<input type="submit" value="" class="fa fa-search">
					</form>
					<div class="clearfix"></div>
				</div>

				<!-- Brand and toggle get grouped for better mobile display -->

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="full-right">
					<ul class="nav nomail" >
						<li role="presentation">&nbsp;</li>
					</ul>
					<ul class="nav mail">
						<li role="presentation"><img src="<?php echo base_url(); ?>assets/images/mail.jpg" alt="mail" /></li>
					</ul>
					<ul class="nav notify">
					 <li role="presentation"><img src="<?php echo base_url(); ?>assets/images/notify.jpg" alt="notify" /></li>
					 </ul>
					 <ul class="nav logout">
						<li role="presentation"><a href="<?php echo base_url(); ?>index.php/staff/logout"><img src="<?php echo base_url(); ?>assets/images/logout.jpg" alt="Logout"/></a></li>
					  </ul>
					  <div class="clearfix"></div>
				 </div>
				<!-- /.navbar-collapse -->
				<div class="clearfix"></div>
				
				<?php $this->load->view('common/side_menu');?>
			</div>
		</nav>