<?php require_once("/includes/session.php"); ?>
<?php require_once("/includes/dbconnection.php"); ?>
<?php require_once("/includes/functions.php"); ?>
<?php require_once("/includes/validation.php"); ?>
<?php include("/includes/mpdf/mpdf.php"); ?>
<?php include ("/includes/layout/header.php");?>
<?php 
	if(!confirm_logged_in()){
		redirect_to("login.php");
	}
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
	
	if(isset($_POST['submit'])){
		$vehicleno = $_POST["vehicleno"];
		$required_fields = array("name","contact","email","dateoftravel","distance","rpkm","misc","tax","driver","vehicleno","dateofinvoice");
		validate_presences($required_fields);
		$alpha_fields = array("name","driver");
		validate_for_alphabets($alpha_fields);
		$number_fields = array("contact");
		validate_for_numerals($number_fields);
		$tax_field = array("tax","distance","rpkm","misc");
		validate_for_tax($tax_field);
		
		if(empty($errors)){
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
			$driver = $_POST["driver"];
			$vehicleno = $_POST["vehicleno"];
			$dateofinvoice = $_POST["dateofinvoice"];
			$attempt_passenger_insert = passenger_details_insert($name,$company,$eid,$email,$contact,$dateoftravel,
					$distance,$rpkm,$misc,$tax,$driver,$vehicleno,$dateofinvoice);
			if($attempt_passenger_insert){
				redirect_to("index.php");
			}
		}	
	}
?>
<div class="page_content2">
<h3>Insert Passenger Data</h3>
	<div class="message_panel">
	 <?php 
	 	echo message();
		echo form_errors($errors);	
	 ?>
	 </div>
	<form action="insertPassengerData.php" id="passenger_data" method="post">
		<div class="admin_passenger_panel">
		<table>
			<tr><td>Name:</td><td><input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"></td></tr>
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
			<tr><td>Employee ID:</td><td><input type="text" name="eid" value="<?php echo isset($_POST['eid']) ? $_POST['eid'] : '' ?>"></td></tr>
			<tr><td>Email ID:</td><td><input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"></td></tr> 
			<tr><td>Contact:</td><td><input type="text" name="contact" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : '' ?>"></td></tr>
			<tr><td>Date of Travel:</td><td><input type="text" name="dateoftravel" id="datepicker" value="<?php echo isset($_POST['dateoftravel']) ? $_POST['dateoftravel'] : '' ?>"></td></tr>
		</table>
		</div>
		<div class="admin_logistics_panel">
		<table>
			<tr><td>Distance:</td><td><input type="text" name="distance" value="<?php echo isset($_POST['distance']) ? $_POST['distance'] : '' ?>"></td></tr>
			<tr><td>Rate per KM:</td><td><input type="text" name="rpkm" value="<?php echo isset($_POST['rpkm']) ? $_POST['rpkm'] : '' ?>"></td></tr>
			<tr><td>Misc Charges:</td><td><input type="text" name="misc" value="<?php echo isset($_POST['misc']) ? $_POST['misc'] : '' ?>"></td></tr>
			<tr><td>Tax:</td><td><input type="text" name="tax" value="<?php echo isset($_POST['tax']) ? $_POST['tax'] : '' ?>"></td></tr>
			<tr><td>Driver Name:</td>
				<?php $driver_set = get_details_of_driver();?>
				<td>
					<select class="drop_down" name="driver">
						<?php 
							while ($row = mysqli_fetch_array($driver_set)){
							    echo "<option value=".$row['driver_name'].">".$row['driver_name']."</option>";
							}
						?>      
					</select>
				</td>
			</tr>
			<tr><td>Vehicle:</td>
				<?php $vehicle_set = get_details_of_driver(); ?>
				<td>
					<select class="drop_down" name="vehicleno">
						<?php 
							while ($row = mysqli_fetch_array($vehicle_set)){
							    echo "<option value=".$row['vehicle_no'].">".$row['vehicle_no']."</option>";
							}
						?>      
					</select>
				</td>
			</tr>
			<tr><td>Date of Invoice:</td><td><input type="text" name="dateofinvoice" value="<?php echo date("d/m/y")?>"></td></tr>
		</table><br>
		<input class="submit_button" type="submit" name="submit" value="Submit" />
		</div>
	</form>
<h4><a href="index.php">&laquo; Back to Main Page</a></h4>
</div>
<?php include ("/includes/layout/footer.php");?>