
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8" />
        <meta name = "viewport" content="width = device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Event Registration Portal</title>
        <link rel="icon" href="images/indiralogo.png" />
        <link rel="stylesheet" type = "text/css" href="css/style.css" />
    </head>
    <body>

    <div class="form-container">
		        <form action="reset_password.php" method="post">
			        <h1>Forgot Password?</h1>
			        <span>Enter email to reset password</span> 
			        <input type="email" name="email" placeholder="Email" required/>
                    <input type="password" name="password" placeholder="New Password" required/>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required/>
			        <button type="submit">Submit</button>
		        </form>
	        </div>

</body>
</html>