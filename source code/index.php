<?php
 include_once('index_links.php');
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8" />
        <meta name = "viewport" content="width = device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Event Registration Portal</title>
    </head>
    <body>
		<!-- <img src = "/images/indiralogo.png" width="80", height="80" class = "center"> -->
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="registration.php" method="post">
                    <h1>Create Account</h1>
			       	<!-- <div class="social-container">
				        <a href="#" class="social"><img src="images/gmail.png" width="17" height="17"></a>
				        <a href="#" class="social"><img src="images/outlook.png" width="17" height="17"></a>
				        
			        </div> -->
			        <span>or use your email for registration</span> 
			        <input type="text" name="name_field" placeholder="Name" required/>
			        <input type="email" name="email_field" placeholder="Email" required/>
			        <input type="password" name="password_field" placeholder="Password" required/>
			        <button type="submit">Sign Up</button>
		        </form>
	        </div>
	        <div class="form-container sign-in-container">
		        <form action="login.php" method="post">
			        <h1>Sign in</h1>
			        <!-- <div class="social-container">
				        <a href="#" class="social"><img src="images/gmail.png" width="17" height="17"></a>
				        <a href="#" class="social"><img src="images/outlook.png" width="17" height="17"></a>
			        </div>  -->
			        <span>or use your account</span> 
			        <input type="email" name="email" placeholder="Email" required/>
			        <input type="password" name="password" placeholder="Password" required/>
			        <a href="forget_password.php">Forgot your password?</a>
			        <button type="submit">Sign In</button>
		        </form>
	        </div>
	        <div class="overlay-container">
		        <div class="overlay">
			        <div class="overlay-panel overlay-left">
						<img src = "images/indiralogo.png" width="80", height="80" class = "center">
				        <h1>Welcome Back!</h1>
				        <p>To participate, please connect through your college info!</p>
				        <button class="ghost" id="signIn">Sign In</button>
			        </div>
			        <div class="overlay-panel overlay-right">
						<img src = "images/indiralogo.png" width="80", height="80" class = "center">
				        <h1>Hello Indiraites!</h1>
				        <p>Enter your details and start your journey with us</p>
				        <button class="ghost" id="signUp" >Sign Up</button>
			        </div>
		        </div>
	        </div>
        </div>
		<script src="js/main.js"></script>
    </body>
</html>