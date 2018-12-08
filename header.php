<nav class="colorlib-nav" role="navigation">
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