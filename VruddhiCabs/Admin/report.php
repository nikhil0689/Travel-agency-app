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
	<?php 
	   if(isset($_POST['fromdate'])){
	   	$fromdate =$_POST['fromdate'];
	   	echo $fromdate;
	   }
	   if(isset($_POST['todate'])){
	   	$todate =$_POST['todate'];
	   	echo $todate;
	   }
	   ob_start();
	?>
	<div>
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
		<h3 style="text-align: center; margin-top: -10px;">Transaction Report</h3>
		<?php 
			global $connection;
			if($connection){
				$query = "select * from customer_data where date_of_invoice >= '$fromdate' AND date_of_invoice <= '$todate'";
				$customer_list = mysqli_query($connection, $query);
				$numResults = mysqli_num_rows($customer_list);
				if($numResults == 0){
					$_SESSION["message"] = "Data not found for the requested dates";
					redirect_to("searchTransactionForCompany.php");
				}
			?>	
		<div class="report_box">
			<table cellpadding="0" cellspacing="0">
				<tr class="heading"><td>Invoice ID</td><td>Name</td><td>Date of Travel</td><td>Driver Name</td><td>Vehicle No.</td>
					<td>Total Amount</td><td>Payment Status</td></tr>
			<?php 
				while($rows=mysqli_fetch_assoc($customer_list)){
					echo "<tr>";
					echo "<td>". $rows["invoice_no"]. "</td>";
					echo "<td>". $rows["cust_name"]. "</td>";
					echo "<td>" .$rows["date_of_travel"]."</td>";
					echo "<td>" .$rows["driver_name"]."</td>";
					echo "<td>" .$rows["vehicle_no"]."</td>";
					echo "<td>" .$rows["total_amt"] . "</td>";
					echo "<td>" .$rows["payment_status"] . "</td>";
					echo "</tr>";
			}
				
			}else{
				die("Connection to the database Failed");
			}
			?>
			</table>
			<hr><br>
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
		<?php    
			$body = ob_get_clean();
			$body = iconv("UTF-8","UTF-8//IGNORE",$body);
		   	$mpdf=new mPDF('c','A4','','' , 0, 0, 0, 0, 0, 0); 
		   	$stylesheet = file_get_contents('includes/stylesheet/invoicestyle.css'); // external css
		   	$mpdf->SetFont('Calibri');
		   	$mpdf->WriteHTML($stylesheet,1);
		   	$mpdf->WriteHTML($body,2);
		   	$mpdf->Output('TransactionReport.pdf','D');
		?>	
		<br>
	</div>
</html>