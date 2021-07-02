<?php
session_start();
require_once('db_connection.php');
$conn = mysqli_connect("localhost","root","","Event Portal");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
if(isset($_POST['checking_viewbtn']))
{
    $event_name = $_POST['EventName'];

    $query = "SELECT * FROM Events WHERE Event_Name = '".$event_name."'";  
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))  
    { 
    echo $return = '
        <h5>Description : '.$row['Short_Description'].'</h5>
        <h5>Event rules : '.$row['Event_Rules'].'</h5>
        <h5>Prize : '.$row['Prize'].'</h5>
    ';
    }
}

if(isset($_POST['checking_editbtn']))
{
    $event_name = $_POST['EventName'];

    $query = "SELECT * FROM Events WHERE Event_Name = '".$event_name."'";  
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))  
    { 
    echo json_encode(array($row['Event_Coordinators'],$row['Entry_fees'],$row['Prize'],$row['Short_Description'],$row['Participant_Type'],$row['Event_Rules'],$row['Event_Date'],$row['Last_Date']));
    }
}

if(isset($_POST['checking_updatebtn']))
{
    $event_name = $_POST['event_name'];
    $event_coordinators = $_POST['event_coordinators'];
    $entry_fees = $_POST['entry_fees'];
    $prize = $_POST['prize'];
    $description = $_POST['description'];
    $team_size = $_POST['team_size'];
    $event_rules = $_POST['event_rules'];
    $event_date = $_POST['event_date'];
    $last_date = $_POST['last_date'];

    $query = "UPDATE Events SET Event_Coordinators='".$event_coordinators."',Entry_fees='".$entry_fees."',Prize='".$prize."',Short_Description='".$description."',Participant_Type='".$team_size."',Event_Rules='".$event_rules."',Event_Date='".$event_date."',Last_date='".$last_date."' WHERE Event_Name='".$event_name."'";  
    $result = mysqli_query($conn, $query);
    if($result)
    {
      echo 'Successfully updated';
    }
}
?>

