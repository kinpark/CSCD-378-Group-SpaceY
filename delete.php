<?php
    require_once "config.php";
    $EID = $_GET["EID"];
    $query = "DELETE FROM events WHERE EID='$EID'";
	mysqli_query($conn, $query);
	header('location:YourEvents.php');
?>