<?php
// Initialize the session
session_start();

// logging: logout
require_once "config.php";
$UID=$_SESSION["UID"];
$EID=null;
$action='login';
//$ip_address=getenv("REMOTE_ADDR");
$ip_address=$_SERVER['REMOTE_ADDR'];
$conn->query("INSERT INTO log (user_id, event_id, action, ip_address) VALUES ('$UID', null, 'logout', '$ip_address')");
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: index.php");
exit;
?>