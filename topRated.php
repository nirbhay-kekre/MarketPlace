<?php
    function getTopRatedMarketPlace($limit = 5){
        $conn = new mysqli('yashkumarmahajan65715.ipagemysql.com', 'dbadmin', 'dbadmin', 'cmpe272marketplace');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = 'SELECT  productId, owner, ROUND( avg(rating), 2 ) as avgRating FROM `productReviews` Group by productId, owner order by avgRating desc LIMIT 0 , '.$limit;
        $topRated = array();
        $topRated["akshay"] = array();
        $topRated["tapan"] = array();
        $topRated["yash"] = array();
        $topRated["nirbhay"] = array();
        $topRated["topRated"] = array();

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // echo " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                $top = array(
                    "productId" => $row["productId"],
                    "avgRating" => $row["avgRating"],
                    "from" => $row["owner"]
                );
                array_push($topRated["topRated"], $top);
                array_push($topRated[$row["owner"]], $top);
            }
        }
        $conn->close();
        return $topRated;
    }
    
    function getIndividualTopRated($from, $limit = 5){
        $conn = new mysqli('yashkumarmahajan65715.ipagemysql.com', 'dbadmin', 'dbadmin', 'cmpe272marketplace');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = 'SELECT owner, productId, ROUND( avg( rating ), 2 ) AS avgRating FROM `productReviews` GROUP BY productId HAVING owner = "'.$from.'" ORDER BY avgRating DESC LIMIT 0 , '.$limit;
        $topRated = array();
        $topRated[$from] = array();
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            // echo " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                $top = array(
                    "productId" => $row["productId"],
                    "avgRating" => $row["avgRating"]
                );
                array_push($topRated[$row["owner"]], $top);
            }
        }
        $conn->close();
        return $topRated;
    }
    extract($_GET);
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_encode(getTopRatedMarketPlace());
?>