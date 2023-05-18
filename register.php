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

$query = "SELECT * FROM registration WHERE event_id='$EID' and user_id='$UID'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result)>0){
    $sql = "UPDATE registration SET status='Registered' WHERE event_id='$EID' and user_id='$UID'";
    mysqli_query($conn, $sql);
}
else {
    $sql = "INSERT INTO registration (user_id, event_id) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if ( ! mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ii", $UID, $EID);

    mysqli_stmt_execute($stmt);
}

$query = "SELECT capacity FROM events WHERE EID='$EID'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $capacity = $row["capacity"];
}
echo $capacity;

$query = "SELECT * FROM registration WHERE event_id='$EID' AND status='Registered'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > $capacity) {
    $sql = "UPDATE registration SET status='Waitlist' WHERE event_id='$EID' and user_id='$UID'";
    mysqli_query($conn, $sql);
    echo "Event capacity is full, you have been waitlisted.";
}

header("Location: Dashboard.php");

//Check if already registered for specific event
//if not registered create entry in registration
//return to your registered events

?>