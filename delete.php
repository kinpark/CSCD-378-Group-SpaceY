<?php
    require_once "config.php";
    // Initialize the session
    session_start();
    $EID = $_GET["EID"];

    // logging: delete_event
    $UID=$_SESSION["UID"];
    //$EID=null;
    //$ip_address=getenv("REMOTE_ADDR");
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $conn->query("INSERT INTO log (user_id, event_id, action, ip_address) VALUES ('$UID', $EID, 'delete_event', '$ip_address')"); 

    $query = "DELETE FROM registration WHERE event_id='$EID'";
    mysqli_query($conn, $query);

    $query = "DELETE FROM events WHERE EID='$EID'";
	mysqli_query($conn, $query);
	header('location:YourEvents.php');
?>