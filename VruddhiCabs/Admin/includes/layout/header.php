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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  $( function() {
	    $( "#datepicker2" ).datepicker();
	  } );
  </script>
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
<div class="login_admin">
<?php if(isset($_SESSION["user"])){
	echo "Welcome  ". $_SESSION["user"];
}?><br>
<a href="logout.php">Logout</a>
</div>	
					