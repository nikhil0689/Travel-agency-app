<?php 
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "admin");
	define("DB_NAME", "vruddhicabs");
	$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	if(mysqli_connect_errno()){
		die("Data connection failed". mysqli_connect_error()."(". mysqli_connect_errno().")" );
	}else{
		
	}
?>