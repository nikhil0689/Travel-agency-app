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
		$toDate = $_POST["todate"];
		redirect_to("transactionData.php?from=".urlencode($fromDate)."&to=".urlencode($toDate));
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
		<h3>Search Transaction between dates</h3>
		<form action="searchByDates.php" id="date_data" method="post">
			<table>
				<tr><td>From Date:</td><td><input type="text" title="From Date" id="datepicker" name="fromdate" value=""/></td></tr>
				<tr><td>To Date:</td><td><input type="text" title="To Date" id="datepicker2" name="todate" value=""/></td></tr>
			</table><br>	
			<input class="submit_button" type="submit" id="submit_id" name="submit" value="Submit" />
		</form>	<br>
		<a href="index.php">Back to Main Page</a>
	</div>	
</div>
<?php include("/includes/layout/footer.php");?>