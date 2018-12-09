<?php 
{
	session_start();
	require 'auth.php';

	include 'rooturl.php';
	$rooturl = getRootURL();

    include 'topRated.php';
    
    $topratedarray = getTopRatedMarketPlace();

    $topratedakshay = getIndividualTopRated('akshay');
    $topratednirbhay = getIndividualTopRated('nirbhay');
    $topratedtapan = getIndividualTopRated('tapan');
    $topratedyash = getIndividualTopRated('yash');

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
    
    $idarray5 = getappendstring($topratedakshay['akshay'], 'akshay');
    $idarray6 = getappendstring($topratednirbhay['nirbhay'], 'nirbhay');
    $idarray7 = getappendstring($topratedtapan['tapan'], 'tapan');
    $idarray8 = getappendstring($topratedyash['yash'], 'yash');

	function getProductsFromAkshay($idarray1) 
	{
		if($idarray1 != '')
		{
			// echo 'http://akshayjaiswal.me/getproductbyid.php?'.$idarray1;
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

	// $products = getProductsFromAkshay($idarray1);

    $products = array_merge(getProductsFromAkshay($idarray1), getProductsFromNirbhay($idarray2), getProductsFromYash($idarray4));
    
    $akshayproducts = getProductsFromAkshay($idarray5);
    $nirbhayproducts = getProductsFromNirbhay($idarray6);
    $tapanproducts = getProductsFromTapan($idarray7);
    $yashproducts = getProductsFromYash($idarray8);

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
	<script src="facebook.js"></script>
  	<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

	</head>
	<body>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
			appId      : '354498385097344',
			cookie     : true,
			xfbml      : true,
			version    : 'v3.2'
			});
			
			FB.AppEvents.logPageView();   

		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
			
		function signOut() {
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
			console.log('User signed out.');
			});
		}
		function onLoad() {
			gapi.load('auth2', function() {
				gapi.auth2.init();
			});
			}
			function logout()
			{
				FB.getLoginStatus(function(response) 
				{
					if (response.status == 'connected') 
					{
						FB.logout(function(response) 
						{	
							window.location.replace(<?php echo '"'.$rooturl.'/logout.php"'; ?>);
						});
						
					} 
					else 
					{
						signOut();
						window.location.replace(<?php echo '"'.$rooturl.'/logout.php"'; ?>);
					}
				});
			}

	</script>

	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href=<?php echo '"'.$rooturl.'/index.php"'; ?>>Sinnonyms Inc.</a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a href=<?php echo '"'.$rooturl.'/index.php"'; ?>>Home</a></li>
								<li class="has-dropdown">
									<a href="shop.php?from=all">Shop</a>
									<ul class="dropdown">
										<li><a href="product-detail.php?id=1&from=akshay">Product Detail</a></li>
										<li><a href="cart.php">Shipping Cart</a></li>
										<li><a href="checkout.php">Checkout</a></li>
										<li><a href="order-complete.php">Order Complete</a></li>
										<li><a href="add-to-wishlist.php">Wishlist</a></li>
									</ul>
								</li>
								<li><a href="blog.php">Blog</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="contact.php">Contact</a></li>
								<li><a href="cart.php"><i class="icon-shopping-cart"></i> Cart </a></li>
								<li><a href="favourite.php">Favourites</a></li>
								<?php 
									if(isset($_SESSION['SESS_USER_FNAME']))
									{
								?>
								<li><a href="#" onclick='logout()'>Logout <?php echo "{$_SESSION['SESS_USER_FNAME']}"?></a></li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2>Top rated on Marketplace</h2>
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
												echo '</p>';
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
						<h2>Top rated on Akshay</h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
            <?php
                foreach($akshayproducts as $product)
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
												echo '</p>';
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
						<h2>Top rated on Nirbhay</h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
            <?php
                foreach($nirbhayproducts as $product)
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
												echo '</p>';
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
						<h2>Top rated on Tapan</h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
            <?php
                foreach($tapanproducts as $product)
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
												echo '</p>';
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
						<h2>Top rated on Yash</h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
            <?php
                foreach($yashproducts as $product)
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
												echo '</p>';
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
									<span class="img-user" style="background-image: url(images/person3.jpg);"></span>
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
							<li><a href="#">Blog</a></li>
							<li><a href="#">Press</a></li>
							<li><a href="#">Exhibitions</a></li>
						</ul>
					</div>

					<div class="col-md-3">
						<h4>Contact Information</h4>
						<ul class="colorlib-footer-links">
							<li>291 South 21th Street, <br> Suite 721 New York NY 10016</li>
							<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
							<li><a href="mailto:info@sinnonyms.com">info@sinnonyms.com</a></li>
							<li><a href="#">sinnonyms.com</a></li>
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

	</body>
</html>

