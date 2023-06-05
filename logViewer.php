<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";
$UID = $_SESSION["UID"];
//$query = "SELECT title, description, date, start_time, end_time, location, EID FROM events JOIN registration ON EID=event_id WHERE user_id='$UID' AND registration.status='Registered' ORDER BY date;";
$query = "SELECT * FROM log;";
$result = mysqli_query($conn, $query);

// find the role of user
$queryForRole = $conn->query("SELECT role FROM users WHERE UID=$UID");
$role = null;
while ($row = $queryForRole->fetch_assoc()){
    $role = $row["role"];
}

/*
if($role != 'admin'){
    header("location: Dashboard.php");
    exit;
}
*/
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>logViewer</title>
        <link rel="stylesheet" href="Dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="topNav">
            <div class="active">Log Viewer</div>
            <div id="myLinks">
                <a href='Dashboard.php'>
                    Dashboard
                </a>
                <a href='search.php'>
                    Search Events
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
        <h1>Log viewer</h1>

        <div class = "container">
            <div class = "row">
                <div class = "col">
                    <div class = "card">
                        <div class = "card-header">
                            <h2>logs: </h2>
                        </div>
                        <div class = "card-body">
                            <table class = "table", border = "4", style = "border-color: darkblue ; margin-left: auto ; margin-right: auto ;", width = 75%>
                                <tr class = "table-header", style = "background-color: turquoise">
                                    <td> log id </td>
                                    <td> user id </td>
                                    <td> event id </td>
                                    <td> action </td>
                                    <td> ip address </td>
                                    <td> created at </td>
                                </tr>
                                <tr>
                                <?php
                                    if (mysqli_num_rows($result)>0){
                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["user_id"]; ?></td>
                                    <td><?php echo $row["event_id"]; ?></td>
                                    <td><?php echo $row["action"]; ?></td>
                                    <td><?php echo $row["ip_address"]; ?></td>
                                    <td><?php echo $row["created_at"]; ?></td>
                                </tr>    
                                <?php    
                                        }
                                    }
                                    else {
                                        echo "No events scheduled. Go find some!";
                                    }

                                    $conn->close(); 
                                ?>
                                </tr>
                            </table>     
                        </div>
                    </div>
                </div>
            </div>            
        </div>  
          

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