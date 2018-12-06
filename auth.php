<?php
	//Start session
	session_start();
	ob_start();
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_ID']) || (trim($_SESSION['SESS_USER_ID']) == '')) {
		header("location: loginform.php");
		exit();
    }
    ob_end_flush();
?>