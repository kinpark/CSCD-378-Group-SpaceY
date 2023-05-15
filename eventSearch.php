<?php
    include_once "config.php";

    $searchBy = $_GET['searchBy'];
    $searchBar = $_GET['searchBar'];

    //change special characters
    $searchBar = htmlspecialchars($searchBar);
    //sql injection prevention
    $searchBar = mysqli_real_escape_string($searchBar);

    if($searchBy = "title"){
        $query = "SELECT * FROM events WHERE title LIKE '%"$searchBar"%'";
        $rawResults = mysqli_query($conn, $query);
    }
    if($searchBy = "organizer_id"){
        
    }
    if($searchBy = "date"){
        
    }
    if($searchBy = "category"){
        
    }
    /*
    if (mysqli_num_rows($rawResults)>0){
        while($row = mysqli_fetch_assoc($result)) {

        }
    }
    else {
        echo "No events scheduled. Go find some!";
    }

    $conn->close(); 
    */
    
?>