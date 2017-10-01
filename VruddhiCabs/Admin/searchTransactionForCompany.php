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
if(isset($_POST['submit'])){
	$required_fields = array("fromdate","todate");
	validate_presences($required_fields);
	if(empty($errors)){
		$fromDate = $_POST["fromdate"];
		$company = $_POST["company"];
		$toDate = $_POST["todate"];
		redirect_to("transactionDataforCompany.php?company=".urlencode($company)."&from=".urlencode($fromDate)."&to=".urlencode($toDate));
	}
}
?>
<div class="page_content">
	<div align="center"> 
		<div class="message_panel">
		 <?php 
		 	echo message();
			echo form_errors($errors);	
		 ?>
		 </div>
		<h3>Search Transactions for Company</h3>
		<form action="searchTransactionForCompany.php" id="date_data" method="post">
			<table>
				<tr><td>Company:</td>
					<?php $company_set = get_details_of_company();?>
				<td>
					<select class="drop_down" name="company">
						<?php 
							while ($row = mysqli_fetch_array($company_set)){
							    echo "<option value=".$row['company'].">".$row['company']."</option>";
							}
						?>      
					</select>
				</td>	
				<tr><td>From Date:</td><td><input type="text" id="datepicker" title="From Date" name="fromdate" value=""/></td></tr>
				<tr><td>To Date:</td><td><input type="text" id="datepicker2" title="To Date" name="todate" value=""/></td></tr>
			</table><br>	
			<input class="submit_button" type="submit" id="submit_id" name="submit" value="Submit" />
			
		</form>	<br>
		<a href="index.php">Back to Main Page</a>
	</div>	
</div>
<?php include("/includes/layout/footer.php");?>