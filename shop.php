<?php 
require 'auth.php';

include 'rooturl.php';
$rooturl = getRootURL();

if(isset($_GET['from']))
{
	function getProductsFromAkshay() {
		$curl = curl_init();
										
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://akshayjaiswal.me/getproducts.php',
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			
		));

		$resp = curl_exec($curl);
		$products = json_decode($resp, true);

		if (curl_error($curl)) 
		{
			$error_msg = curl_error($curl);
			echo $error_msg;
		}

		return $products;
	}

	function getProductsFromNirbhay() {
		$curl = curl_init();
										
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://nirbhaykekre.com/books.php',
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			
		));

		$resp = curl_exec($curl);
		
		$products = json_decode($resp, true);

		if (curl_error($curl)) 
		{
			$error_msg = curl_error($curl);
			echo $error_msg;
		}

		return $products;
	}

	function getProductsFromTapan() {
		$curl = curl_init();
										
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://www.tapanhere.com/wp-json/products/productsinfo',
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			
		));

		$resp = curl_exec($curl);
		
		$products = json_decode($resp, true);

		if (curl_error($curl)) 
		{
			$error_msg = curl_error($curl);
			echo $error_msg;
		}

		return $products;
	}

	function getProductsFromYash() {
		$curl = curl_init();
										
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'http://yashmahajan.com/products.php',
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			
		));

		$resp = curl_exec($curl);
		$products = json_decode($resp, true);

		if (curl_error($curl)) 
		{
			$error_msg = curl_error($curl);
			echo $error_msg;
		}

		return $products;
	}

	if($_GET['from'] =="akshay")
	{
		$products = getProductsFromAkshay();
	}

	if($_GET['from'] =="nirbhay")
	{
		$products = getProductsFromNirbhay();
	}

	if($_GET['from'] =="tapan")
	{
		$products = getProductsFromTapan();
	}

	if($_GET['from'] =="yash")
	{
		$products = getProductsFromYash();
	}

	if($_GET['from'] =="all")
	{
		$products = array_merge(getProductsFromAkshay(), getProductsFromNirbhay(), getProductsFromTapan(), getProductsFromYash());
	}

	if(isset($_GET['search'])){
		$query = $_GET['search'] ;
		$searchedProduct = array();
		foreach($products as $prod){
			if (stripos($prod['name'], $query) !== false){
				array_push($searchedProduct, $prod); 
			}
		}
		$products = $searchedProduct;
	}
}
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

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
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
				   					<h1>Products</h1>
				   					<h2 class="bread"><span><a href="index.php">Home</a></span> <span>Shop</span></h2>
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
				<div class="row" style="padding-bottom: 50px;text-align:center;">
					<script>
						function search() {
							var query = document.getElementById("search").value;
							var from = localStorage.getItem("from") ? localStorage.getItem("from") : 'all';
							window.location.replace( <?php echo '"'.$rooturl.'/shop.php?from="'?> + from + "&search=" + query );
						}
					</script>
					<input type="text" id="search" placeholder="Search Products" 
						style="width: 60%;border: 2px solid #cccccc;border-radius: 5px;padding: 20px;font-size: large;"/>
						<button class="btn btn-primary" style="margin-left:10px" onclick="search()">Search</button>
				</div>
				<div class="row">
				<?php
						echo '<div class="col-md-10 col-md-push-2">';
							echo '<div class="row row-pb-lg">';
							foreach($products as $product)
							{
								echo '<div class="col-md-4 text-center">';
							
									echo '<div class="product-entry">';
										echo '<div class="product-img" style="background-image: url('."{$product['URL']}".');">';
										echo '<p class="tag"><span class="new">New</span></p>';
										echo '<div class="cart">';
											echo '<p>';
												echo '<span class="addtocart"><a href="cart.php?from='."{$product['from']}".'&id='."{$product['id']}".'&url='."{$product['URL']}".'&name='."{$product['name']}".'&price='."{$product['price']}".'"><i class="icon-shopping-cart"></i></a></span>';
												echo '<span><a href="product-detail.php"><i class="icon-eye"></i></a></span> ';
												echo '<span><a href="#"><i class="icon-heart3"></i></a></span>';
												echo '<span><a href="add-to-wishlist.php"><i class="icon-bar-chart"></i></a></span>';
											echo '</p>';	
											echo '</div>';
										echo '</div>';
										echo '<div class="desc">';
											echo '<h3><a href="product-detail.php?id='."{$product['id']}".'&from='."{$product['from']}".'">'."{$product['name']}"."{$product['price']}".'</a></h3>';
											echo '<p class="price"><span>$'."{$product["price"]}".'</span></p>';
										echo '</div>';
								echo '</div>';
								echo '</div>';
							}
							echo '</div>';
					?>
						<div class="row">
							<div class="col-md-12">
								<ul class="pagination">
									<li class="disabled"><a href="#">&laquo;</a></li>
									<li class="active"><a href="#">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">&raquo;</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-md-pull-10">
						<div class="sidebar">
							<div class="side">
								<h2>Filter</h2>
								<div class="color-wrap">
									<p class="color-desc">
										<a href=<?php echo '"'.$rooturl.'/shop.php?from=all"'; ?> onclick="getProducts('all')"  ><span class="new">ALL</span></a><br>
										<a href=<?php echo '"'.$rooturl.'/shop.php?from=akshay"'; ?> onclick="getProducts('akshay')"  ><span class="new">Akshay</span></a><br>
										<a href=<?php echo '"'.$rooturl.'/shop.php?from=nirbhay"'; ?> onclick="getProducts('nirbhay')" ><span class="new">Nirbhay</span></a><br>
										<a href=<?php echo '"'.$rooturl.'/shop.php?from=tapan"'; ?> onclick="getProducts('tapan')" ><span class="new">Tapan</span></a><br>
										<a href=<?php echo '"'.$rooturl.'/shop.php?from=yash"'; ?> onclick="getProducts('yash')"  ><span class="new">Yash</span></a><br>
									</p>
									<script>
										function getProducts(from){
											localStorage.setItem("from", from);
											return true;
										}
									</script>
								</div>
							</div>
							<!-- <div class="side">
								<h2>Size</h2>
								<div class="size-wrap">
									<p class="size-desc">
										<a href="#" class="size size-1">xs</a>
										<a href="#" class="size size-2">s</a>
										<a href="#" class="size size-3">m</a>
										<a href="#" class="size size-4">l</a>
										<a href="#" class="size size-5">xl</a>
										<a href="#" class="size size-5">xxl</a>
									</p>
								</div>
							</div> -->
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

	</body>
</html>

