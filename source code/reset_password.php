<?php

require_once('db_connection.php');

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['confirm_password']);
    $pwd = MD5($password);

    $conn = mysqli_connect("localhost","root","","Event Portal");

    if (mysqli_connect_errno()) {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    if($password == $cpassword)
    {
        $stmt = "UPDATE Users SET Password = '".$pwd."' WHERE Username ='".$email."'";  
        $res = mysqli_query($conn, $stmt);
        if($res)
        {
            echo "<script> alert('Password reset successful'); </script>";
            header('location:index.php');
        }
        else
        {
            echo "<script> alert('Account not found'); </script>";
        }
    }
    else
    {
        echo "<script> alert('Passwords do not match'); </script>";
    }

?>
