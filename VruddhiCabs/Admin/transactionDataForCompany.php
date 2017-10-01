<?php require_once("/includes/session.php"); ?>
<?php require_once("/includes/dbconnection.php"); ?>
<?php require_once("/includes/functions.php"); ?>
<?php require_once("/includes/validation.php"); ?>
<?php include("/includes/mpdf/mpdf.php"); ?>

<?php include("/includes/layout/header.php");?>
<?php 
	if(!confirm_logged_in()){
		redirect_to("login.php");
	}
?>
<?php 
	$company = $_GET["company"];
	$_SESSION["company"] = $company;
	$from = $_GET["from"];
	$fromdate = date('Y-m-d', strtotime(str_replace('-', '/', $from)));
	$_SESSION["fromdate"] = $fromdate;
	$to = $_GET["to"];
	$todate = date('Y-m-d', strtotime(str_replace('-', '/', $to)));
	$_SESSION["todate"] = $todate;
?>
<div class="page_content">
	<h3>Passenger Data</h3>
	<h4><a href="index.php">&laquo; Back to Main Page</a></h4><pre></pre>
	<div>
		<?php 
			global $connection;
			if($connection){
				$query = "select * from customer_data where company_name='$company' AND date_of_invoice >= '$fromdate' AND date_of_invoice <= '$todate'";
				$customer_list = mysqli_query($connection, $query);
				$numResults = mysqli_num_rows($customer_list);
				if($numResults == 0){
					$_SESSION["message"] = "Data not found for the requested dates";
					redirect_to("searchTransactionForCompany.php");
				}
				
		?>	
		<table class="table_style">
			<tr><th>ID</th><th>Name</th><th>Contact</th><th>Company</th><th>Employee ID</th><th>Date of Travel</th><th>Driver Name</th><th>Vehicle No.</th>
				<th>Total Amount</th><th>Payment Status</th></tr>
		<?php 
			while($rows=mysqli_fetch_assoc($customer_list)){
				echo "<tr>";
				echo "<td><a href=\"editPassengerData.php?id=".$rows["invoice_no"]."\">" . $rows["invoice_no"] . "</a></td>";
				echo "<td>". $rows["cust_name"]. "</td>";
				echo "<td>". $rows["contact"]. "</td>";
				echo "<td>" .$rows["company_name"]."</td>";
				echo "<td>" .$rows["employee_id"]."</td>";
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
		</table><br>
	</div>
	<form action="companyReport.php" id="company_data" method="post">
		<input type='hidden' name='company' value='<?php echo $company;?>'/> 
		<input type='hidden' name='fromdate' value='<?php echo $fromdate;?>'/> 
		<input type='hidden' name='todate' value='<?php echo $todate;?>'/> 
		<input class="submit_button" type="submit" id="submit_id" name="submit" value="Generate Report" /><br>
	</form>	
	<h4><a href="index.php">&laquo; Back to Main Page</a></h4>
</div>	
<?php include("/includes/layout/footer.php");?>