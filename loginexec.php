<?php
	//Strt session
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

	// if($_POST['fblogin']!='' || isset($_POST['fblogin']))

	$loginvalue = $_POST['login'];

	switch($loginvalue)
	{
		case "facebook":
			echo "inside facebook";
			$login = $_POST['username'];
			$firstname =  $_POST['firstname'];
			$lastname =  $_POST["lastname"];

			// $password = $_POST['password'];

			$qry = "SELECT * FROM users WHERE username='$login'";
			$result = $link->query($qry);
			if($result) {
				if($result->num_rows == 0) 
				{
					// echo("user not exist");
					$qry = "INSERT INTO users(firstname, lastname, username, password) VALUES('$firstname','$lastname','$login','FB')";
					echo $qry;
					$insertresult =$link->query($qry);
					
					if($insertresult) 
					{
						// echo("user not exist session set");
						$_SESSION['SESS_USER_ID'] = $_POST['username'];
						$_SESSION['SESS_USER_FNAME'] = $_POST['firstname'];
						$_SESSION['SESS_USER_LNAME'] = $_POST['lastname'];
						session_write_close();
						// exit("success");
						header("location: index.php");
					}else 
					{
						print("Query failed!!!");
						die("Query failed");
						$errmsg_arr[] = 'Problem in adding user';
					}
				}
				else
				{
					// echo("user exist");
					$_SESSION['SESS_USER_ID'] = $_POST['username'];
					$_SESSION['SESS_USER_FNAME'] = $_POST['firstname'];
					$_SESSION['SESS_USER_LNAME'] = $_POST['lastname'];
					session_write_close();
					// exit("success");
					header("location: index.php");
				}
			}
			break;
	case "google":
		// echo("user google inside");
		$login = $_POST['username'];
		$firstname =  $_POST['firstname'];
		$lastname =  $_POST["lastname"];

		// $password = $_POST['password'];

		$qry = "SELECT * FROM users WHERE username='$login'";
		$result = $link->query($qry);
		if($result) {
			if($result->num_rows == 0) 
			{
				$qry = "INSERT INTO users(firstname, lastname, username, password) VALUES('$firstname','$lastname','$login','G')";
				echo $qry;
				$insertresult =$link->query($qry);
				
				if($insertresult) 
				{
					// echo("user not exist session set");
					$_SESSION['SESS_USER_ID'] = $_POST['username'];
					$_SESSION['SESS_USER_FNAME'] = $_POST['firstname'];
					$_SESSION['SESS_USER_LNAME'] = $_POST['lastname'];
					session_write_close();
					// exit("success");
					header("location: index.php");
				}else 
				{
					print("Query failed!!!");
					die("Query failed");
					$errmsg_arr[] = 'Problem in adding user';
				}
			}
			else
			{
				// echo("user not exist set session");
				$_SESSION['SESS_USER_ID'] = $_POST['username'];
				$_SESSION['SESS_USER_FNAME'] = $_POST['firstname'];
				$_SESSION['SESS_USER_LNAME'] = $_POST['lastname'];
				session_write_close();
				// exit("success");
				header("location: index.php");
			}
		}
		break;
	case "normal":
		// echo("normal");
		//Sanitize the POST values
		$login = $_POST['username'];
		$password = $_POST['password'];
		
		//Input Validations
		if($login == '') 
		{
			$errmsg_arr[] = 'Login ID missing';
			$errflag = true;
		}

		if($password == '') 
		{
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
				// echo "login successful!!";
				header('location: index.php');
			}else {
				//Login failed
				$errmsg_arr[] = 'Wrong username or password';
				$errflag = true;
				header("location: loginform.php?normalerror");
				echo "login Failed!!";
			}
		}else {
			die("Query failed");
		}

		if($errflag) {
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
			echo "error happened!";
			header("location: loginform.php?normalerror");
			exit();
		}
		break;

	default:
			// echo "DEFAULT!!";
			header("location: loginform.php?default");
	}
	ob_end_flush();
?>