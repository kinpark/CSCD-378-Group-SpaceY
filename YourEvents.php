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
$query = "SELECT * FROM events WHERE organizer_id='$UID' ORDER BY date";
$result = mysqli_query($conn, $query);

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

        <div class = "container">
            <div class = "row">
                <div class = "col">
                    <div class = "card">
                        <div class = "card-header">
                            <h2>Events you have created: </h2>
                        </div>
                        <div class = "card-body">
                            <table class = "table", border = "4", style = "border-color: darkblue", width = 100%>
                                <tr class = "table-header", style = "background-color: turquoise">
                                    <td> Events </td>
                                    <td> Description </td>
                                    <td> Date </td>
                                    <td> Start Time </td>
                                    <td> End Time </td>
                                    <td> Location </td>
                                    <td> Edit </td>
                                    <td> Remove </td>
                                </tr>
                                <tr>
                                <?php
                                    if (mysqli_num_rows($result)>0){
                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <?php   //idk if i need to get rid of this php here.
                                            //echo "Event: " . $row["title"] . " - Event Description: " . $row["description"] . 
                                            //" - Date: " . $row["date"] . " - Start time: " . $row["start_time"] . " - End Time: " . 
                                            //$row["end_time"] . " - Location: " . $row["location"]. "<br>";
                                    ?>
                                    <td><?php echo $row["title"]; ?></td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td><?php echo $row["date"]; ?></td>
                                    <td><?php echo $row["start_time"]; ?></td>
                                    <td><?php echo $row["end_time"]; ?></td>
                                    <td><?php echo $row["location"]; ?></td>
                                    <td><a href = "edit.php?EID=<?php echo $row['EID']; ?>" class="btn btn-primary">Edit</a></td>
                                    <td><a href = "delete.php?EID=<?php echo $row['EID']; ?>" class="btn btn-danger">Delete</a></td>
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