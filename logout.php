<?php
	//Start session
	session_start();
	ob_start();
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_USER_FNAME']);
	unset($_SESSION['SESS_USER_LNAME']);
    header("location: loginform.php");
    ob_end_flush();
?>
