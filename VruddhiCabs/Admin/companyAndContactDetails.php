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
		$required_fields = array("company","poc","contact","email");
		validate_presences($required_fields);
		$alpha_fields = array("poc");
		validate_for_alphabets($alpha_fields);
		$number_fields = array("contact");
		validate_for_numerals($number_fields);
		
		if(empty($errors)){
			$company = $_POST['company'];
			$poc = $_POST['poc'];
			$contact = $_POST['contact'];
			$email = $_POST['email'];
			$attempt_company_insert = company_details_insert($company,$poc,$contact,$email);
		}	
	}
?>
<div class="page_content">
	<h3>Insert Company Data</h3>
	<div class="admin_passenger_panel">
	<div class="message_panel">
	 <?php 
	 	echo message();
		echo form_errors($errors);	
	 ?>
	 </div><br>
		<form action="companyAndContactDetails.php" id="company_data" method="post">
			<table>
				<tr><td>Company:</td><td><input type="text" title="Company" name="company" value=""/></td></tr>
				<tr><td>Point of Contact:</td><td><input type="text" title="Point of Contact" name="poc" value=""/></td></tr>
				<tr><td>Contact:</td><td><input type="text" title="Contact" name="contact" value=""/></td></tr>
				<tr><td>Email ID:</td><td><input type="text" title="Email ID" name="email" value=""/></td></tr>
			</table><br>	
			<input class="submit_button" type="submit" id="submit_id" name="submit" value="Submit" />
		</form>
	</div>
	
	<div class="admin_logistics_panel">
		<?php 
			global $connection;
			if($connection){
				$query = 'select * from company_contract';
				$company_list = mysqli_query($connection, $query);
				
		?>	
		<table class="table_style">
			<tr><th>ID</th><th>Company</th><th>Point of Contact</th><th>Phone</th><th>Email ID</th></tr>
		<?php 
			while($rows=mysqli_fetch_assoc($company_list)){
				echo "<tr>";
				echo "<td><a href=\"editCompanyDetails.php?id=".$rows["id"]."\">" . $rows["id"] . "</a></td>";
				echo "<td>". $rows["company"]. "</td>";
				echo "<td>" .$rows["poc"]."</td>";
				echo "<td>" .$rows["contact"] . "</td>";
				echo "<td>" .$rows["email"] . "</td>";
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