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
<?php 
$id = "";
$driverName = "";
$vehicleNo = "";
$contact = "";
	if(isset($_POST['submit'])){
		$id = $_POST["id"];
		$driverName = $_POST["drivername"];
		$vehicleNo = $_POST["vehicleno"];
		$contact = $_POST["contact"];
		$required_fields = array("drivername","vehicleno","contact");
		validate_presences($required_fields);
		$alpha_fields = array('drivername');
		validate_for_alphabets($alpha_fields);
		$number_fields = array('contact');
		validate_for_numerals($number_fields);
		
		if(empty($errors)){
			$attempt_driver_update = update_driver_details($id,$driverName,$vehicleNo,$contact);
			if($attempt_driver_update){
				redirect_to("driverAndCabDetails.php");
			}else{
				$_SESSION["message"] = "Driver Data Update failed";
			}
		}	
	}elseif (isset($_POST['delete'])){
		$id = $_POST["id"];
		$attempt_driver_delete = driver_delete($id);
		if($attempt_driver_delete){
			redirect_to("driverAndCabDetails.php");
		}else{
			$_SESSION["message"] = "Driver Data not deleted";
		}
	}
?>


<?php
	$id = $_GET["id"];
	$retrieve_driver_details = retrieve_details($id);
	$driverName = $retrieve_driver_details["driver_name"];
	$vehicleNo = $retrieve_driver_details["vehicle_no"];
	$contact = $retrieve_driver_details["contact"];
?>	
<div class="page_content">
	<div align="center">
		<h3>Driver Details</h3>
		<div class="message_panel">
		 <?php 
		 	echo message();
			echo form_errors($errors);	
		 ?>
		 </div>
		<form action="editDriverDetails.php?id=<?php echo $id;?>" method="post">
			<table>
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<tr><td>Name:</td><td><input type="text" name="drivername" value="<?php echo $driverName;?>"></td></tr> 
				<tr><td>Vehicle:</td><td><input type="text" name="vehicleno" value="<?php echo $vehicleNo;?>"></td></tr> 
				<tr><td>Contact:</td><td><input type="text" name="contact" value="<?php echo $contact;?>"></td></tr>
			</table>
			<input class="submit_button_table" type="submit" id="submit" name="submit" value="Update" />
					<input class="submit_button_table" type="submit" id="delete" name="delete" value="Delete" />
		</form><pre><br></pre>
		<a href="index.php">Back to Main Page</a>
	</div>	
</div>
<?php include ("/includes/layout/footer.php");?>