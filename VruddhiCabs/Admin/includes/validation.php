<?php

$errors = array();

function fieldname_as_text($fieldname) {
  $fieldname = str_replace("_", " ", $fieldname);
  $fieldname = ucfirst($fieldname);
  return $fieldname;
}

// * presence
// use trim() so empty spaces don't count
// use === to avoid false positives
// empty() would consider "0" to be empty
function has_presence($value) {
	return isset($value) && $value !== "";
}

function validate_presences($required_fields) {
  global $errors;
  foreach($required_fields as $field) {
    $value = trim($_POST[$field]);
  	if (!has_presence($value)) {
  		$errors[$field] = fieldname_as_text($field) . " can't be blank";
  	}
  }
}

function validate_for_alphabets($alpha_fields){
	global $errors;
  	foreach($alpha_fields as $field) {
    $value = trim($_POST[$field]);
  	if (!preg_match("/^[a-zA-Z ]*$/",$value)) {
			$errors[$field] = fieldname_as_text($field) . " can't have numerals or Special Characters";
		}
  	}
}

function validate_for_numerals($number_fields){
	global $errors;
	foreach($number_fields as $field) {
		$value = trim($_POST[$field]);
		if (!preg_match("/^[1-9][0-9]*$/",$value) && $value != null) {
			$errors[$field] = fieldname_as_text($field) . " can't have Alphabets";
		}
	}
}

function validate_for_tax($tax_field){
	global $errors;
	foreach($tax_field as $field) {
		$value = trim($_POST[$field]);
		if (!is_numeric($value)) {
			$errors[$field] = fieldname_as_text($field) . " should be Numeric";
		}
	}
}

function validate_passwords($password,$confirmpassword){
	global $errors;
	if(!($password == $confirmpassword)){
		$errors[$password] = fieldname_as_text($password) . "s do not match";
	}
}

function validate_email($email_id){
	global $errors;
	global $connect;
	if($connect){
		$sql  = "SELECT * FROM Users";
		$user_set = odbc_exec($connect, $sql);
		if($user = odbc_fetch_array($user_set)){
			$email_id = $user["usersIdent"];
			return true;
		}
	}else{
		die("Database Connection failed");
	}
	
	
}

?>
