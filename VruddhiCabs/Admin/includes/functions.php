<?php

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $connection;
		
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}
	
	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div>";
		  $output .= "Please fix the following errors:";
		  //$output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<p>";
				$output .= htmlentities($error);
				$output .= "</p>";
		  }
		  //$output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}
	
	function driver_details_insert($driverName,$vehicleNumber,$contact){
		global $connection;
		$query = "INSERT INTO driver_cab ";
		$query .="(driver_name,vehicle_no,contact) VALUES"; 
		$query .="('$driverName','$vehicleNumber','$contact')";
		$insert_operation = mysqli_query($connection, $query);
		if(mysqli_affected_rows($connection) == 1){
			$_SESSION["message"] = "Data Inserted Successfully";
			return true;			
		}else{
			$_SESSION["message"] = "Data Insertion failed";
			return false;
		}
	}
	
	function retrieve_details($id){
		global $connection;
		$query  = "SELECT * ";
		$query .= "FROM driver_cab ";
		$query .= "WHERE id = '$id'";
		$driver_set = mysqli_query($connection, $query);
		confirm_query($driver_set);
		$driver_details = mysqli_fetch_assoc($driver_set);
		return $driver_details;
	}
	
	function update_driver_details($id,$driverName,$vehicleNo,$contact){
		global $connection;
		$query = "Update driver_cab set driver_name='$driverName', vehicle_no='$vehicleNo' ,contact='$contact'";
		$query .= " where id='$id'";
		$driver_update = mysqli_query($connection, $query);
		confirm_query($driver_update);
		if(mysqli_affected_rows($connection) >= 0){
			$_SESSION["message"] = "Driver Data Updated Successfully";
			return true;
		}
	}
	
	function driver_delete($id){
		global $connection;
		$query = "delete from driver_cab where id='$id'";
		$driver_delete = mysqli_query($connection, $query);
		confirm_query($driver_delete);
		if(mysqli_affected_rows($connection) >= 0){
			$_SESSION["message"] = "Driver deleted";
			return true;
		}
	}
	
	function company_details_insert($company,$poc,$contact,$email){
		global $connection;
		$query = "INSERT INTO company_contract ";
		$query .="(company,poc,contact,email) VALUES";
		$query .="('$company','$poc','$contact','$email')";
		$insert_operation = mysqli_query($connection, $query);
		if(mysqli_affected_rows($connection) == 1){
			$_SESSION["message"] = "Data Inserted Successfully";
			return true;
		}else{
			$_SESSION["message"] = "Data Insertion failed";
			return false;
		}
	}
	
	function company_details($id){
		global $connection;
		$query  = "SELECT * ";
		$query .= "FROM company_contract ";
		$query .= "WHERE id = '$id'";
		$company_set = mysqli_query($connection, $query);
		confirm_query($company_set);
		$company_details = mysqli_fetch_assoc($company_set);
		return $company_details;
	}
	
	function update_company_details($id,$company,$poc,$contact,$email){
		global $connection;
		$query = "Update company_contract set company='$company', poc='$poc' ,contact='$contact',email='$email'";
		$query .= " where id='$id'";
		$company_update = mysqli_query($connection, $query);
		confirm_query($company_update);
		if(mysqli_affected_rows($connection) >= 0){
			$_SESSION["message"] = "Company Data Updated Successfully";
			return true;
		}
	}
	
	function company_delete($id){
		global $connection;
		$query = "delete from company_contract where id='$id'";
		$company_delete = mysqli_query($connection, $query);
		confirm_query($company_delete);
		if(mysqli_affected_rows($connection) >= 0){
			$_SESSION["message"] = "Company Details deleted";
			return true;
		}
	}
	
	function get_details_of_driver(){
		global $connection;
		$query = "SELECT driver_name,vehicle_no FROM driver_cab";
		$driver_set = mysqli_query($connection, $query);
		return $driver_set;
	}
	
	function get_details_of_company(){
		global $connection;
		$query = "SELECT company FROM company_contract";
		$company_set = mysqli_query($connection, $query);
		return $company_set;
	}
	
	function passenger_details_insert($name,$company,$eid,$email,$contact,$dateoftravel,
		$distance,$rpkm,$misc,$tax,$driver,$vehicleno,$dateofinvoice){
		$dateofinvoiceF = date ("Y-m-d", strtotime($dateofinvoice));
		$dateoftravelF = date ("Y-m-d", strtotime($dateoftravel));
		$totalAmt = ($distance*$rpkm)+$misc;	
		$totalAmtWithTax = $totalAmt+($tax/100);
		global $connection;
		$query = "INSERT INTO customer_data ";
		$query .="(cust_name,email,contact,company_name,employee_id,date_of_travel,kilo_ms,rate_per_km,misc,tax,total_amt,driver_name,vehicle_no,date_of_invoice) VALUES";
		$query .="('$name','$email','$contact','$company','$eid','$dateoftravelF',$distance,$rpkm,$misc,$tax,$totalAmtWithTax,'$driver','$vehicleno','$dateofinvoiceF')";
		$insert_operation = mysqli_query($connection, $query);
		if(mysqli_affected_rows($connection) == 1){
			$_SESSION["message"] = "Customer Data Inserted Successfully";
			return true;
		}else{
			$_SESSION["message"] = "Data Insertion failed";
			return false;
		}
	}
	
	function passenger_details($id){
		global $connection;
		$query  = "SELECT * ";
		$query .= "FROM customer_data ";
		$query .= "WHERE invoice_no = '$id'";
		$passenger_set = mysqli_query($connection, $query);
		confirm_query($passenger_set);
		$passenger_details = mysqli_fetch_assoc($passenger_set);
		if($passenger_details != null){
			return $passenger_details;
		}
	}
	
	function passenger_details_update($invoiceno,$name,$company,$eid,$email,$contact,$dateoftravel,
					$distance,$rpkm,$misc,$tax,$totalamt,$driver,$vehicleno,$dateofinvoice,$paymentStatus,$paymentMode){
		$dateofinvoiceF = date ("Y-m-d", strtotime($dateofinvoice));
		$dateoftravelF = date ("Y-m-d", strtotime($dateoftravel));
		global $connection;
		$query = "Update customer_data set cust_name='$name', email='$email' ,contact='$contact',company_name='$company',";
		$query .= "employee_id='$eid',date_of_travel='$dateoftravelF',kilo_ms='$distance',rate_per_km='$rpkm',misc='$misc',tax='$tax',total_amt='$totalamt',";
		$query .= "driver_name='$driver',vehicle_no='$vehicleno',date_of_invoice='$dateofinvoiceF',payment_status='$paymentStatus',payment_mode='$paymentMode'";
		$query .= " where invoice_no='$invoiceno'";
		$company_update = mysqli_query($connection, $query);
		confirm_query($company_update);
		if(mysqli_affected_rows($connection) >= 0){
			$_SESSION["message"] = "Passenger Data Updated Successfully";
			return true;
		}
	}
	
	function check_invoices($invoiceNo){
		global $connection;
		$query  = "SELECT * ";
		$query .= "FROM customer_data ";
		$query .= "WHERE invoice_no = '$invoiceNo'";
		$invoice_set = mysqli_query($connection, $query);
		confirm_query($invoice_set);
		$invoice_details = mysqli_fetch_assoc($invoice_set);
		if($invoice_details == null){
			$_SESSION["message"] = "Invoice not found";
			redirect_to("searchByInvoice.php");
		}else{
			return true;
		}
	}
	
	function login_data($username,$password){
		global $connection;
		$query  = "SELECT * from admin";
		$admin_set = mysqli_query($connection, $query);
		confirm_query($admin_set);
		$admin_details = mysqli_fetch_assoc($admin_set);
		if($admin_details["username"] == $username && $admin_details["password"] == $password){
			$_SESSION["user"] = $username;
			return true;
		}else{
			$_SESSION["message"] = "Username/Password do not match";
			return false;
		}
	}
	
	function logged_in() {
		return isset($_SESSION['user']);
	}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			return false;
		}else{
			return true;
		}
	}

?>

