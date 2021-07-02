<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
require_once('db_connection.php');

$conn = mysqli_connect("localhost","root","","Event Portal");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$username = trim($_SESSION['email']);
$event_creator = trim($_POST['EventCreator']);
$event_name = trim($_POST['EventName']);
$participant_name = trim($_POST['ParticipantName']);
$email = trim($_POST['Email']);
$mobile = trim($_POST['Mobile']);
$team_members = trim($_POST['TeamMembers']);


		
$query5 = "SELECT Entry_fees FROM Events WHERE Event_Name = '".$event_name."'";  
$result5 = mysqli_query($conn, $query5);
		
if($result5){
	$row = mysqli_fetch_assoc($result5);
	$fees = $row['Entry_fees'];
	if($fees > 0 || !empty($fees)){
		$_SESSION["Amount"] = $fees;
		$_SESSION["Name"] = $participant_name;
		$_SESSION["Event_Name"] = $event_name;
		$_SESSION["Event_Creator"] = $event_creator;
		$_SESSION["Team_Members"] = $team_members;
		$_SESSION["Email_id"] = $email;
		$_SESSION["Mobile_no"] = $mobile;		
		header("location: payment.php");
		exit;
	}
	else{
		$sql = "INSERT INTO Participants (Participant_Name,Username,Email,Mobile,Team_Members,Event_Name,Event_Creator) VALUES ('$participant_name','$username','$email','$mobile','$team_members','$event_name','$event_creator')";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
			header("Location: ParticipantDashboard.php");
		}
		else
		{
			echo 'Error :'.mysqli_error($conn);
		}
	
	}
}	
		
		
/**/
?>