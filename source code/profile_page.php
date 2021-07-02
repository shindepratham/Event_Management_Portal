<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
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
                <form>
                    <h1>Profile Details</h1>
			        <input type="text"  readonly value="<?php echo "Username : ".$_SESSION['name'];?>" />
                    <input type="text" readonly value="<?php echo "Email : ".$_SESSION['email'];?>" />
                    <input type="text" readonly value="<?php echo "User type : ".$_SESSION['usertype'];?>" />
                    <input type="text" readonly value="<?php echo "Account creation : ".$_SESSION['acctime'];?>" />
		        </form>
		<script src="js/main.js"></script>
    </body>
</html>