<?php

	require_once 'config.php';

    $resultSet = $conn->query("SELECT * FROM event_categories");

    $EID = $_GET["EID"];
	$query = "SELECT * FROM events WHERE EID='$EID'";
	$result = mysqli_query($conn, $query);
    $row = $result->fetch_assoc()

?>
<!DOCTYPE html>
<html>
<head>
<title>Edit</title>
</head>
<body>
	<h2>Edit</h2>

    <form method="POST" action="update.php?EID=<?php echo $EID; ?>" enctype="multipart/form-data">
        <div>
            <label for="title">Title:</label>
            <input type="text" value="<?php echo $row['title']; ?>" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" placeholder="<?php echo $row['description']; ?>" id="description" rows="3" cols="50"><?php echo $row['description']; ?></textarea>
        </div>
        <div>
            <label for="date">Date:</label>
            <input type="date" value="<?php echo $row['date']; ?>" name="date" id="date" required>
        </div>
        <div>
            <label for="startTime">Start Time:</label>
            <input type="time" value="<?php echo $row['start_time']; ?>" name="startTime" id="startTime" required>
        </div>
        <div>
            <label for="endTime">End Time:</label>
            <input type="time" value="<?php echo $row['end_time']; ?>" name="endTime" id="endTime" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" value="<?php echo $row['location']; ?>" name="location" id="location" required>
        </div>
        <div>
            <label for="capacity">Capacity:</label>
            <input type="number" value="<?php echo $row['capacity']; ?>" name="capacity" id="capacity" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <select name="category" value="<?php echo $row['category']; ?>" id="category" required>
                <?php
                while($rows = $resultSet->fetch_assoc()){
                    $category = $rows['name'];
                    if($row['category'] == $rows['Cat_id']){
                        echo "<option selected='selected' value='$category'>$category</option>";
                    }
                    else {
                        echo "<option value='$category'>$category</option>";
                    }
                }
                ?>
        </div>
        <div><input type="submit"></div>
    </form>
</body>
</html>