<?php require_once("/includes/session.php"); ?>
<?php require_once("/includes/dbconnection.php"); ?>
<?php require_once("/includes/functions.php"); ?>
<?php require_once("/includes/validation.php"); ?>
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
	<link href="/includes/stylesheet/invoicestyle.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
</head>
<body>
<?php 
	if(!confirm_logged_in()){
		redirect_to("login.php");
	}
?>
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
<?php
	$id = $_GET["id"];
	$retrieve_passenger_details = passenger_details($id);
	
?>
<?php
	$name = "";
	$company = "";
	$eid = "";
	$email = "";
	$contact = "";
	$dateoftravel = "";
	$distance = "";
	$rpkm = "";
	$misc = "";
	$tax = "";
	$driver = "";
	$vehicleno = "";
	$dateofinvoice = "";
	$totalamt = "";
	$invoiceno = "";
?>
<?php 
	if(isset($_POST['update'])){
		$invoiceno = $_POST["invoiceno"];
		$vehicleno = $_POST["vehicleno"];
		$required_fields = array("invoiceno","name","contact","email","dateoftravel","distance","rpkm","misc","tax","driver","vehicle","dateofinvoice");
		validate_presences($required_fields);
		$alpha_fields = array("name","driver");
		validate_for_alphabets($alpha_fields);
		$number_fields = array("invoiceno","contact");
		validate_for_numerals($number_fields);
		$tax_field = array("distance","tax","rpkm","misc");
		validate_for_tax($tax_field);
		
		if(empty($errors)){
			echo "here";
			$invoiceno = $_POST["invoiceno"];
			$name = $_POST["name"];
			$company = $_POST["company"];
			$eid = $_POST["eid"];
			$email = $_POST["email"];
			$contact = $_POST["contact"];
			$dateoftravel = $_POST["dateoftravel"];
			$distance = $_POST["distance"];
			$rpkm = $_POST["rpkm"];
			$misc = $_POST["misc"];
			$tax = $_POST["tax"];
			$totalamt = $_POST["totalamt"];
			$driver = $_POST["driver"];
			$vehicleno = $_POST["vehicle"];
			$dateofinvoice = $_POST["dateofinvoice"];
			$paymentStatus = $_POST["paymentstatus"];
			$paymentMode = $_POST["paymentmode"];
			if($paymentMode=="Select"){
				$paymentMode = "";
			}
			$attempt_passenger_update = passenger_details_update($invoiceno,$name,$company,$eid,$email,$contact,$dateoftravel,
					$distance,$rpkm,$misc,$tax,$totalamt,$driver,$vehicleno,$dateofinvoice,$paymentStatus,$paymentMode);
			if($attempt_passenger_update){
				redirect_to("editPassengerData.php?id=".urlencode($invoiceno));
			}
		}else{
			redirect_to("editPassengerData.php?id=".urlencode($invoiceno));
		}
	}
?>
<?php
if(isset($_POST['generate'])){
	$vehicleno = $_POST["vehicleno"];
	$required_fields = array("invoiceno","name","contact","email","dateoftravel","distance","rpkm","misc","tax","driver","vehicle","dateofinvoice");
	validate_presences($required_fields);
	$alpha_fields = array("name","driver");
	validate_for_alphabets($alpha_fields);
	$number_fields = array("invoiceno","contact");
	validate_for_numerals($number_fields);
	$tax_field = array("distance","tax","rpkm","misc");
	validate_for_tax($tax_field);
	if(empty($errors)){
		echo "here";
		$invoiceno = $_POST["invoiceno"];
		$name = $_POST["name"];
		$company = $_POST["company"];
		$eid = $_POST["eid"];
		$email = $_POST["email"];
		$contact = $_POST["contact"];
		$dateoftravel = $_POST["dateoftravel"];
		$distance = $_POST["distance"];
		$rpkm = $_POST["rpkm"];
		$misc = $_POST["misc"];
		$tax = $_POST["tax"];
		$totalamt = $_POST["totalamt"];
		$driver = $_POST["driver"];
		$vehicleno = $_POST["vehicle"];
		$dateofinvoice = $_POST["dateofinvoice"];
		$paymentStatus = $_POST["paymentstatus"];
		$paymentMode = $_POST["paymentmode"];
		if($paymentMode=="Select"){
			$paymentMode = "";
		}
	ob_start();
?>
	<?php include("/invoice.php"); ?>
	
<?php    
	$body = ob_get_clean();
	$body = iconv("UTF-8","UTF-8//IGNORE",$body);
   	$mpdf=new mPDF('c','A4','','' , 0, 0, 0, 0, 0, 0); 
   	$stylesheet = file_get_contents('includes/stylesheet/invoicestyle.css'); // external css
   	$mpdf->SetFont('Calibri');
   	$mpdf->WriteHTML($stylesheet,1);
   	$mpdf->WriteHTML($body,2);
   	$filename = "Invoice ".$invoiceno.".pdf";
   	$mpdf->Output($filename,'D');
	}
}
?>
<div class="page_content2">
<h3>Update Passenger Details </h3>
<div class="message_panel">
	 <?php 
	 	echo message();
		echo form_errors($errors);	
	 ?>
	 </div><br>
<form action="editPassengerData.php" id="company_data" method="post">
	<div class="admin_passenger_panel">
		<table>
			<tr><td>Invoice No:</td><td><input type="text" name="invoiceno" value="<?php echo $retrieve_passenger_details["invoice_no"]; ?>" readonly></td></tr>
			<tr><td>Name:</td><td><input type="text" name="name" value="<?php echo $retrieve_passenger_details["cust_name"]; ?>"></td></tr>
			<tr><td>Email:</td><td> <input type="text" name="email" value="<?php echo $retrieve_passenger_details["email"]; ?>"></td></tr>
			<tr><td>Contact:</td><td> <input type="text" name="contact" value="<?php echo $retrieve_passenger_details["contact"]; ?>"></td></tr>
			<tr><td>Company:</td><td> <input type="text" name="company" value="<?php echo $retrieve_passenger_details["company_name"]; ?>"></td></tr>
			<tr><td>Employee ID:</td><td> <input type="text" name="eid" value="<?php echo $retrieve_passenger_details["employee_id"]; ?>"></td></tr>
			<tr><td>Date Of Travel:</td><td> <input type="text" name="dateoftravel" id="datepicker" value="<?php echo $retrieve_passenger_details["date_of_travel"]; ?>"></td></tr>
			<tr><td>Distance:</td><td> <input type="text" name="distance" value="<?php echo $retrieve_passenger_details["kilo_ms"]; ?>"></td></tr>
			<tr><td>Rate per KM:</td><td> <input type="text" name="rpkm" value="<?php echo $retrieve_passenger_details["rate_per_km"]; ?>"></td></tr>
		</table>
	</div>
	<div class="admin_logistics_panel">
		<table>	
			<tr><td>Misc Charges:</td><td> <input type="text" name="misc" value="<?php echo $retrieve_passenger_details["misc"]; ?>"></td></tr>
			<tr><td>Tax:</td><td> <input type="text" name="tax" value="<?php echo $retrieve_passenger_details["tax"]; ?>"></td></tr>
			<tr><td>Total Amount:</td><td> <input type="text" name="totalamt" value="<?php echo $retrieve_passenger_details["total_amt"]; ?>"></td></tr>
			<tr><td>Driver:</td><td> <input type="text" name="driver" value="<?php echo $retrieve_passenger_details["driver_name"]; ?>"></td></tr>
			<tr><td>Vehicle No:</td><td> <input type="text" name="vehicle" value="<?php echo $retrieve_passenger_details["vehicle_no"]; ?>"></td></tr>
			<tr><td>Date of Invoice:</td><td> <input type="text" name="dateofinvoice" value="<?php echo $retrieve_passenger_details["date_of_invoice"]; ?>"></td></tr>
			<tr><td>Payment Status:</td><td> <select class="drop_down" name="paymentstatus">
				  <option value=
						  	<?php if($retrieve_passenger_details["payment_status"]=="Not-received"){
						  		$val = "Not-received";
						  		echo "Not-received";
							}else{
								$val = "Paid";
								echo "Paid";
							}	
							?> >
							<?php echo $val?></option>
							<option value=
						  	<?php if($val == "Not-received"){
						  		echo "Paid";
						  		$val = "Paid";
							}else{
								echo "Not-received";
								$val = "Not-received";
							}?> ><?php echo $val?></option>
			</select></td></tr>
			<tr><td>Payment Mode:</td><td><select class="drop_down" name="paymentmode">
				<?php $payment_mode = $retrieve_passenger_details["payment_mode"]?>
				  <option value="<?php if($payment_mode == null){
				  	$payment_mode = "Select";
				  }echo $payment_mode;?>"><?php echo $payment_mode?></option>	
				  <option value="<?php $payment_mode = ($payment_mode = "Check")? "Online Banking":"Check"; echo $payment_mode ?>"><?php echo $payment_mode;?></option>
				  <option value="<?php $payment_mode = ($payment_mode = "Online Banking")? "Check":"Online Banking"; echo $payment_mode ?>"><?php echo $payment_mode;?></option>
			</select></td></tr>
		</table>
		<input class="submit_button" type="submit" id="submit_id" name="update" value="Update" /><br><br>
				<input class="submit_button" type="submit" id="generate_id" name="generate" value="Generate Invoice" />
	</div>
</form>	<br>
<a href="index.php">Back to Main Page</a>
</div><pre></pre><br>
<?php include ("/includes/layout/footer.php");?>