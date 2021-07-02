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
        <div class="container" id="container" align="centre">  
		        <form action="payment.php" method="post" >
			        <h1>Payment Successful!!</h1><br><br>        
				  <button type=button onClick=location.href='ParticipantDashboard.php'>Return To Dashboard</button>
		        </form>
	        </div>
        </div>
		<script src="js/main.js"></script>
    </body>
</html>