<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="loginform.css">
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <section class="login-block full-height">
            <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec">
                <?php 
                    if(isset($_GET['register']))
                    {
                ?>
                
                    <h3 class="text-center">Registration successful!</h3>        
                    <h2 class="text-center">Login to continue</h2>        
                
                <?php
                    }
                    else{
                ?>
                    <h2 class="text-center">Login</h2>

                    <?php
                        }
                        if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
                            echo '<ul class="err">';
                            foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                                echo '<li>',$msg,'</li>'; 
                            }
                            echo '</ul>';
                            unset($_SESSION['ERRMSG_ARR']);
                        }
                    ?>
                    <form class="login-form"  id="loginForm" name="loginForm" method="post" action="loginexec.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="" required>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                <small>Remember Me</small>
                            </label>
                            <button type="submit" class="btn btn-login float-right">Submit</button>
                        </div>
                    </form>

                    <div class="copy-text">New to Marketplace? <i class="fa fa-heart"></i> <a href="registerform.php">Register</a></div>
                </div>
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Marketplace is the next best thing</p>
                                </div>	
                          </div>
                        </div>
                        <div class="carousel-item">
                        <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="banner-text">
                                <h2>This is Heaven</h2>
                                <p>Marketplace is the next best thing</p>
                            </div>	
                        </div>
                        </div>
                        <div class="carousel-item">
                        <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="banner-text">
                                <h2>This is Heaven</h2>
                                <p>Marketplace is the modern shop</p>
                            </div>	
                        </div>
                    </div>
                    </div>	   
                    
                </div>
            </div>
        </div>
</section>
</body>
</html>