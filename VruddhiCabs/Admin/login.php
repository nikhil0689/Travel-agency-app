<?php 
echo
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html');?>
<?php require_once("/includes/session.php"); ?>
<?php require_once("/includes/dbconnection.php"); ?>
<?php require_once("/includes/functions.php"); ?>
<?php require_once("/includes/validation.php"); ?>
<?php 
if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
   session_destroy();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Vruddhi Cabs</title>
<link href="includes/stylesheet/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="javascript/jquery.slidertron-1.0.js"></script>
<script type="text/javascript" src="javascript/crawler.js"></script>
<script type="text/javascript" src="javascript/sorttable.js"></script>
<script src="javascript/jquery-3.1.1.min.js"></script>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script language="JavaScript" src="javascript/gen_validatorv31.js" type="text/javascript"></script>
</head>
<body>
<div id="logo">
	<h1>Vruddhi Cabs</h1>
	<p>The Total Travel Solutions</p><br />
</div>
<div style="text-align: center;">
	<p class="address">No. 896, 1st C Main, 11th Cross, Girinagar 2nd Phase,Bangalore- 560085<br>
	Mobile No : + 91 8861021021<br>
	Email: vruddhitravels@gmail.com</p>
</div>	
<?php
	$username = "";
	$password = "";
	if(isset($_POST['submit'])){
		$required_fields = array("username","password");
		validate_presences($required_fields);
		if(empty($errors)){
			$username = $_POST["username"];
			$password = $_POST["password"];
			$attempt_login = login_data($username,$password);
			if($attempt_login){
				redirect_to("index.php");
			}
		}	
	}
?>
<div class="page_content">
	<div class="message_panel">
		 <?php echo message(); ?>
   			 <?php echo form_errors($errors); ?>
	</div>	
	<div class="login-page">
			  <div class="form">
			  <h3 style="text-align: center;">Admin Login</h3>
			    <form action="login.php" method="post">
			    <div align="center">
			    <table>
			      <tr><td><input type="text" name="username" placeholder="User Name" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"/></td></tr>
			      <tr><td><input type="password" name="password" placeholder="password"/></td></tr>
			      <tr><td><input type="submit" class="submit_button_login" name="submit" value="Submit" /></td></tr>
			    </table>
			    </div>
			    </form>
  				</div>
			</div>
</div>
<?php include ("/includes/layout/footer.php");?>
	