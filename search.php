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
        <title>Search</title>
        <link rel="stylesheet" href="search.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="topNav">
            <div class="active">Search Events</div>
            <div id="myLinks">
                <a href='Dashboard.php'>
                    Dashboard
                </a>
                <a href='YourEvents.php'>
                    Your Events
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

        <form method="POST" action="database.php" enctype="multipart/form-data">
            <div>
                <label for="searchBy">Search By:</label>
                <input type="text" name="searchBy" id="searchBy" required>
            </div>
            <div>
                <input type="text" name="searchBar" id="searchBar" required>
            </div>
            <div><input type="submit"></div>
        </form>
        <h2>Results</h2>

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