<?php
	//Start session
	session_start();
	ob_start();
	//Include database connection details
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
    
	$host = 'yashkumarmahajan65715.ipagemysql.com'; 
	$user = 'dbadmin';
	$pass = 'dbadmin';
	$db = 'cmpe272marketplace';

	$link=mysqli_connect($host,$user,$pass, $db);

    //Connect to mysql server
    // $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	// print($link);
	
	if(!$link) {
		print('Failed to connect to server: ' . mysqli_error());
    }
    
	//Sanitize the POST values
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$login = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	// Input Validations
	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM users WHERE username='$login'";
		$result = $link->query($qry);
		if($result) {
			if(mysqli_num_rows($result) > 0) {
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			mysqli_free_result($result);
		}
		else {
			die("Query failed");
			$errmsg_arr[] = 'Problem in adding user';
		}
	}
	
	//Create INSERT query
	$qry = "INSERT INTO users(firstname, lastname, username, password) VALUES('$fname','$lname','$login','$password')";
    echo $qry;
    $result =$link->query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("Location: loginform.php?register=true");
	}else {
		die("Query failed");
		$errmsg_arr[] = 'Problem in adding user';
	}

	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        echo "error happened!";
		header("location: registerform.php");
		exit();
	}

	ob_end_flush();
?>