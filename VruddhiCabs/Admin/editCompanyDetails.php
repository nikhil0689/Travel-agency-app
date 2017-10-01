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
$company = "";
$contact = "";
$email = "";
	if(isset($_POST['submit'])){
		$id = $_POST["id"];
		$company = $_POST["company"];
		$poc = $_POST["poc"];
		$contact = $_POST["contact"];
		$email = $_POST["email"];
		$required_fields = array("company","poc","contact","email");
		validate_presences($required_fields);
		$alpha_fields = array('poc');
		validate_for_alphabets($alpha_fields);
		$number_fields = array('contact');
		validate_for_numerals($number_fields);
		
		if(empty($errors)){
			$attempt_company_update = update_company_details($id,$company,$poc,$contact,$email);
			if($attempt_company_update){
				redirect_to("companyAndContactDetails.php");
			}else{
				$_SESSION["message"] = "Company Data Update failed";
			}
		}	
	}elseif (isset($_POST['delete'])){
		$id = $_POST["id"];
		$attempt_company_delete = company_delete($id);
		if($attempt_company_delete){
			redirect_to("companyAndContactDetails.php");
		}else{
			$_SESSION["message"] = "Company Data not deleted";
		}
	}
?>


<?php
	$id = $_GET["id"];
	$retrieve_company_details = company_details($id);
	$company = $retrieve_company_details["company"];
	$poc = $retrieve_company_details["poc"];
	$contact = $retrieve_company_details["contact"];
	$email = $retrieve_company_details["email"];
?>	
<div class="page_content">
	<div align="center">
		<h3>Company Details</h3>
		<div>
			<div class="message_panel">
			 <?php 
			 	echo message();
				echo form_errors($errors);	
			 ?>
			 </div>
			<br>
			<form action="editCompanyDetails.php?id=<?php echo $id;?>" method="post">
				<table>
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<tr><td>Company:</td><td><input type="text" name="company" value="<?php echo $company;?>"></td></tr> 
					<tr><td>Point of Contact:</td><td><input type="text" name="poc" value="<?php echo $poc;?>"></td></tr> 
					<tr><td>Contact:</td><td><input type="text" name="contact" value="<?php echo $contact;?>"></td></tr>
					<tr><td>Email ID:</td><td><input type="text" name="email" value="<?php echo $email;?>"></td></tr>
				</table><br>
				<input class="submit_button_table" type="submit" id="submit" name="submit" value="Update" />
				<input class="submit_button_table" type="submit" id="delete" name="delete" value="Delete" />
			</form>
		</div><pre><br></pre>
		<a href="index.php">Back to Main Page</a>
	</div>	
</div>
<?php include ("/includes/layout/footer.php");?>