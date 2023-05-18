<?php
    include_once "config.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $searchBy = $_POST['searchBy'];
        $searchBar = $_POST['searchBar'];

        //change special characters
        $searchBar = htmlspecialchars($searchBar);
        //sql injection prevention
        $searchBar = mysqli_real_escape_string($conn, $searchBar);

        if($searchBy === "title"){
            $query = "SELECT * FROM events WHERE title LIKE '%".$searchBar."%'";
            $result = mysqli_query($conn, $query);
        }
        if($searchBy === "organizer_id"){
            $searchBar = explode(" ", $searchBar);
            $query = "SELECT * FROM events JOIN users ON organizer_id=UID WHERE first_name like '%".$searchBar[0]."%' and last_name like '%".$searchBar[1]."%'";
            $result = mysqli_query($conn, $query);
        }
        if($searchBy === "date"){
            $query = "SELECT * FROM events WHERE date LIKE '%".$searchBar."%'";
            $result = mysqli_query($conn, $query);
        }
        if($searchBy === "category"){
            $query = "SELECT * FROM events WHERE title LIKE '%".$searchBar."%'";
            $result = mysqli_query($conn, $query);
        }
        if($searchBy === "no_filter"){
            $query = "SELECT * FROM events ORDER BY date";
            $result = mysqli_query($conn, $query);
        }
        
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

        <form method="POST" action="eventSearch.php" enctype="multipart/form-data">
            <div>
                <label for="searchBy">Search By:</label>
                <select name="searchBy" id="searchBy" required>
                    <option value="no_filter">No Filter</option>
                    <option value="title">Event Name</option>
                    <option value="organizer_id">Organizer Name</option>
                    <option value="date">Date (yy-mm-dd)</option>
                    <option value="category">Category</option>
                </select> 
            </div>
            <div>
                <input type="text" name="searchBar" id="searchBar" required>
            </div>
            <div><input type="submit"></div>
        </form>
        <h2 style="text-align:center;">Found Events</h2>
            <div class = "card-body">
                <table class = "table", border = "4", style = "border-color: darkblue ; margin-left: auto ; margin-right: auto ;", width = 75%>
                    <tr class = "table-header", style = "background-color: turquoise">
                        <td> Events </td>
                        <td> Description </td>
                        <td> Date </td>
                        <td> Start Time </td>
                        <td> End Time </td>
                        <td> Location </td>
                        <td> Register? </td>
                    </tr>
                    <tr>
                    <?php
                        if (mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)) {
                    ?>
                                <td><?php echo $row["title"]; ?></td>
                                <td><?php echo $row["description"]; ?></td>
                                <td><?php echo $row["date"]; ?></td>
                                <td><?php echo $row["start_time"]; ?></td>
                                <td><?php echo $row["end_time"]; ?></td>
                                <td><?php echo $row["location"]; ?></td>
                                <td><a href = "register.php?EID=<?php echo $row['EID']; ?>" class="btn btn-primary">Register</a></td>
                    </tr>    
                    <?php    
                            }
                        }
                        else {
                            echo "No events found";
                        }
                        $conn->close(); 
                    ?>
                    </tr>
                </table>     
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