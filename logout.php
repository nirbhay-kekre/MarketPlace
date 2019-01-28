<?php
	//Start session
	session_start();
	ob_start();
	//Unset the variables stored in session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_USER_FNAME']);
	unset($_SESSION['SESS_USER_LNAME']);
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time()-1000);
			setcookie($name, '', time()-1000, '/');
		}
	}
    header("location: loginform.php");
    ob_end_flush();
?>
