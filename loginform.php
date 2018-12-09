<?php
    session_start();

	include 'rooturl.php';
	$rooturl = getRootURL();
?>
<!DOCTYPE HTML>
<html>
	<head>
        <meta name="google-signin-client_id" content="853555902851-6pavsf9g93rgo2fgm4gesprkhsf2p0bn.apps.googleusercontent.com">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        
        <!------ Include the above in your HEAD tag ---------->

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="loginform.css">

        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <!-- <script src="facebook.js"></script> -->
        <!------ Include the above in your HEAD tag ---------->

    </head>
    <body>
        <script>

            var person = {"userId": "", "firstname": "", "lastname": "", "email": "", "picture": "" }

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
            
            function checkLoginState() 
            {
                FB.getLoginStatus(function(response) 
                {
                    statusChangeCallback(response);
                });
            }

            function statusChangeCallback(response) 
            {
                if (response.status == 'connected') 
                {
                    testAPI();
                } 
                else 
                {
                }
            }


             function testAPI() 
            {
                
                FB.api('/me?fields=id,first_name,last_name,email,picture.type(large)', function(response) {
                // document.getElementById('firstname').value =response.first_name ;
                // document.getElementById('lastname').value =response.last_name ;
                // document.getElementById('username').value =response.email ;
                // document.getElementById('password').value ="FB";
                // document.getElementById('login').value ="facebook";
                // // document.getElementById('submit').click();
                // document.getElementById("loginForm").submit();

                let formData = new FormData();
                formData.append("username", response.email);
                formData.append("lastname", response.last_name);
                formData.append("firstname", response.first_name);
                formData.append("login", "facebook");
                fetch(<?php echo '"'.$rooturl.'/googlelogin.php"'; ?>, {
                    method: 'POST',
                    body: formData
                }).then(resp => {
                    if(resp.status == 200){
                        window.location = <?php echo '"'.$rooturl.'/index.php"'; ?>;
                    }
                });
                // person.firstname = response.first_name;
                // person.lastname = response.last_name;
                // person.email = response.email;
                // person.picture = response.picture.data.url;
                
                // console.log(person);

                // $.ajax({
                //     url: "loginexec.php",
                //     method: "POST",
                //     data: person,
                //     datatype: 'json',
                //     success: function (serverresponse)
                //     {
                //         if(serverresponse == "success")
                //         {
                //             window.location = "index.php";
                //         }
                //     }
                // });

                // console.log(response);
                
                }, {scope: 'public_profile, email'});
            }

            function onSignIn(googleUser) 
            {
                console.log("Google called");
                var profile = googleUser.getBasicProfile();
                console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                console.log('Name: ' + profile.getName());
                console.log('Image URL: ' + profile.getImageUrl());
                console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
                
                var namearray = (profile.getName()).split(" ");
                // document.getElementById('firstname').value = namearray[0] ;
                // document.getElementById('lastname').value = namearray[1] ;
                // document.getElementById('username').value = profile.getEmail() ;
                // document.getElementById('password').value = "G";
                // document.getElementById('login').value = "google";
                //document.getElementById("loginForm").submit();
                

                let formData = new FormData();
                formData.append("username", profile.getEmail());
                formData.append("lastname", namearray[0]);
                formData.append("firstname", namearray[1]);
                formData.append("login", "google");
                fetch(<?php echo '"'.$rooturl.'/googlelogin.php"'; ?>, {
                    method: 'POST',
                    body: formData
                }).then(resp => {
                    if(resp.status == 200){
                        window.location = <?php echo '"'.$rooturl.'/index.php"'; ?>;
                    }
                });
            }

            

        </script>


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
                            <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                            <input type="text" style="display:none" class="form-control" id="firstname" name="firstname" placeholder="" >
                            <input type="text" style="display:none" class="form-control" id="lastname" name="lastname" placeholder="" >
                            <input type="text" style="display:none" class="form-control" id="login" name="login" value="normal" placeholder="" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                        </div>
                        <div class="form-check">
                            <button type="submit" id="btn-submit" class="btn btn-login float-right">Submit</button>
                        </div>
                    </form>
 
                    <div class="container">
                        <div id="profile">
                            <!-- profile -->
                        </div>
                    </div>

                    <div id="g-btn" class="g-text"><div class="g-signin2" data-onsuccess="onSignIn"></div></div>
                    <div id="fb-btn" class="copy-text" style="bottom: 50px;">login with facebook <i class="fa fa-heart"></i> <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button></div>
                    <div id="register-btn" class="copy-text">New to Marketplace? <i class="fa fa-heart"></i> <a href="registerform.php">Register</a></div>
                </div>
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
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
                        
                    </div>
                    </div>	   
                    
                </div>
            </div>
        </div>
</section>
</body>
</html>