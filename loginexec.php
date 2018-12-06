<?php
	//Start session
	session_start();
	ob_start();

	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	
	$host = 'yashkumarmahajan65715.ipagemysql.com'; 
	$user = 'dbadmin';
	$pass = 'dbadmin';
	$db = 'cmpe272marketplace';

    $link=mysqli_connect($host,$user,$pass, $db);
    
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}

	//Sanitize the POST values
	$login = $_POST['username'];
	$password = $_POST['password'];
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	
	
	//Create query
	$qry="SELECT * FROM users WHERE username='$login' AND password='$password'";
	echo "$qry";
	$result=$link->query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if($result->num_rows == 1) {
			//Login Successful
			session_regenerate_id();
			$member = $result->fetch_assoc();
			
			// echo "<pre>".print_r($member); echo "</pre>";

			$_SESSION['SESS_USER_ID'] = $member['username'];
			$_SESSION['SESS_USER_FNAME'] = $member['firstname'];
			$_SESSION['SESS_USER_LNAME'] = $member['lastname'];
			
			// echo "<br>Session : ".$_SESSION['SESS_FIRST_NAME'];
            session_write_close();
            echo "login successful!!";
			header('location: index.php');
		}else {
			//Login failed
			$errmsg_arr[] = 'Wrong username or password';
			$errflag = true;
			header("location: loginform.php");
			echo "login Failed!!";
		}
	}else {
		die("Query failed");
	}

	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        echo "error happened!";
		header("location: loginform.php");
		exit();
	}

	ob_end_flush();
?>