<?php
require 'auth.php';
include 'rooturl.php';
$rooturl = getRootURL();
class Products{
    public $id="";
    public $from="";
    public $name="";
    public $url="";
    public $price="";
}
$cookie_name = "products";
if(isset($_GET['from']) && isset($_GET['id']))
{
    if(!isset($_COOKIE[$cookie_name])) {
        $products=array();
        $product=new Products();
        $product->id=$_GET['id'];
        $product->name=$_GET['name'];
        $product->url=$_GET['url'];
        $product->from=$_GET['from'];
        $product->price=$_GET['price'];
        $products[0]=$product;
        setcookie($cookie_name, json_encode($products), time() + (86400 * 30), "/");
    } else {
        $products = json_decode($_COOKIE[$cookie_name]);
        $product=new Products();
        $product->id=$_GET['id'];
        $product->name=$_GET['name'];
        $product->url=$_GET['url'];
        $product->from=$_GET['from'];
        $product->price=$_GET['price'];
        array_push($products,$product);
        setcookie($cookie_name, json_encode($products), time() + (86400 * 30), "/");
    }
}elseif(isset($_GET['removeId'])){
    $products = json_decode($_COOKIE[$cookie_name]);
    $newArr=array();
    $isRemoved = false;
    foreach ($products as $p){
        if($p->id==$_GET['removeId'] && $p->from==$_GET['removeFrom'] && !$isRemoved){
            $isRemoved=true;
        }else{
            array_push($newArr,$p);
        }
    }
    $products=$newArr;
    setcookie($cookie_name, json_encode($newArr), time() + (86400 * 30), "/");
}else{
    $products = json_decode($_COOKIE[$cookie_name]);
}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SINNONYMS INC.</title>
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
			   	<li style="background-image: url(images/cover-img-1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h1>Shopping Cart</h1>
				   					<h2 class="bread"><span><a href="index.php">Home</a></span> <span><a href="shop.php?from=all">Product</a></span> <span>Shopping Cart</span></h2>
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
				<div class="row row-pb-md">
					<div class="col-md-10 col-md-offset-1">
						<div class="process-wrap">
							<!--<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>-->
						</div>
					</div>
				</div>
				<div class="row row-pb-md">
					<!--<div class="col-md-10 col-md-offset-1">
						<div class="product-name">
							<div class="one-forth text-center">
								<span>Product Details</span>
							</div>
							<div class="one-eight text-center">
								<span>Price</span>
							</div>
							<div class="one-eight text-center">
								<span>Quantity</span>
							</div>
							<div class="one-eight text-center">
								<span>Total</span>
							</div>
							<div class="one-eight text-center">
								<span>Remove</span>
							</div>
						</div>
						<div class="product-cart">
							<div class="one-forth">
								<div class="product-img" style="background-image: url(images/item-6.jpg);">
								</div>
								<div class="display-tc">
									<h3>Product Name</h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$68.00</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100">
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$120.00</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<a href="#" class="closed"></a>
								</div>
							</div>
						</div>
						<div class="product-cart">
							<div class="one-forth">
								<div class="product-img" style="background-image: url(images/item-7.jpg);">
								</div>
								<div class="display-tc">
									<h3>Product Name</h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$68.00</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<form action="#">
										<input type="text" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100">
									</form>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$120.00</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<a href="#" class="closed"></a>
								</div>
							</div>
						</div>
						<div class="product-cart">
							<div class="one-forth">
								<div class="product-img" style="background-image: url(images/item-8.jpg);">
								</div>
								<div class="display-tc">
									<h3>Product Name</h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$68.00</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100">
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$120.00</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<a href="#" class="closed"></a>
								</div>
							</div>
						</div>-->
						<?php
						$subTotal = 0;
						foreach($products as $e){
                           echo '<div class="product-cart">';
                                echo '<div class="one-forth">';
                                    echo '<div class="product-img" style="background-image: url('."{$e->url}".');">';
                                    echo '</div>';
                                    echo '<div class="display-tc">';
                                        echo '<h3>'."{$e->name}".'</h3>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="one-eight text-center">';
                                    echo '<div class="display-tc">';
                                        echo '<span class="price">$'."{$e->price}".'</span>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="one-eight text-center">';
                                    echo '<div class="display-tc">';
                                        echo '<a href="cart.php?removeId='."{$e->id}".'&removeFrom='."{$e->from}".'" class="closed"></a>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            $subTotal = $subTotal + $e->price;
                        }
                        ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="total-wrap">
							<div class="row">
								<div class="col-md-8">
									<form action="#">
										<div class="row form-group">
											<div class="col-md-9">
												<input type="text" name="quantity" class="form-control input-number" placeholder="Your Coupon Number...">
											</div>
											<div class="col-md-3">
												<input type="submit" value="Apply Coupon" class="btn btn-primary">
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-3 col-md-push-1 text-center">
									<div class="total">
										<div class="sub">
											<p><span>Subtotal:</span> <span>
										    <?php
											    echo $subTotal;
											?>
											</span></p>
											<p><span>Delivery:</span> <span>$0.00</span></p>
											<p><span>Discount:</span> <span>$45.00</span></p>
										</div>
										<div class="grand-total">
											<p><span><strong>Total:</strong></span> <span>
											 <?php
                                             $total = 0;
                                             if($subTotal > 0){
                                                 $total = $subTotal-45;
                                             }
											echo $total;
    										?>
											</span></p>
										</div>
                                        <div id="paypal-button"></div>
                                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                                        <script>
                                          paypal.Button.render({
                                            // Configure environment
                                            env: 'sandbox',
                                            client: {
                                              sandbox: 'demo_sandbox_client_id',
                                              production: 'demo_production_client_id'
                                            },
                                            // Customize button (optional)
                                            locale: 'en_US',
                                            style: {
                                              size: 'small',
                                              color: 'gold',
                                              shape: 'pill',
                                            },

                                            // Enable Pay Now checkout flow (optional)
                                            commit: true,

                                            // Set up a payment
                                            payment: function(data, actions) {
                                              return actions.payment.create({
                                                transactions: [{
                                                  amount: {
                                                    total: '<?php echo $total?>',
                                                    currency: 'USD'
                                                  }
                                                }]
                                              });
                                            },
                                            // Execute the payment
                                            onAuthorize: function(data, actions) {
                                              return actions.payment.execute().then(function() {
                                                // Show a confirmation message to the buyer
                                                window.alert('Thank you for your purchase!');
                                                  document.cookie =  'products=;Path=/;Expires=Thu, 01 Jan 1970 00:00:01 GMT;'
                                                  // Simulate an HTTP redirect:
                                                  window.location.replace("shop.php?from=all");
                                              });
                                            }
                                          }, '#paypal-button');

                                        </script>
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
						<h2><span>Recommended Products</span></h2>
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

                <!--<div class="col-md-2">
                    <h4>News</h4>
                    <ul class="colorlib-footer-links">-->
                        <!-- <li><a href="blog.php">Blog</a></li> -->
                        <!--<li><a href="#">Press</a></li>
                        <li><a href="#">Exhibitions</a></li>
                    </ul>
                </div>-->

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
	</script>

	</body>
</html>

