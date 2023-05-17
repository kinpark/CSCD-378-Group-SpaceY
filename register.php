<?php

include_once "config.php";
$EID = $_GET["EID"];
$UID = $_SESSION["UID"];

$query = "SELECT * FROM registration WHERE event_id='$EID' and user_id='$UID'";
$result = mysqli_query($conn, $query);

if($_SERVER["REQUEST_METHOD"] == "POST"){

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
    
} 

header("Location: Dashboard.php");

//Check if already registered for specific event
//if not registered create entry in registration
//return to your registered events

?>