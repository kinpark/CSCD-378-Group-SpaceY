<?php
    require_once "config.php";
    $resultSet = $conn->query("SELECT name FROM event_categories");

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
   <title>Create Event</title>
   <link rel="stylesheet" href="createEvent.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="topNav">
        <div class="active">Create Event</div>
        <div id="myLinks">
            <a href='Dashboard.php'>
                Dashboard
            </a>
            <a href='YourEvents.php'>
                Your Events
            </a>
            <a href='search.php'>
                Search Events
            </a>
            <a href="logout.php">
                    Sign Out 
                </a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
   <h1>Create Event</h1>
   
   <!-- Add the form below -->
    <form method="POST" action="eventCreation.php" enctype="multipart/form-data">
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="3" cols="50"></textarea>
        </div>
        <div>
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required>
        </div>
        <div>
            <label for="startTime">Start Time:</label>
            <input type="time" name="startTime" id="startTime" required>
        </div>
        <div>
            <label for="endTime">End Time:</label>
            <input type="time" name="endTime" id="endTime" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>
        </div>
        <div>
            <label for="capacity">Capacity:</label>
            <input type="number" name="capacity" id="capacity" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <?php
                while($rows = $resultSet->fetch_assoc()){
                    $category = $rows['name'];
                    echo "<option value='$category'>$category</option>";
                }
                ?>
        </div>
        <div><input type="submit"></div>
    </form>
   
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