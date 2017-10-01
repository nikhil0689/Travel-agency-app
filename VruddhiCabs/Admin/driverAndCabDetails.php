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
	$driverName = "";
	$vehicleNumber = "";
	$contact = "";
	
	if(isset($_POST['submit'])){
		$required_fields = array("driverName","vehicleNumber","contact");
		validate_presences($required_fields);
		$alpha_fields = array("driverName");
		validate_for_alphabets($alpha_fields);
		$number_fields = array("contact");
		validate_for_numerals($number_fields);
		
		if(empty($errors)){
			$driverName = $_POST['driverName'];
			$vehicleNumber = $_POST['vehicleNumber'];
			$contact = $_POST['contact'];
			$attempt_driver_insert = driver_details_insert($driverName,$vehicleNumber,$contact);
		}	
	}
?>
<div class="page_content">
	<h3>Insert Driver Data</h3>
	<div class="admin_passenger_panel">
	 <div class="message_panel">
	 <?php 
	 	echo message();
		echo form_errors($errors);	
	 ?>
	 </div><br>
		<form action="driverAndCabDetails.php" id="driver_data" method="post">
			<table>
				<tr><td>Driver Name:</td><td><input type="text" title="Driver Name" name="driverName" value=""/></td></tr>
				<tr><td>Vehicle Number:</td><td><input type="text" title="Vehicle Number" name="vehicleNumber" value=""/></td></tr>
				<tr><td>Contact:</td><td><input type="text" title="Contact" name="contact" value=""/></td></tr>
			</table><br>	
			<input class="submit_button" type="submit" id="submit_id" name="submit" value="Submit" />
		</form>
	</div>
	
	<div class="admin_logistics_panel">
		<?php 
			global $connection;
			if($connection){
				$query = 'select * from driver_cab';
				$reg_list = mysqli_query($connection, $query);
				
		?>	
		<table class="table_style">
			<tr><th>ID</th><th>Name</th><th>Vehicle Number</th><th>Contact</th></tr>
		<?php 
			while($rows=mysqli_fetch_assoc($reg_list)){
				echo "<tr>";
				echo "<td><a href=\"editDriverDetails.php?id=".$rows["id"]."\">" . $rows["id"] . "</a></td>";
				echo "<td>" .$rows["driver_name"]."</td>";
				echo "<td>" .$rows["vehicle_no"] . "</td>";
				echo "<td>". $rows["contact"]. "</td>";
				echo "</tr>";
		}
		}else{
			die("Connection to the database Failed");
		}
		?>
		</table>
	</div><br>
	<a href="index.php">Back to Main Page</a>
</div>	
<?php include ("/includes/layout/footer.php");?>