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

    $EID = $_GET['EID'];

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

    $sql = "UPDATE events SET organizer_id=?, title=?, description=?, date=?, start_time=?, end_time=?, location=?, capacity=?, category=? WHERE EID='$EID'";

    $stmt = mysqli_stmt_init($conn);

    if ( ! mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "issssssii", $organizer_id, $title, $description, $date, $start_time, $end_time, $location, $capacity, $cat_id);

    mysqli_stmt_execute($stmt);

    echo "Event updated";
    header("Location: YourEvents.php");

}