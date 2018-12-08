<?php 

extract($_POST);
$username = $_POST['username'];
$password = $_POST['password'];

function checkUser($username, $password){

    $conn = new mysqli('yashkumarmahajan65715.ipagemysql.com', 'dbadmin', 'dbadmin', 'cmpe272marketplace');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = 'SELECT * FROM users where username="'.$username.'" AND password="'.$password.'"';
    $result = $conn->query($sql);
    $user = null;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $user = array(
                    "username" => $row["username"],
                    "firstname" => $row["firstname"],
                    "lastname" => $row["lastname"],
                    "status" => "true"
                );
            }
    }
    else {
          $user = array(
            "status" => "false"
        );
    }
    
    print_r(serialize($user));
    $conn->close();
    return $user;
}

checkUser($username,$password);

?>