<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once "config.php";
$EID = $_GET["EID"];
$UID = $_SESSION["UID"];

$queryForStatus = $conn->query("SELECT status FROM registration WHERE event_id='$EID' and user_id='$UID'");
$status = 0;
while ($row = $queryForStatus->fetch_assoc()){
    $status = $row["status"];
}

if ($status === 'Registered'){
    // logging: cancel_registration
    //$UID=$_SESSION["UID"];
    //$EID=null;
    //$ip_address=getenv("REMOTE_ADDR");
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $conn->query("INSERT INTO log (user_id, event_id, action, ip_address) VALUES ('$UID', $EID, 'cancel_registration', '$ip_address')"); 
}
else {
    // logging: remove_from_waitlist
    //$UID=$_SESSION["UID"];
    //$EID=null;
    //$ip_address=getenv("REMOTE_ADDR");
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $conn->query("INSERT INTO log (user_id, event_id, action, ip_address) VALUES ('$UID', $EID, 'remove_from_waitlist', '$ip_address')"); 
}
$query = "UPDATE registration SET status='Cancelled' WHERE event_id='$EID' and user_id='$UID'";
mysqli_query($conn, $query);
    
header("Location: Dashboard.php");

?>