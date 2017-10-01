<?php require_once("/includes/session.php"); ?>
<?php require_once("/includes/dbconnection.php"); ?>
<?php require_once("/includes/functions.php"); ?>
<?php require_once("/includes/validation.php"); ?>
<?php include ("/includes/layout/header.php");?>
<?php 
	if(!confirm_logged_in()){
		redirect_to("login.php");
	}
?>
<div class="page_content">
	<?php echo form_errors($errors);?>
	<?php echo message(); ?>
	<div class="admin_passenger_panel">
		<ul style="list-style: none;">
			<li><a class="alink" href="insertPassengerData.php">Insert Passenger Data</a></li>
			<li><a class="alink" href="searchByInvoice.php">Search by Invoice No.</a></li>
			<li><a class="alink" href="searchAllData.php">Search all Data</a></li>
			<li><a class="alink" href="searchByDates.php">Search Transaction between dates</a></li>
		</ul>
	</div>
	
	<div class="admin_logistics_panel">
		<ul style="list-style: none;">
			<li><a class="alink" href="searchTransactionForCompany.php">Search Transaction between dates for a company</a></li>
			<li><a class="alink" href="companyAndContactDetails.php">Company and contact Details</a></li>
			<li><a class="alink" href="driverAndCabDetails.php">Driver and Cab details</a></li>
		</ul>
	</div>
</div>
<?php include ("/includes/layout/footer.php");?>