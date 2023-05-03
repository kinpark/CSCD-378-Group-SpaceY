<?php
    require_once "config.php";
    $resultSet = $conn->query("SELECT name FROM event_categories")
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Create Event</title>
   <link rel="stylesheet" href="createEvent.css">
</head>
<body>
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
   
</body>
    <!--// First create a SQL Query and obtain the row 
    // select dropdown_items from table
    // Send this as an array json to JavaScript
    // Access it with jQuery & Ajax in Javascript, and then in a for loop print it out as HTML 
    // https://www.w3schools.com/html/html_form_elements.asp-->

</html>