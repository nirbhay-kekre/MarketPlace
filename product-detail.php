<?php 
session_start();
require 'auth.php';
$id = $_GET['id'];
$from = $_GET['from'];

  if($id && $from){
	  $recentFive = $_COOKIE["recentFive"];
	  if($recentFive ==null  || !$recentFive){
		  $recentFive=array();
	  } else{
		  $recentFive=json_decode($recentFive);
	  }
	  array_push($recentFive, json_encode(array("id" => $id, "from" => $from)));
	  $recentFive = array_unique($recentFive);
	  $recentFive = array_slice($recentFive, -5,5);
  }
	setcookie("recentFive",json_encode($recentFive) , time() + (30 * 24 * 60 * 60), "/", "sinnonyms.ml");
	
if(isset($_GET['from']))
{
	$curl = curl_init();
	// echo $from;

	function getProductsFromAkshay() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://akshayjaiswal.me/getproductbyid.php?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
		return $product;
	}

	function getProductsFromNirbhay() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://nirbhaykekre.com/book.php?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		echo $resp;
		$product = json_decode($resp, true);
		return $product;
	}
	function getProductsFromTapan() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://www.tapanhere.com/wp-json/products/productsinfo?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
		return $product;
	}
	function getProductsFromYash() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://yashmahajan.com/getProductsById.php?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
		return $product;
	}

	if($_GET['from'] == "akshay")
	{
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://akshayjaiswal.me/getproductbyid.php?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
	}

	if($_GET['from'] == "nirbhay")
	{
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://nirbhaykekre.com/book.php?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
	}

	if($_GET['from'] == "tapan")
	{
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://www.tapanhere.com/wp-json/products/productsinfo?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
	}

	if($_GET['from'] == "yash")
	{
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://yashmahajan.com/getProductsById.php?id[]='."$id",
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
	}
	
	if (curl_error($curl)) 
	{
		$error_msg = curl_error($curl);
		echo $error_msg;
	}
	$productJSON = json_encode($product[0]);


	// $reviewJSON = json_encode($reviews[0]);

	// echo $productJSON;
  setcookie("url",$_COOKIE["url"].",".$_SERVER['REQUEST_URI'],time()+60*60);
  setcookie("product",$_COOKIE["product"]."; $productJSON",time()+60*60);


  include 'getReview.php';
  $ratings = getReviews($id,$from);

  include 'rooturl.php';
  $rooturl = getRootURL();
// }
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Store Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="css/StarRating.css">
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	
	<!-- FOR IE9 below -->

	
	<meta name="google-signin-client_id" content="853555902851-6pavsf9g93rgo2fgm4gesprkhsf2p0bn.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
	</head>
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
		<?php include 'header.php';?>
		<aside id="colorlib-hero" class="breadcrumbs">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/productbanner.png);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h1>Product Detail</h1>
				   					<h2 class="bread"><span><a href="index.php">Home</a></span> <span><a href="shop.php?from=all">Product</a></span> <span>Product Detail</span></h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>

		<div class="colorlib-shop">
			<div class="container">

				<?php
				// if(isset($_GET['id']))
				// {
					// $curl = curl_init();
					// $id = $_GET['id'];
					// curl_setopt_array($curl, array(
					// 	CURLOPT_RETURNTRANSFER => 1,
					// 	CURLOPT_URL => 'http://akshayjaiswal.me/getproductbyid.php?id='."$id",
					// 	CURLOPT_USERAGENT => 'Codular Sample cURL Request'
						
					// ));
			
					// $resp = curl_exec($curl);
					// $product = json_decode($resp, true);
					// if (curl_error($curl)) 
					// {
					// 	$error_msg = curl_error($curl);
					// 	echo $error_msg;
					// }
					

				echo '<div class="row row-pb-lg">';
				echo '<div class="col-md-10 col-md-offset-1">';
					echo '<div class="product-detail-wrap">';
						echo '<div class="row">';
							echo '<div class="col-md-5">';
								echo '<div class="product-entry">';
									echo '<div class="product-img" style="background-image: url('."{$product[0]['URL']}".');">';
										echo '<p class="tag"><span class="sale">Sale</span></p>';
										echo '</div>';
											echo '<div class="thumb-nail">';
											echo '<a href="#" class="thumb-img" style="background-image: url('."{$product[0]['url_2']}".');"></a>';
											echo '<a href="#" class="thumb-img" style="background-image: url('."{$product[0]['url_3']}".');"></a>';
											echo '<a href="#" class="thumb-img" style="background-image: url('."{$product[0]['url_4']}".');"></a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-md-7">';
									echo '<div class="desc">';
										echo '<h3>'."{$product[0]['name']}".'</h3>';
										echo '<p class="price">';
											echo '<span>$'."{$product[0]['price']}".'</span> ';
											echo '<span class="rate text-right">';
											$avgRating = $ratings['avgRating'] > 5 ? 5: $ratings['avgRating'];
											$intAvgPart = floor( $avgRating ) ;
											$fractionAvg = $avgRating  - $intAvgPart;
											$fullStarAvg = $intAvgPart;
											$halfStarAvg = $fractionAvg>0?1:0;
											$noStarAvg = 5 - $fullStarAvg - $halfStarAvg;
											for($i=0; $i< $fullStarAvg ; $i++ ){ 
												echo '<i class="icon-star-full"></i>';
											}
											for($i=0; $i< $halfStarAvg ; $i++ ){ 
												echo '<i class="icon-star-half"></i>';
											}
											for($i=0; $i< $noStarAvg ; $i++ ){ 
												echo '<i class="icon-star-empty"></i>';
											}
												
											echo '('.$ratings['totalRatings'].' Ratings)';
											echo '</span>';
											echo '</p>';
										echo '<p>'."{$product[0]['description']}".'</p>';
										// echo '<div class="color-wrap">';
										// echo '<p class="color-desc">';
										// echo 'Color: ';
										// echo '<a href="#" class="color color-1"></a>';
										// echo '<a href="#" class="color color-2"></a>';
										// echo '<a href="#" class="color color-3"></a>';
										// echo '<a href="#" class="color color-4"></a>';
										// echo '<a href="#" class="color color-5"></a>';
										// echo '</p>';
										// echo '</div>';
										// echo '<div class="size-wrap">';
										// echo '<p class="size-desc">';
										// echo 'Size: ';
										// echo '<a href="#" class="size size-1">xs</a>';
										// echo '<a href="#" class="size size-2">s</a>';
										// echo '<a href="#" class="size size-3">m</a>';
										// echo '<a href="#" class="size size-4">l</a>';
										// echo '<a href="#" class="size size-5">xl</a>';
										// echo '<a href="#" class="size size-5">xxl</a>';
										// echo '</p>';
										// echo '</div>';

										echo '<div class="row row-pb-sm">';
										echo '<div class="col-md-4">';
										echo '<div class="input-group">';
                                    	echo '<span class="input-group-btn">';
										echo '<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">';
										echo '<i class="icon-minus2"></i>';
										echo '</button>';
										echo '</span>';
                                    	echo '<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">';
                                    	echo '<span class="input-group-btn">';
										echo '<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">';
										echo '<i class="icon-plus2"></i>';
                                        echo '</button>';
                                    	echo '</span>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '<p><a href="cart.php?from='."{$product[0]['from']}".'&id='."{$product[0]['id']}".'&url='."{$product[0]['URL']}".'&name='."{$product[0]['name']}".'&price='."{$product[0]['price']}".'" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i> Add to Cart</a></p>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
				// }
				?>

				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-12 tabulation">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#review">Reviews</a></li>
									<li><a data-toggle="tab" href="#description">Description</a></li>
									<li><a data-toggle="tab" href="#manufacturer">Manufacturer</a></li>
								</ul>
								<div class="tab-content">
									<div id="description" class="tab-pane fade  ">
										<p><?php echo "{$product[0]['description']}" ?></p>
										<ul>
											<li>The Big Oxmox advised her not to do so</li>
											<li>Because there were thousands of bad Commas</li>
											<li>Wild Question Marks and devious Semikoli</li>
											<li>She packed her seven versalia</li>
											<li>tial into the belt and made herself on the way.</li>
										</ul>
						         </div>
						         <div id="manufacturer" class="tab-pane fade">
						         	<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
										<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
								      
								   </div>
								   <div id="review" class="tab-pane fade in active">
								   	<div class="row">
								   		<div class="col-md-7">
											<h3><?php echo sizeof($ratings["ratings"])?> Reviews</h3>
											<?php
												foreach($ratings["ratings"] as $review)
												{
													$review['rating'] = $review['rating'] > 5 ? 5: $review['rating'];
													$intpart = floor( $review['rating'] ) ;
													$fraction = $review['rating']  - $intpart;
													$fullStar = $intpart;
													$halfStar = $fraction>0?1:0;
													$noStar = 5 - $fullStar - $halfStar;
											?>
								   			<div class="review">
										   		<div class="user-img" style="background-image: url(images/default-profile-pic.png)"></div>
										   		<div class="desc">
										   			<h4>
										   				<span class="text-left"><?php echo ($review['firstname']." ".$review['lastname']);?></span>
										   				<span class="text-right">14 March 2018</span>
										   			</h4>
										   			<p class="star">
													   <span>
															<?php 
													   			for($i=0; $i< $fullStar ; $i++ ){ ?>
														   			<i class="icon-star-full"></i>
													   		<? } ?>
															<?php 
													   			for($i=0; $i< $halfStar ; $i++ ){ ?>
														   			<i class="icon-star-half"></i>
													   		<? } ?>
															<?php 
													   			for($i=0; $i< $noStar ; $i++ ){ ?>
														   			<i class="icon-star-empty"></i>
													   		<? } ?>
										   				
									   					</span>
									   					<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
										   			</p>
										   			<p><?php echo "{$review['textReview']}"?></p>
										   		</div>
											</div>
											  <?php 
											  }
											?>

								   		</div>
								   		<div class="col-md-4 col-md-push-1">
								   			<div class="rating-wrap">
												<h3>Give a Review</h3>
												<div clas="container">
												<script>
												async function postRatingToServer(){
													
													
													var firstname = document.forms["postReviewForm"]["firstname"].value;
													var lastname = document.forms["postReviewForm"]["lastname"].value;
													var productId = document.forms["postReviewForm"]["productId"].value;
													var from = document.forms["postReviewForm"]["from"].value;
													var userId = document.forms["postReviewForm"]["userId"].value;
													var textReview = document.forms["postReviewForm"]["textReview"].value;
													var rating = document.getElementById("ratingStars").value;
													console.log({
														firstname,
														lastname,
														productId,
														from,
														userId,
														textReview,
														rating
													});
													let formData = new FormData();
													formData.append("firstname", firstname);
													formData.append("lastname", lastname);
													formData.append("productId", productId);
													formData.append("from", from);
													formData.append("userId", userId);
													formData.append("textReview", textReview);
													formData.append("rating", rating);
													var resp = await fetch(<?php echo "'".$rooturl."/postReview.php'" ?>, {
														method: 'POST',
														body: formData
													});
													debugger;
													console.log({resp});
													window.location.reload();
													return false;//to stop redirecting
												}
												</script>
												<form name="postReviewForm" onsubmit="return postRatingToServer()" action="<?php echo $rooturl?>/product-detail.php?id=<?php echo $id?>&from=<?php echo $from?>">
													<?php
														$userId = $_SESSION['SESS_USER_ID'];
														$firstname = $_SESSION['SESS_USER_FNAME'];
														$lastname = $_SESSION['SESS_USER_LNAME'];
													?>
													<div name="reviewContainer" class="rating">
														<x-star-rating id="ratingStars" name="ratingStars" value="0" number="5" style="font-size: 25px;"></x-star-rating><br>
														<script src="js/StarRating.js"></script>
														<input type="hidden" id="productId" name="productId" value="<?php echo $id?>">
														<input type="hidden" id="from" name="from" value="<?php echo $from?>">
														<input type="hidden" id="userId" name="userId" value="<?php echo $userId?>">
														<input type="hidden" id="firstname" name="firstname" value="<?php echo $firstname?>">
														<input type="hidden" id="lastname" name="lastname" value="<?php echo $lastname?>">
														<textarea name="textReview" id="textReview" row=5 col=20 style="height: auto;"></textarea>   
														
													</div>
													<button type="submit" style="font-size:10px; border-radius:0px;" class="btn btn-primary"><i class="icon-pencil"></i> Submit</button>
												</form>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>

														   <?php 
														   $perc = $ratings['totalRatings']>0 ?($ratings["fiveStars"]/$ratings['totalRatings']):0;
														   $perc *= 100;
														   echo "(".$perc."%)" ?>
								   					</span>
								   					<span><?php echo $ratings["fiveStars"] ?> Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<?php 
														   $perc = $ratings['totalRatings']>0 ?($ratings["fourStars"]/$ratings['totalRatings']):0;
														   $perc *= 100;
														   echo "(".$perc."%)" ?>
								   					</span>
								   					<span><?php echo $ratings["fourStars"] ?> Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<?php 
														   $perc = $ratings['totalRatings']>0 ?($ratings["threeStars"]/$ratings['totalRatings']):0;
														   $perc *= 100;
														   echo "(".$perc."%)" ?>
								   					</span>
								   					<span><?php echo $ratings["threeStars"] ?> Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<?php 
														   $perc = $ratings['totalRatings']>0 ?($ratings["twoStars"]/$ratings['totalRatings']):0;
														   $perc *= 100;
														   echo "(".$perc."%)" ?>
								   					</span>
								   					<span><?php echo $ratings["twoStars"] ?> Reviews</span>
									   			</p>
									   			<p class="star">
									   				<span>
									   					<i class="icon-star-full"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<i class="icon-star-empty"></i>
									   					<?php 
														   $perc = $ratings['totalRatings']>0 ?($ratings["oneStars"]/$ratings['totalRatings']):0;
														   $perc *= 100;
														   echo "(".$perc."%)" ?>
								   					</span>
								   					<span><?php echo $ratings["oneStars"] ?> Reviews</span>
									   			</p>
									   		</div>
								   		</div>
								   	</div>
								   </div>
					         </div>
				         </div>
						</div>
					</div>
				</div>


			</div>
		</div>

		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Similar Products</span></h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(images/item-5.jpg);">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="product-detail.php"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.php"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="shop.php?from=all">Floral Dress</a></h3>
								<p class="price"><span>$300.00</span></p>
							</div>
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(images/item-6.jpg);">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="product-detail.php"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.php"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="shop.php?from=all">Floral Dress</a></h3>
								<p class="price"><span>$300.00</span></p>
							</div>
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(images/item-7.jpg);">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="product-detail.php"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.php"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="shop.php?from=all">Floral Dress</a></h3>
								<p class="price"><span>$300.00</span></p>
							</div>
						</div>
					</div>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(images/item-8.jpg);">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="product-detail.php"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.php"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="shop.php?from=all">Floral Dress</a></h3>
								<p class="price"><span>$300.00</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="colorlib-subscribe">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="col-md-6 text-center">
							<h2><i class="icon-paperplane"></i>Sign Up for a Newsletter</h2>
						</div>
						<div class="col-md-6">
							<form class="form-inline qbstp-header-subscribe">
								<div class="row">
									<div class="col-md-12 col-md-offset-0">
										<div class="form-group">
											<input type="text" class="form-control" id="email" placeholder="Enter your email">
											<button type="submit" class="btn btn-primary">Subscribe</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer id="colorlib-footer" role="contentinfo">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-3 colorlib-widget">
						<h4>About Store</h4>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p>
							<ul class="colorlib-social-icons">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-dribbble"></i></a></li>
							</ul>
						</p>
					</div>
					<div class="col-md-2 colorlib-widget">
						<h4>Customer Care</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="#">Contact</a></li>
								<li><a href="#">Returns/Exchange</a></li>
								<li><a href="#">Gift Voucher</a></li>
								<li><a href="#">Wishlist</a></li>
								<li><a href="#">Special</a></li>
								<li><a href="#">Customer Services</a></li>
								<li><a href="#">Site maps</a></li>
							</ul>
						</p>
					</div>
					<div class="col-md-2 colorlib-widget">
						<h4>Information</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="#">About us</a></li>
								<li><a href="#">Delivery Information</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">Support</a></li>
								<li><a href="#">Order Tracking</a></li>
							</ul>
						</p>
					</div>

					<div class="col-md-2">
						<h4>News</h4>
						<ul class="colorlib-footer-links">
							<li><a href="blog.php">Blog</a></li>
							<li><a href="#">Press</a></li>
							<li><a href="#">Exhibitions</a></li>
						</ul>
					</div>

					<div class="col-md-3">
						<h4>Contact Information</h4>
						<ul class="colorlib-footer-links">
							<li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
							<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
							<li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
							<li><a href="#">yoursite.com</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="copy">
				<div class="row">
					<div class="col-md-12 text-center">
						<p>
							
							<span class="block"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart2" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span> 
							<span class="block">Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a> , <a href="http://pexels.com/" target="_blank">Pexels.com</a></span>
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	<script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>

	</body>
</html>

<?php
}
else
{	
	header("Location: shop.php?from=all");
	echo "ERROR 404 NOT FOUND";
}
?>
