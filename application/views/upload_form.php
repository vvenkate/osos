<!doctype html>
<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/uploadfile.js"></script>
    <script src="<?php echo base_url()?>assets/js/ajaxfileupload.js"></script>
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <h1>Upload File</h1>
    <?php 
    $csrf = array(
    		'name' => $this->security->get_csrf_token_name(),
    		'hash' => $this->security->get_csrf_hash()
    );
    ?>
    <form method="post" action="" id="upload_file">
    	<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <!-- <label for="title">Title</label> -->
        <!-- <input type="text" name="title" id="title" value="" /> -->
 
        <label for="userfile">File</label>
        <input type="file" name="userfile" id="userfile" size="20" />
 
        <input type="submit" name="submit" id="submit" />
    </form>
    <h2>Files</h2>
    <div id="files"></div>
</body>
</html>