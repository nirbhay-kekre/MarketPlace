<?php 
    extract($_POST);
    header("location: product-detail.php?id=".$productId."&from=".$from);
?>