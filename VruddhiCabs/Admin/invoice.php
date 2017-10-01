<?php require_once("/includes/session.php"); ?>
<?php require_once("/includes/dbconnection.php"); ?>
<?php require_once("/includes/functions.php"); ?>
<?php require_once("/includes/validation.php"); ?>
<?php include("/includes/mpdf/mpdf.php"); ?>
<?php 
	if(!confirm_logged_in()){
		redirect_to("login.php");
	}
?>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="includes/stylesheet/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body style="font-family: calibri;">
	<div id="logo">
			<h1>Vruddhi Cabs</h1>
			<p>The Total Travel Solutions</p><br />
		</div>
		<div style="text-align: center;">
			<p class="address">No. 896, 1st C Main, 11th Cross, Girinagar 2nd Phase,Bangalore- 560085<br>
			Mobile No : + 91 8861021021<br>
			Email: vruddhitravels@gmail.com</p>
		</div>	
		<hr>
		<h3 style="text-align: center; margin-top: -10px;">INVOICE</h3>
       <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
        	<tr class="heading">
                <td>Invoice No.</td>
                <td>Date</td>
            </tr>
            <tr class="details">
                <td><?php echo $invoiceno;?></td>
                <td><?php echo $dateofinvoice;?></td>
            </tr>
            <tr class="heading">
                <td>Name</td>
                <td>Company</td>
            </tr>
            <tr class="details">
                <td><?php echo $name;?></td>
                <td><?php echo $company;?></td>
            </tr>
            <tr class="heading">
                <td>Employee ID</td>
                <td>Email ID</td>
            </tr>
            <tr class="details">
                <td><?php echo $eid;?></td>
                <td><?php echo $email;?></td>
            </tr>
            <tr class="heading">
                <td>Contact</td>
                <td>Date of Travel</td>
            </tr>
            <tr class="details">
                <td><?php echo $contact;?></td>
                <td><?php echo $dateoftravel;?></td>
            </tr>
           
            <tr class="heading">
                <td>Travel Summary</td>
                <td>Details</td>
            </tr>
            
            <tr class="item">
                <td>Distance (KM)</td>
                <td><?php echo $distance;?></td>
            </tr>
            <tr class="item">
                <td>Charge per KM (INR)</td>
                <td><?php echo $rpkm;?></td>
            </tr>
            <tr class="item">
                <td>Miscellaneous Charges (INR)</td>
                <td><?php echo $misc;?></td>
            </tr>
            <tr class="item">
                <td>Service tax (%)</td>
                <td><?php echo $tax;?></td>
            </tr>
            <tr class="heading">
                <td>Total Amount (INR)</td>
                <td><?php echo $totalamt;?></td>
            </tr>
            <tr><td>Driver Name:</td><td><?php echo $driver;?></td></tr>
			<tr><td>Vehicle No:</td><td><?php echo $vehicleno;?></td></tr>
        </table><hr>
        <div>
 		<p class="footer1">Terms & Conditions:<br>					
			1. Cheque to be drawn favouring For Vruddhi Cabs & Travels.<br>						
			2. Cash Payments should be made only against receipt.<br>						
			3. Outstation Cheques to include Bank Charges of Rs. 100/- Extra.<br>						
			4. Amount not paid within due date will bear interest @ 18% p.a.<br>						
			5. All disputes subject to BANGALORE Jurisdiction only.</p>
 		<table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>SERVICE TAX REGISTRATION NO :</td>
                <td>ATOPK8667LSD001</td>
            </tr>
            <tr class="details">
                <td>PAN NO: ATOPK8667L</td>
                <td></td>
            </tr>
            <tr class="heading">
                <td>Account No: 17507630000042</td>
                <td>Account Name: Vruddhi Cabs and Travels</td>
            </tr>
            <tr class="details">
                <td>Bank Name: HDFC Bank Girinagar branch Bangalore</td>
                <td>IFSC Code: HDFC0001750</td>
            </tr>
            <tr class="heading">
                <td colspan="2" style="text-align: center;">This is computer generated document and does not required a signature</td>
            </tr>
        </table>    
	</div>	
    </div>
	</body>
</html>		