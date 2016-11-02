<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>OSOS Account Creation Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<table style="border-collapse:collapse" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody>
		<tr>
            <td style="border-collapse:collapse;padding-top:0px;padding-bottom:10px" width="600" valign="top">
            <img src="<?php echo base_url(); ?>assets/images/OSOS-WEB-LOGO.png" alt="OSOS" style="outline:none;text-decoration:none;margin:0 auto 29px;display:block">

			<h1 style="text-align:center;font-size:34px;line-height:54px;margin:0 0 25px 0;font-weight:200;color:black">Welcome to OSOS!</h1>

			<p>Hello <?php echo $username;?>,:</p>
			<p>The following user account has been created:</p>
			<p>Username: <?php echo $username;?></p>
			<p>Password: <?php echo $username;?></p>

			<a href="mailto:mukilmani@gmail.com" target="_blank">OSOS Admin Team</a>

			<p>If you are having any issues with your account, please don't hesitate to contact us by replying to this mail.</p>
		
			Thanks!
			OSOS Team
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>