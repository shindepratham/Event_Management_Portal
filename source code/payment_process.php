<?php 
	session_start();
	include('db_connection.php');
	$conn = mysqli_connect("localhost","root","","Event Portal");
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit(); }
	if(isset($_POST['Amount']) && isset($_POST['Name'])){
		$Amount=$_POST['Amount'];
		$Name=$_POST['Name'];
		$payment_status="pending";
		$added_on=date('Y-m-d h:i:s');
		mysqli_query($conn,"insert into payment(name,amount,payment_status,added_on) 
		values('$Name','$Amount','$payment_status','$added_on')");
		$_SESSION['OID']=mysqli_insert_id($conn);
	}
	
	if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
		$payment_id=$_POST['payment_id'];
		$added_on=date('Y-m-d h:i:s');
		$oid = $_SESSION['OID'];
		mysqli_query($conn,"update payment set payment_status='complete',payment_id='$payment_id',added_on='$added_on' where id='$oid'");

		$username = trim($_SESSION['email']);
		$event_creator = trim($_SESSION['Event_Creator']);
		$event_name = trim($_SESSION['Event_Name']);
		$participant_name = trim($_SESSION['Name']);
		$email = trim($_SESSION['Email_id']);
		$mobile = trim($_SESSION['Mobile_no']);
		$team_members = trim($_SESSION['Team_Members']);

		$sql = "INSERT INTO Participants (Participant_Name,Username,Email,Mobile,Team_Members,Event_Name,Event_Creator) VALUES ('$participant_name','$username','$email','$mobile','$team_members','$event_name','$event_creator')";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
		}
		else
		{
			echo 'Error :'.mysqli_error($conn);
		}
	}
?>