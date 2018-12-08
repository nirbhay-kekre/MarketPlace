<?php
	//Start session
    session_start();
    $host = 'yashkumarmahajan65715.ipagemysql.com'; 
	$user = 'dbadmin';
	$pass = 'dbadmin';
	$db = 'cmpe272marketplace';

    $link=mysqli_connect($host,$user,$pass, $db);
    
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
    }
    $loginvalue = $_POST['login'];

    // google logic
    $login = $_POST['username'];
	$firstname =  $_POST['firstname'];
    $lastname =  $_POST["lastname"];
    $qry = "SELECT * FROM users WHERE username='$login'";
    $result = $link->query($qry);
    if($result) {
        if($result->num_rows == 0) 
        {
            $qry = "INSERT INTO users(firstname, lastname, username, password) VALUES('$firstname','$lastname','$login','G')";
            echo $qry;
            $insertresult =$link->query($qry);
            
            if($insertresult) 
            {// echo("user not exist session set");
					$_SESSION['SESS_USER_ID'] = $_POST['username'];
					$_SESSION['SESS_USER_FNAME'] = $_POST['firstname'];
					$_SESSION['SESS_USER_LNAME'] = $_POST['lastname'];
					session_write_close();
					// exit("success");
                    //header("location: index.php");
                    http_response_code(200);
                    header("Content-Type: application/json");
                    echo json_encode("Successful");
				}else 
				{
                    print("Query failed!!!");
                    http_response_code(500);
                    header("Content-Type: application/json");
                    echo json_encode("Failed");
					//die("Query failed");
					
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
				http_response_code(200);
                header("Content-Type: application/json");
                echo json_encode("Successful");
			}
		}
?>