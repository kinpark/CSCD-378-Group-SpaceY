<?php

require_once "config.php";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d', strtotime($_POST['date']));
    $start_time = strtotime($_POST['start_time']);
    $end_time = strtotime($_POST['end_time']);
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $organizer_id = $_SESSION['UID'];

    $sql = "INSERT INTO events (organizer_id, title, description, date, start_time, end_time, location, capacity) VALUES ($organizer_id, $title, $description, $date, $start_time, $end_time, $location, $capacity)";
    $query_run = mysqli_query($conn, $sql);

    if($query_run)
    {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: Dashboard.html");
    }
    else
    {
        $_SESSION['status'] = "Date values Inserting Failed";
        header("Location: Dashboard.html");
    }

}

?>