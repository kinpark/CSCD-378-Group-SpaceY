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

$query = "UPDATE registration SET status='Cancelled' WHERE event_id='$EID' and user_id='$UID'";
mysqli_query($conn, $query);
    
header("Location: Dashboard.php");

?>