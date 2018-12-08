<?php 

function postReview($userId, $firstname, $lastname, $productId, $from, $rating=0, $textReview=""){
    $conn = new mysqli('yashkumarmahajan65715.ipagemysql.com', 'dbadmin', 'dbadmin', 'cmpe272marketplace');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = 'SELECT firstname, lastname, rating, textReview FROM productReviews where productId="'.$productId.'" AND owner="'.$from.'" AND userID="'.$userId.'"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $sql = 'UPDATE  productReviews SET  
                 rating = "'.$rating.'", textReview = "'.$textReview.'" where productId="'.$productId.'" AND owner="'.$from.'" AND userID="'.$userId.'"';
    } else {
        $sql = 'INSERT INTO  productReviews (userId, owner, productId, firstname, lastname, rating, textReview) VALUES 
                ("'.$userId.'", "'.$from.'", "'.$productId.'", "'.$firstname.'", "'.$lastname.'", "'.$rating.'", "'.$textReview.'")';
    }
    $result = $conn->query($sql);
    $conn->close();
    echo $result;
    return $result;
}
extract($_POST);

if($userId && $firstname && $lastname && $productId && $from){
    postReview($userId, $firstname, $lastname, $productId, $from, $rating, $textReview);
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode("Successful");
}else{
    //postReview($userId, $firstname, $lastname, $productId, $from, $rating, $textReview);
    $str = $userId."##".$firstname."##".$lastname."##".$productId."##".$from."##".$rating."##".$textReview;
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode($str);
}
?>