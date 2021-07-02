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

$event_creator = $event_name = $short_description = $entry_fees = $event_coordinators = $prize = $event_rules = $participant_type = $last_date = $event_date = '';

$event_creator = trim($_SESSION['name']);
$event_name = trim($_POST['EventName']);
$short_description = trim($_POST['shortdescription']);
$entry_fees = trim($_POST['fee']);
$event_coordinators = trim($_POST['coordinator']);
$prize = trim($_POST['prize']);
$event_rules = trim($_POST['eventrules']);
$participant_type = trim($_POST['stu']);
$last_date = trim($_POST['lastdate']);
$event_date = trim($_POST['EventDate']);

if($last_date > $event_date)
{
  echo "<script> alert('Last date should be less than event date'); </script>";
}
else
{
$sql = "INSERT INTO Events (Event_Creator,Event_Name,Short_Description,Entry_fees,Event_Coordinators,Prize,Event_Rules,Participant_Type,Last_Date,Event_Date) VALUES ('$event_creator','$event_name','$short_description','$entry_fees','$event_coordinators','$prize','$event_rules','$participant_type','$last_date','$event_date')";
$result = mysqli_query($conn, $sql);
if($result)
{
  header("Location: OrganiserDashboard.php");
}
else
{
  echo 'Error :'.mysqli_error($conn);
}

}
?>