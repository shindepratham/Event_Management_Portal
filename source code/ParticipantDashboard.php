<?php
// Initialize the session
session_start();
require_once('db_connection.php');
$conn = mysqli_connect("localhost","root","","Event Portal");
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$query1 = "SELECT * FROM Events GROUP BY Event_Creator";  
$result1 = mysqli_query($conn, $query1);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Participant</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="images/indiralogo.png"/>

	<!-- Import lib -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	<!-- End import lib -->

	<link rel="stylesheet" type="text/css" href="css/participant_style.css">

</head>
<body class="overlay-scrollbar">
	<!-- navbar -->
	<div class="navbar">
		<!-- nav left -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link">
					<i class="fas fa-bars" onclick="collapseSidebar()"></i>
				</a>
			</li>
			<li class="nav-item">
				<img src="images/indiralogo.png" alt="logo" class="logo logo-light">
				<img src="images/indiralogo.png" alt="logo" class="logo logo-dark">
			</li>
		</ul>
		<!-- nav right -->
		<ul class="navbar-nav nav-right">
			<li class="nav-item mode">
				<a class="nav-link" href="#" onclick="switchTheme()">
					<i class="fas fa-moon dark-icon"></i>
					<i class="fas fa-sun light-icon"></i>
				</a>
			</li>
			
			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
					<img src="images/dp.jpg"  alt="User image" class="dropdown-toggle" data-toggle="user-menu">
					<ul id="user-menu" class="dropdown-menu">
						<li  class="dropdown-menu-item">
							<a class="dropdown-menu-link">
								<div>
									<i class="fas fa-user-tie"></i>
								</div>
								<span onclick="location ='profile_page.php'">Profile</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-sign-out-alt"></i>
								</div>
								<span onclick="location ='logout.php'">Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<!-- end nav right -->
	</div>
	<!-- end navbar -->
	<!-- sidebar -->
	<div class="sidebar">
		<ul class="sidebar-nav">
			<li class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link">
				</a>
			</li>
            <li  class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link active">
					<div>
						<i class="fas fa-columns"></i>
					</div>
					<span>Participant</span>
				</a>
			</li>
            <li class="sidebar-nav-item">
				<a href="#part" class="sidebar-nav-link">
					<div>
						<i class="fas fa-calendar"></i>
					</div>
					<span>View Events</span>
				</a>
			</li>
            <li class="sidebar-nav-item">
				<a href="#addevent" class="sidebar-nav-link">
					<div>
						<i class="fas fa-calendar-week"></i>
					</div>
					<span>Participation form</span>
				</a>
			</li>
			
			<li  class="sidebar-nav-item">
				<a href="#viewevents" class="sidebar-nav-link">
					<div>
						<i class="fas fa-user-friends"></i>
					</div>
					<span>Applied events</span>
				</a>
			</li>

			
		</ul>
	</div>
	<!-- end sidebar -->
	<!-- main content -->
	<!--View Events-->
    <section class = "participant" id="part">
        <div class = "card">
            <div class = "card-header">
                <h3>View Events</h3>
                <i class = "fas fa-user-check"></i>
            </div>
        </div>
        <div class = "collapse">
        <?php  
                 while($row = mysqli_fetch_array($result1))  
                 { 
			?>
				<details>
					<summary><?php $creator = $row['Event_Creator']; echo $row['Event_Creator'] ?></summary>
					<table>
						<thead>
							<tr>
                            <th>Event</th>
                            <th>Organization</th>
							<th>Coordinator</th>
							<th>Team size</th>
							<th>Entry fees</th>
							<th>Event Date</th>
							<th>Registration ends</th>
							<th></th>
							</tr>
						</thead>
						<tbody>
                        <?php  
                                $query2 = "SELECT * FROM Events WHERE Event_Creator = '".$creator."'";  
                                $result2 = mysqli_query($conn, $query2);
                        		 while($row = mysqli_fetch_array($result2))  
                         		{ 
								 ?>
									<tr>
									
									<td class="event_name"><?php echo $row["Event_Name"]; ?></td>
									<td><?php echo $row["Event_Creator"]; ?></td>
									<td><?php echo $row["Event_Coordinators"]; ?></td>  
									<td><?php echo $row["Participant_Type"]; ?></td> 
									<td><?php echo $row["Entry_fees"]; ?></td> 
									<td><?php echo $row["Event_Date"]; ?></td>  
									<td><?php echo $row["Last_Date"]; ?></td>
				  
									<td>
										<a href = "#popup1"><input type="button" name="register" class="registerbtn viewbtn" value="View Info"/></a>
									</td>

										
                              		</tr>
									<?php
								 }
								 ?>
						</tbody>
					</table>
				</details>
				
			<?php
				}
			?>
        </div>
    </section>

	<div id="popup1" class="overlay">
    			<div class="popup">
     			<h2 id="EventName"></h2>
      			<a class="close" href="#">×</a>
      			<div class="content extra_info">
      			</div>
    			</div>
  			</div>

	<script>

				$(document).ready(function () {
					$(".viewbtn").click(function (e) { 
						var event = $(this).closest('tr').find('.event_name').text();
						$('#EventName').text(event);
						$.ajax({
							type: "POST",
							url: "fetch_data.php",
							data: {
								'checking_viewbtn' : true,
								'EventName' : event,
							},
							success: function (response) {
								 $('.extra_info').html(response)
							}
						});
					});
				});
	</script>

		<!--Add Event-->
		<section class="addevent" id="addevent">
			<div class = "card">
				<div class = "card-header">
					<h3>Participation form</h3>
					<i class = "fas fa-calendar-plus"></i>
				</div>
			</div>
			<div class = "form">
				<form action="register_event.php" method="post">
					<div class="fields">
						<div class="field organisation">
							<label for="Event Organisation">Event Organisation:</label>
							<select name="EventCreator" id="event_creator" required>
								<option value="">Select Organization</option>
								<?php
										$query4 = "SELECT Event_Creator FROM Events GROUP BY Event_Creator";  
										$result4 = mysqli_query($conn, $query4);
										while($row = mysqli_fetch_array($result4))  
										{ 
											echo '<option value="'.$row['Event_Creator'].'">'.$row['Event_Creator'].'</option>';
										}
								?>
							</select>
						</div>
						
                        <div class="field eventname">
							<label for="Event Name">Event Name:</label>
							<select name="EventName" id="event_name" required>
								<option value="">Select Event</option>
							</select>
						</div>
                        <div class="field name">
							<input type="text" name="ParticipantName" placeholder="Participant/Team Leader Name" required>
						</div>
                        <div class="field name">
							<input type="text" name="Email" placeholder="Email ID" required>
						</div>
                        <div class="field name">
							<input type="text" name="Mobile" placeholder="Mobile number" required>
						</div>
						<div class="field textarea">
							<textarea cols="30" rows="10" name="TeamMembers" placeholder="Team Members (If Applicable)" required></textarea>
						<div class="button">
							<button type="submit">Submit</button>
						</div>
					</div>
				</form>

			</div>
		</section>
		
		<script>
				$(document).ready(function () {
					$('#event_creator').change(function (e) { 
						var organizer = $('#event_creator').val();
						$.ajax({
							type: "POST",
							url: "fetch_events.php",
							data: {
								'organizer' : organizer,
							},
							success: function (response) {
								$('#event_name').html(response);
							}
						});
						
					});
				});
		</script>

		<!--View Participants-->
		<section class = "viewevents" id="viewevents">
            <div class="wrapper">
                <div class="row">
                    <div class="col-8 col-m-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Applied Events
                                </h3>
                                <i class="fas fa-calendar-week"></i>
                            </div>
                            <div class="card-content">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Organizer</th>
                                            <th>Event</th>
                                            <th>Participant</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Team members</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                       <?php  
                                        $username = $_SESSION['email'];
                                        $query3 = "SELECT * FROM Participants WHERE Username = '".$username."'";  
                                        $result3 = mysqli_query($conn, $query3);
                        		         while($row = mysqli_fetch_array($result3))  
                         		        { 
								        ?>
									<tr>
                                    <td><?php echo $row["Event_Creator"]; ?></td>
                                    <td><?php echo $row["Event_Name"]; ?></td>
									<td><?php echo $row["Participant_Name"]; ?></td>  
									<td><?php echo $row["Email"]; ?></td>  
									<td><?php echo $row["Mobile"]; ?></td>  
									<td><?php echo $row["Team_Members"]; ?></td>    
                              		</tr>
									<?php
								 }
								 ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                </div>
            </section>
		

	<!-- import script -->
	<script src="js/participant.js"></script>
	<!-- end import script -->

</body>
</html>