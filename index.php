<?php 
{
	session_start();
	require 'auth.php';

	include 'rooturl.php';
	$rooturl = getRootURL();

	include 'topRated.php';
	$topratedarray = getTopRatedMarketPlace();

	$appendstring ="";
	$ratingArr = [];
	function getappendstring($inputarray, $from)
	{

		$appendstring ="";
		foreach($inputarray as $product)
		{
			$appendstring .= "id[]=";
			$appendstring .= $product['productId']."&";
			$GLOBALS['ratingArr'][$from."_".$product['productId']]= $product['avgRating'] ;
		}
		return $appendstring;
	}

	$idarray1 = getappendstring($topratedarray['akshay'], 'akshay');
	$idarray2 = getappendstring($topratedarray['nirbhay'], 'nirbhay');
	$idarray3 = getappendstring($topratedarray['tapan'], 'tapan');
	$idarray4 = getappendstring($topratedarray['yash'], 'yash');

	function getProductsFromAkshay($idarray1) 
	{
		if($idarray1 != '')
		{
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => 'http://akshayjaiswal.me/getproductbyid.php?'.$idarray1,
				CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			));
			$resp = curl_exec($curl);

			$product = json_decode($resp, true);
			return $product;
		}
		else
		{
			echo "return empty";
			return [];
		}
	}

	function getProductsFromNirbhay($idarray2) {
		if($idarray2 != '')
		{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://nirbhaykekre.com/book.php?'.$idarray2,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		// echo $resp;
		$product = json_decode($resp, true);
		return $product;
		}
		else
		{
			return [];
		}
	}

	
	function getProductsFromTapan($idarray3) {
		if($idarray3 != '')
		{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://www.tapanhere.com/wp-json/products/productsinfo?'.$idarray3,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$resp = curl_exec($curl);
		$product = json_decode($resp, true);
		return $product;
		}
		else
		{
			return [];
		}
	}

	function getProductsFromYash($idarray4) {
		if($idarray4 != '')
		{
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => 'http://yashmahajan.com/getProductsById.php?'.$idarray4,
				CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			));
			$resp = curl_exec($curl);
			$product = json_decode($resp, true);
			return $product;
		}
		else
		{
			return [];
		}
	}

	$recentFive = $_COOKIE["recentFive"];
	$recentFive=json_decode($recentFive);

	$recentfiveproducts = [];
	$i = 0;
	echo '<br><pre>';
	print_r($recentFive);
	echo '</pre><br>';
	foreach(array_reverse($recentFive) as $key=>$object)
	{
		echo '<br><pre>';
		print_r($object);
		echo '</pre><br>';

			if($object->from == 'akshay')
			{
				$recentfiveproducts = array_merge($recentfiveproducts, getProductsFromAkshay('id[]='.$object->id));
			}
			else if($object->from == 'nirbhay')
			{
				$recentfiveproducts = array_merge($recentfiveproducts, getProductsFromNirbhay('id[]='.$object->id));
			}
			else if($object->from == 'tapan')
			{
				$recentfiveproducts = array_merge($recentfiveproducts, getProductsFromTapan('id[]='.$object->id));
			}
			else if($object->from == 'yash')
			{
				$recentfiveproducts = array_merge($recentfiveproducts, getProductsFromYash('id[]='.$object->id));
			}
		
	}

	// echo "RECENT PRODUCTS<br>";
	// print_r($recentfiveproducts);
	// echo "<br>RECENT PRODUCTS";

	$recentproducts = array_merge();

	$products = array_merge(getProductsFromAkshay($idarray1), getProductsFromNirbhay($idarray2), getProductsFromYash($idarray4));
	// echo print_r($products);
    $cookieString = substr($_COOKIE["product"],1);
        $cookieArray = explode(";", $cookieString);

        $cookieSize = sizeof($cookieArray);
        $limit = max($cookieSize-5, 0);
}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta name="google-signin-client_id" content="853555902851-6pavsf9g93rgo2fgm4gesprkhsf2p0bn.apps.googleusercontent.com">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sinnonyms Inc.</title>
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

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<!--script src="facebook.js"></script-->
  	<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

	</head>
	<body>
	<div class="colorlib-loader"></div>

	<div id="page">
		<?php include 'header.php';?>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(http://akshayjaiswal.me/images/corsair2banner.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Mechanical</h1>
					   					<h2 class="head-2">Keyboards</h2>
					   					<h2 class="head-3">Collection</h2>
					   					<p class="category"><span>New stylish keyboards &amp; Accessories</span></p>
					   					<p><a href=<?php echo '"'.$rooturl.'/shop.php?from=akshay"'; ?> class="btn btn-primary">Shop Keyboards</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
				<li style="background-image: url(http://nirbhaykekre.com/img/product/harryPotter1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Amazing</h1>
					   					<h2 class="head-2">Books</h2>
					   					<h2 class="head-3">Collection</h2>
					   					<p class="category"><span>New entries in GOT series &amp; More</span></p>
					   					<p><a href="#" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(http://www.tapanhere.com/wp-content/uploads/2017/04/home-2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Huge</h1>
					   					<h2 class="head-2">Sale</h2>
					   					<h2 class="head-3">45% off</h2>
					   					<p class="category"><span>New stylish shirts, pants &amp; Accessories</span></p>
					   					<p><a href="#" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(http://yashmahajan.com/img/bg-img/bg-1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">New</h1>
					   					<h2 class="head-2">Arrival</h2>
					   					<h2 class="head-3">up to 30% off</h2>
					   					<p class="category"><span>New stylish shirts, pants &amp; Accessories</span></p>
					   					<p><a href="#" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
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
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Top rated</span></h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
            <?php
                foreach($products as $product)
                {
            ?>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(<?php echo "{$product['URL']}"; ?>);">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href=<?php echo 'cart.php?from='."{$product['from']}".'&id='."{$product['id']}".'&url='."{$product['URL']}".'&name='."{$product['name']}".'&price='."{$product['price']}"?>><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="product-detail.php"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.php"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div><?php
							$avgRating = $ratingArr[$product["from"]."_".$product['id']] > 5 ? 5: $ratingArr[$product["from"]."_".$product['id']];
											$intAvgPart = floor( $avgRating ) ;
											$fractionAvg = $avgRating  - $intAvgPart;
											$fullStarAvg = $intAvgPart;
											$halfStarAvg = $fractionAvg>0?1:0;
											$noStarAvg = 5 - $fullStarAvg - $halfStarAvg;
											echo '<p class="star" style="
											color: #FFDD00;
											margin-bottom: 0px;
										">';
											for($i=0; $i< $fullStarAvg ; $i++ ){ 
												echo '<i class="icon-star-full"></i>';
											}
											for($i=0; $i< $halfStarAvg ; $i++ ){ 
												echo '<i class="icon-star-half"></i>';
											}
											for($i=0; $i< $noStarAvg ; $i++ ){ 
												echo '<i class="icon-star-empty"></i>';
											}
											echo '</p>'	;
											echo '('.$ratingArr[$product["from"]."_".$product['id']].' stars)';
											?>
							</div>
							<div class="desc">
								<h3><a href=<?php echo 'product-detail.php?id='."{$product['id']}".'&from='."{$product['from']}"?>><?php echo "{$product['name']}"; ?></a></h3>
								<p class="price"><span>$<?php echo "{$product['price']}"; ?></span></p>
							</div>
						</div>
                    </div>
            <?php
                }
            ?>
				</div>
			</div>
		</div>

		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Recently visited</span></h2>
						<p></p>
					</div>
				</div>
				<div class="row">
            <?php
                foreach($recentfiveproducts as $product)
                {
            ?>
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(<?php echo "{$product['URL']}"; ?>);">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href=<?php echo 'cart.php?from='."{$product['from']}".'&id='."{$product['id']}".'&url='."{$product['URL']}".'&name='."{$product['name']}".'&price='."{$product['price']}"?>><i class="icon-shopping-cart"></i></a></span> 
										<span><a href="product-detail.php"><i class="icon-eye"></i></a></span> 
										<span><a href="#"><i class="icon-heart3"></i></a></span>
										<span><a href="add-to-wishlist.php"><i class="icon-bar-chart"></i></a></span>
									</p>
								</div>
							</div>
							<div><?php
							$avgRating = $ratingArr[$product["from"]."_".$product['id']] > 5 ? 5: $ratingArr[$product["from"]."_".$product['id']];
											$intAvgPart = floor( $avgRating ) ;
											$fractionAvg = $avgRating  - $intAvgPart;
											$fullStarAvg = $intAvgPart;
											$halfStarAvg = $fractionAvg>0?1:0;
											$noStarAvg = 5 - $fullStarAvg - $halfStarAvg;
											echo '<p class="star" style="
											color: #FFDD00;
											margin-bottom: 0px;
										">';
											for($i=0; $i< $fullStarAvg ; $i++ ){ 
												echo '<i class="icon-star-full"></i>';
											}
											for($i=0; $i< $halfStarAvg ; $i++ ){ 
												echo '<i class="icon-star-half"></i>';
											}
											for($i=0; $i< $noStarAvg ; $i++ ){ 
												echo '<i class="icon-star-empty"></i>';
											}
											echo '</p>'	;
											echo '('.$ratingArr[$product["from"]."_".$product['id']].' stars)';
											?>
							</div>
							<div class="desc">
								<h3><a href=<?php echo 'product-detail.php?id='."{$product['id']}".'&from='."{$product['from']}"?>><?php echo "{$product['name']}"; ?></a></h3>
								<p class="price"><span>$<?php echo "{$product['price']}"; ?></span></p>
							</div>
						</div>
                    </div>
            <?php
                }
            ?>
				</div>
			</div>
		</div>

		<div id="colorlib-intro" class="colorlib-intro" style="background-image: url(images/cover-img-1.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="intro-desc">
							<div class="text-salebox">
								<div class="text-lefts">
									<div class="sale-box">
										<div class="sale-box-top">
											<h2 class="number">45</h2>
											<span class="sup-1">%</span>
											<span class="sup-2">Off</span>
										</div>
										<h2 class="text-sale">Sale</h2>
									</div>
								</div>
								<div class="text-rights">
									<h3 class="title">Just hurry up limited offer!</h3>
									<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
									<p><a href="shop.php?from=all" class="btn btn-primary">Shop Now</a> <a href="#" class="btn btn-primary btn-outline">Read more</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div id="colorlib-testimony" class="colorlib-light-grey">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Our Satisfied Customer says</span></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">						
						<div class="owl-carousel2">
							<div class="item">
								<div class="testimony text-center">
									<span class="img-user" style="background-image: url(images/default-profile-pic.png);"></span>
									<span class="user">Akshay Jaiswal</span>
									<small>Miami Florida, USA</small>
									<blockquote>
										<p>Satisfactory customer service and support</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony text-center">
									<span class="img-user" style="background-image: url(images/default-profile-pic.png);"></span>
									<span class="user">Tapan Kulkarni</span>
									<small>New York, USA</small>
									<blockquote>
										<p>Sinnonyms is the best place to shop from.</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony text-center">
									<span class="img-user" style="background-image: url(images/default-profile-pic.png);"></span>
									<span class="user">Test test</span>
									<small>Athens, Greece</small>
									<blockquote>
										<p>Amazing product! Great value for money.</p>
									</blockquote>
								</div>
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
						<p>Sinnonyms inc. is a marketplace created for the purpose of the CMPE 272 term project submission. This marketplace combines the websites of Akshay Jaiswal, Nirbhay Kekre, Tapan Kulkarni and Yash Mahajan</p>
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
							<!-- <li><a href="blog.php">Blog</a></li> -->
							<li><a href="#">Press</a></li>
							<li><a href="#">Exhibitions</a></li>
						</ul>
					</div>

					<div class="col-md-3">
						<h4>Contact Information</h4>
						<ul class="colorlib-footer-links">
							<li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
							<li><a href="">+ 1235 2355 98</a></li>
							<li><a href="mailto:akshjaiswalfree@gmail.com">akshjaiswalfree@gmail.com</a></li>
							<li><a href="#">sinnonyms.com</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="copy">
				<div class="row">
					<div class="col-md-12 text-center">
						<p style="color:white">
							
							<span class="block"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart2" aria-hidden="true"></i> by <a style= "color:white" href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span> 
							<span class="block">Demo Images: <a style= "color:white" href="http://unsplash.co/" target="_blank">Unsplash</a> , <a style= "color:white" href="http://pexels.com/" target="_blank">Pexels.com</a></span>
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

	</body>
</html>

