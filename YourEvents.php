<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>YourEvents</title>
        <link rel="stylesheet" href="YourEvents.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="topNav">
            <div class="active">Your Events</div>
            <div id="myLinks">
                <a href='Dashboard.php'>
                    Dashboard
                </a>
                <a href='search.php'>
                    Search Events
                </a>
                <a href='createEvent.php'>
                    Create Event
                </a>
                <a href="logout.php">
                    Sign Out 
                </a>
            </div>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <h1>Your Created Events</h1>
        <script>
            function myFunction() {
                var x = document.getElementById("myLinks");
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            }
        </script>
    </body>
</html>