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

// find the role of user
$queryForRole = $conn->query("SELECT role FROM users WHERE UID=$UID");
$role = null;
while ($row = $queryForRole->fetch_assoc()){
    $role = $row["role"];
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

        <div class = "container">
            <div class = "row">
                <div class = "col">
                    <div class = "card">
                        <div class = "card-header">
                            <h2>Events you have created: </h2>
                        </div>
                        <div class = "card-body">
                            <table class = "table", border = "4", style = "border-color: darkblue ; margin-left: auto ; margin-right: auto ;", width = 75%>
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
                                        echo "You have no created events";
                                    }

                                    //$conn->close(); 
                                ?>
                                </tr>
                            </table>     
                        </div>
                    </div>
                </div>
            </div>            
        </div>

        <?php
            $query2 = "SELECT * FROM events";
            $result2 = mysqli_query($conn, $query2);
            if (mysqli_num_rows($result2) > 0 && $role == 'admin') {
                $query3 = "SELECT * FROM events";
                $result3 = mysqli_query($conn, $query3); 
        ?>
                <div >
                    <div >
                        <div >
                            <div >
                                <div id="containter2">
                                    <h2>All Events: </h2>
                                    <h4>As an admin, you have the ability to monitor, edit, and delete other user's events. </h4>
                                </div>
                                <div >
                                    <table class = "table", border = "4", style = "border-color: darkblue ; margin-left: auto ; margin-right: auto ;", width = 75%>
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
                                            if (mysqli_num_rows($result3)>0){
                                                while($row = mysqli_fetch_assoc($result3)) {
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
                                                echo "No events.";
                                            }

                                            //$conn->close(); 
                                        ?>
                                        </tr>
                                    </table>     
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            <?php
            }
            $conn->close();
            ?>


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