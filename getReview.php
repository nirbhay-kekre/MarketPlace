<?php 
function getReviews($productId, $from){
    $conn = new mysqli('yashkumarmahajan65715.ipagemysql.com', 'dbadmin', 'dbadmin', 'cmpe272marketplace');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = 'SELECT firstname, lastname, rating, textReview FROM productReviews where productId="'.$productId.'" AND owner="'.$from.'"';

    $ratings = array();
    $ratings["ratings"] = array();
    $result = $conn->query($sql);
    $avgRating = 0;
    $ratings["fiveStars"] = 0;
    $ratings["fourStars"] = 0;
    $ratings["threeStars"] = 0;
    $ratings["twoStars"] = 0;
    $ratings["oneStars"] = 0;
    $ratings["totalRatings"] = 0;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        // echo " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            $review = array(
                "firstname" => $row["firstname"],
                "lastname" => $row["lastname"],
                "rating" => $row["rating"],
                "textReview" => $row["textReview"]
            );
            array_push($ratings["ratings"], $review);
            $avgRating +=$row["rating"];
            if(5 == floor($row["rating"]))
                $row["fiveStars"] +=1;
            elseif(4 == floor($row["rating"]))
                $ratings["fourStars"] +=1;
            elseif(3 == floor($row["rating"]))
                $ratings["threeStars"] +=1;
            elseif(2 == floor($row["rating"]))
                $ratings["twoStars"] +=1;
            elseif(1 == floor($row["rating"]))
                $ratings["oneStars"] +=1;
        }
        $avgRating /= $result->num_rows;
        $ratings["totalRatings"] = $result->num_rows;
    }
    $conn->close();
    $ratings["avgRating"]= $avgRating;
    return $ratings;
}
?>