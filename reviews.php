<?php 
include 'getReview.php';

$ratings = getReviews(1,"nirbhay");
http_response_code(200);
header("Content-Type: application/json");
echo json_encode($ratings);
?> 