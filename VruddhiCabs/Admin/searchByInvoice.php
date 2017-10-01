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
	$required_fields = array("invoiceno");
	validate_presences($required_fields);
	if(empty($errors)){
		$invoiceNo = $_POST["invoiceno"];
		$check_invoice_availability = check_invoices($invoiceNo);
		if($check_invoice_availability){
			redirect_to("editPassengerData.php?id=$invoiceNo");
		}	
	}
}
?>
<div class="page_content">
 <div align="center"> 
		<h3 align="center">Search by Invoice number</h3>
		<div class="message_panel">
		 <?php 
		 	echo message();
			echo form_errors($errors);	
		 ?>
		 </div><br>
		
		<form action="searchByInvoice.php" id="invoice_data" method="post">
			<table>
				<tr><td>Invoice No:</td><td><input type="text" title="Invoice No." name="invoiceno" value=""/></td></tr>
			</table><br>	
			<input class="submit_button" type="submit" id="submit_id" name="submit" value="Submit" />
		</form>	<br>
		<a href="index.php">Back to Main Page</a>
	</div>	
</div>
<?php include("/includes/layout/footer.php");?>