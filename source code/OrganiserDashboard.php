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
$name = $_SESSION['name'];
$query = "SELECT * FROM Events WHERE Event_Creator = '".$name."'";  
 $result = mysqli_query($conn, $query);
$query1 = "SELECT Event_Name FROM Events";  
$result1 = mysqli_query($conn, $query);

$today = date("y-m-d");
$count1 = $count2 = $count3 = $count4 = 0;
$stmt1 = "SELECT * FROM Events";  
$res1 = mysqli_query($conn, $stmt1);
$count1 = mysqli_num_rows($res1);

$stmt2 = "SELECT Event_Date FROM Events WHERE Event_Date >= '".$today."'";  
$res2 = mysqli_query($conn, $stmt2);
$count2 = mysqli_num_rows($res2);

$stmt3 = "SELECT Event_Date FROM Events WHERE Event_Date < '".$today."'";  
$res3 = mysqli_query($conn, $stmt3);
$count3 = mysqli_num_rows($res3);

$stmt4 = "SELECT * FROM Participants where Event_Creator = '".$name."'";  
$res4 = mysqli_query($conn, $stmt4);
$count4 = mysqli_num_rows($res4);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Organiser</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="images/indiralogo.png"/>

	<!-- Import lib -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- End import lib -->

	<link rel="stylesheet" type="text/css" href="css/organizer_style.css">
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
					<span>Organiser</span>
				</a>
			</li>
            <li class="sidebar-nav-item">
				<a href="#viewevents" class="sidebar-nav-link">
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
					<span>Add Event</span>
				</a>
			</li>
			
			<li  class="sidebar-nav-item">
				<a href="#part" class="sidebar-nav-link">
					<div>
						<i class="fas fa-user-friends"></i>
					</div>
					<span>View Participants</span>
				</a>
			</li>

			
		</ul>
	</div>
	<!-- end sidebar -->
	<!-- main content -->
	<!--View Events-->
	<section class = "viewevents" id="viewevents">
		<div class="wrapper">
			<div class="row">
				<div class="col-3 col-m-6 col-sm-6">
					<div class="counter tevents">
						<p>
							<i class="fas fa-tasks"></i>
						</p>
						<h3><?php echo $count1; ?></h3>
						<p>Total Events</p>
					</div>
				</div>
				<div class="col-3 col-m-6 col-sm-6">
					<div class="counter oevents">
						<p>
							<i class="fas fa-spinner"></i>
						</p>
						<h3><?php echo $count2; ?></h3>
						<p>On-going Events</p>
					</div>
				</div>
				<div class="col-3 col-m-6 col-sm-6">
					<div class="counter cevents">
						<p>
							<i class="fas fa-check-circle"></i>
						</p>
						<h3><?php echo $count3; ?></h3>
						<p>Completed Events</p>
					</div>
				</div>
				<div class="col-3 col-m-6 col-sm-6">
					<div class="counter participants">
						<p>
							<i class="fas fa-user-friends"></i>
						</p>
						<h3><?php echo $count4; ?></h3>
						<p>Total Participants</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-8 col-m-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<h3>
								Total Events
							</h3>
							<i class="fas fa-calendar-week"></i>
						</div>
						<div class="card-content">
							<table>
								<thead>
									<tr>
									<th>Event</th>
									<th>Coordinator</th>
									<th>Team size</th>
									<th>Entry fees</th>
									<th>Event Date</th>
									<th>Registration ends</th>
									<th></th>
									<th></th>
									</tr>
								</thead>
								<tbody>
								<?php  
                        		 while($row = mysqli_fetch_array($result))  
                         		{ 
								 ?>
									<tr>
									<td class="event_name"><?php echo $row["Event_Name"]; ?></td>
									<td><?php echo $row["Event_Coordinators"]; ?></td>  
									<td><?php echo $row["Participant_Type"]; ?></td> 
									<td><?php echo $row["Entry_fees"]; ?></td> 
									<td><?php echo $row["Event_Date"]; ?></td>  
									<td><?php echo $row["Last_Date"]; ?></td>    
									<td>
										<div class="button viewbtn">
											<a href = "#popup1"><input type="button" name="edit" value="View Info"/></a>
										</div>
									</td>  
                              		<td>
									  	<div class="button editbtn">
									  		<a href = "#popup2"><input type="button" name="view" value="Edit" id="<?php echo $row["Event_Name"]; ?>"/></a>
										</div>
									</td>
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

		<div id="popup1" class="overlay">
    			<div class="popup">
     			<h2 id="EventName"></h2>
      			<a class="close" href="#">×</a>
      			<div class="content extra_info">
      			</div>
    			</div>
  			</div>

		<div id="popup2" class="overlay">
    			<div class="popup">
     			<h2 id="Event_Name"></h2>
      			<a class="close" href="#">×</a>
      			<div class="content edit_info">
				Event coordinators : <input type="text" id="edit1" placeholder="Event coordinators" name="edit_coordinator" required><br>
				Entry fees : <input type="number" id="edit2" placeholder="Entry fees" name="edit_entry_fees"><br>
				Prize : <input type="text" id="edit3" placeholder="Prize" name="edit_prize"><br>
				Description : <br><textarea cols="35" rows="5" id="edit4" name="edit_shortdescription" placeholder="Short Description" required></textarea><br>
				Team size : <input type="number" id="edit5" placeholder="Team size" name="edit_team_size" max = 4 min = 1 required><br>
				Event rules : <br><textarea cols="35" rows="5" id="edit6" name="edit_eventrules" placeholder="Event Rules" required></textarea><br>
				  <label>Date of Event:
								<input type ="date" id="edit7" name="edit_event_date" min=<?php echo date("Y-m-d"); ?> required>
				</label><br>
				<label>Registration ends:
								<input type ="date" id="edit8" name="edit_last_date" min=<?php echo date("Y-m-d"); ?> required>
				</label><br><br><br>
				<button type="submit" class="updatebtn">Update details</button>
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


				$(document).ready(function () {
					$(".editbtn").click(function (e) { 
						var event_name = $(this).closest('tr').find('.event_name').text();
						$('#Event_Name').text(event_name);
						$.ajax({
							type: "POST",
							url: "fetch_data.php",
							data: {
								'checking_editbtn' : true,
								'EventName' : event_name,
							},
							success: function (response) {
								var result = $.parseJSON(response);
								 $('#edit1').val(result[0])
								 $('#edit2').val(result[1])
								 $('#edit3').val(result[2])
								 $('#edit4').val(result[3])
								 $('#edit5').val(result[4])
								 $('#edit6').val(result[5])
								 $('#edit7').val(result[6])
								 $('#edit8').val(result[7])
							}
						});
					});
				});


				$(document).ready(function () {
					$('.updatebtn').click(function (e) { 
						var event_name = $('#Event_Name').text();
						var event_coordinators = $('#edit1').val();
						var entry_fees = $('#edit2').val();
						var prize = $('#edit3').val();
						var description = $('#edit4').val();
						var team_size = $('#edit5').val();
						var event_rules = $('#edit6').val();
						var event_date = $('#edit7').val();
						var last_date = $('#edit8').val();

						$.ajax({
							type: "POST",
							url: "fetch_data.php",
							data: {
								'checking_updatebtn' : true,
								'event_name' : event_name,
								'event_coordinators' : event_coordinators,
								'entry_fees' : entry_fees,
								'prize' : prize,
								'description' : description,
								'team_size' : team_size,
								'event_rules' : event_rules,
								'event_date' : event_date,
								'last_date' : last_date,
							},
							success: function (response) {
								alert("Details updated");
							}
						});
						
					});
				});
	</script>

		<!--Add Event-->
		<section class="addevent" id="addevent">
			<div class = "card">
				<div class = "card-header">
					<h3>Add Event</h3>
					<i class = "fas fa-calendar-plus"></i>
				</div>
			</div>
			<div class = "form">
				<form action="add_event.php" method="post">
					<div class="fields">
						<div class="field name">
							<input type="text" name="EventName" placeholder="Event Name" required>
						</div>
						<div class="eventdate">
							<label>Date of Event:
								<input type ="date" name="EventDate" min=<?php echo date("Y-m-d"); ?> required>
							</label>
						</div>
						<div class="field textarea">
							<textarea cols="30" rows="10" name="shortdescription" placeholder="Short Description" required></textarea>
						</div>
						<div class="field fee">
							<input type="number" placeholder="Entry fees" name="fee">
						</div>
						<div class="field fee">
							<input type="text" placeholder="Event coordinators" name="coordinator" required>
						</div>
						<div class="submission">
							<label>Last Date to Register:
								<input type ="date" name="lastdate" min=<?php echo date("Y-m-d"); ?> required>
							</label>
						</div>
						<div class="field prize">
							<input type="text" placeholder="Prize" name="prize">
						</div>
						<div class="field textarea">
							<textarea cols="30" rows="10" name="eventrules" placeholder="Event Rules" required></textarea>
						</div>
						<div class="students">
							<p>Number of Participants</p>
							<input type="radio" id = "individual" name="stu" value="1">
							<label for="individual">Individual</label><br>
							<input type="radio" id = "duet" name="stu" value="2">
							<label for="duet">Duo</label><br>
							<input type="radio" id = "squad" name="stu" value="3">
							<label for="squad">Squad</label><br>
							<input type="radio" id = "team" name="stu" value="4">
							<label for="team">Team</label><br>
						</div>
						<div class="button">
							<button type="submit">Add Event</button>
						</div>
					</div>
				</form>

			</div>
		</section>

		<!--View Participants-->
		<section class = "participant" id="part">
			<div class = "card">
				<div class = "card-header">
					<h3>View Participants</h3>
					<i class = "fas fa-user-check"></i>
				</div>
			</div>
			<div class = "collapse">
			<?php  
                 while($row = mysqli_fetch_array($result1))  
                 { 
			?>
				<details>
					<summary><?php $eventname = $row['Event_Name']; echo $row['Event_Name'] ?></summary>
					<table>
						<thead>
							<tr>
								<th>Student Name</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Team members</th>
							</tr>
						</thead>
						<tbody>
						<?php  
                                        $query3 = "SELECT * FROM Participants WHERE Event_Name = '".$eventname."'";  
                                        $result3 = mysqli_query($conn, $query3);
                        		         while($row = mysqli_fetch_array($result3))  
                         		        { 
								        ?>
									<tr>
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
				</details>
				
			<?php
				}
			?>
			</div>
		</section>
		

	<!-- import script -->
	<script src="js/organizer.js"></script>
	<!-- end import script -->
</body>
</html>