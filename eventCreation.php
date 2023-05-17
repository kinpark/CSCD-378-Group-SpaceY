<?php

require_once "config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //print_r($_POST);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d', strtotime($_POST['date']));

    $start_time = ($_POST['startTime']);
    $end_time = ($_POST['endTime']);

    //$start_time = $_POST['startTime'];
    //$end_time = $_POST['endTime'];

    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $organizer_id = $_SESSION['UID'];

    $category = $_POST['category'];
    $QueryForCat_id = $conn->query("SELECT Cat_id FROM event_categories WHERE name='$category'");
    $cat_id = 0;
    while ($row = $QueryForCat_id->fetch_assoc()){
        $cat_id = $row["Cat_id"];
    }
    //insert into events
    $sql = "INSERT INTO events (organizer_id, title, description, date, start_time, end_time, location, capacity, category) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if ( ! mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "issssssii", $organizer_id, $title, $description, $date, $start_time, $end_time, $location, $capacity, $cat_id);
    mysqli_stmt_execute($stmt);
    
    //register for your own event
    $UID = $_SESSION["UID"];
    $queryForEID = $conn->query("SELECT EID FROM events WHERE title='$title' AND description='$description'
            AND date='$date' AND start_time='$start_time' AND end_time='$end_time'
            AND location='$location' AND capacity='$capacity' AND category='$cat_id'
            AND organizer_id='$UID'");
    $EID = 0;
    while ($row = $queryForEID->fetch_assoc()){
        $EID = $row["EID"];
    }

    $sql = "INSERT INTO registration (user_id, event_id) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if ( ! mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "ii", $UID, $EID);
    mysqli_stmt_execute($stmt);

    header("Location: Dashboard.php");



    /*
    $sql = "INSERT INTO events (organizer_id, title, description, date, start_time, end_time, location, capacity) 
            VALUES ($organizer_id, '$title', '$description', $date, $start_time, $end_time, '$location', $capacity)";
    
    $query_run = mysqli_query($conn, $sql);

    if($query_run)
    {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: Dashboard.php");
    }
    else
    {
        $_SESSION['status'] = "Date values Inserting Failed";
        header("Location: Dashboard.php");
    }
    */
}

?>