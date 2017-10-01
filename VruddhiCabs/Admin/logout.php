<?php require_once("/includes/session.php"); ?>
<?php require_once("/includes/functions.php"); ?>

<?php
	// v1: simple logout
	// session_start();
	session_destroy();
	$_SESSION["user"] = null;
	redirect_to("login.php");
?>

<?php
	// v2: destroy session
	// assumes nothing else in session to keep
	// session_start();
	// $_SESSION = array();
	// if (isset($_COOKIE[session_name()])) {
	//   setcookie(session_name(), '', time()-42000, '/');
	// }
	
	// redirect_to("login.php");
?>
