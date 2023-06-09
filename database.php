<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    //Create connection
    $conn = new mysqli($servername, $username, $password);
    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully"

    //Create database
    $sql = "CREATE DATABASE IF NOT EXISTS final_website";
    if($conn->query($sql) === TRUE){
        echo "Database created successfully";
    } else{
        echo "Error creating database: " . $conn->error;
    }
    $conn->close();

    //Re-create connection, this time connecting to the DB as well
    $dbname = "final_website";
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully"

    //Create users table
    $sql = "CREATE TABLE IF NOT EXISTS `users`(
        `UID` INT AUTO_INCREMENT PRIMARY KEY,
        `email` VARCHAR(255) UNIQUE NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `first_name` VARCHAR(50) NOT NULL,
        `last_name` VARCHAR(50) NOT NULL,
        `role` ENUM('admin', 'event_organizer', 'participant') NOT NULL DEFAULT 'participant',
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";
    if($conn->query($sql) === TRUE){
        echo "Table users created successfully";
    } else{
        echo "Error creating database: " . $conn->error;
    }

    //Create event_categories table
    $sql = "CREATE TABLE IF NOT EXISTS `event_categories`(
        `Cat_id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(50) NOT NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories created successfully";
    } else{
        echo "Error creating database: " . $conn->error;
    }
	
    //Create event table, removed this at blank line below,  `type` ENUM('Indoor', 'Outdoor', 'Online') NOT NULL,
    $sql = "CREATE TABLE IF NOT EXISTS `events`(
        `EID` INT AUTO_INCREMENT PRIMARY KEY,
		`organizer_id` INT NOT NULL,
        `title` VARCHAR(255) NOT NULL,
		`description` TEXT,
		`date` DATE NOT NULL,
		`start_time` TIME NOT NULL,
		`end_time` TIME NOT NULL,
        `location` VARCHAR(255) NOT NULL,
		`capacity` INT NOT NULL,
		`category` INT NOT NULL,
		`status` ENUM('Approved', 'Rejected', 'Pending') NOT NULL DEFAULT 'Pending',

        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`organizer_id`) REFERENCES `users`(`UID`),
        FOREIGN KEY (`category`) REFERENCES `event_categories`(`Cat_id`)
	)";
    if($conn->query($sql) === TRUE){
        echo "Table events created successfully";
    } else{
        echo "Error creating database: " . $conn->error;
    }

    //Create registration table
    $sql = "CREATE TABLE IF NOT EXISTS `registration`(
		`id` INT AUTO_INCREMENT PRIMARY KEY,
        `user_id` INT NOT NULL,
        `event_id` INT NOT NULL,
		`status` ENUM('Registered', 'Waitlist', 'Cancelled') NOT NULL DEFAULT 'Registered',
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (`user_id`) REFERENCES `users`(`UID`),
        FOREIGN KEY (`event_id`) REFERENCES `events`(`EID`)
	)";
    if($conn->query($sql) === TRUE){
        echo "Table registration created successfully";
    } else{
        echo "Error creating database: " . $conn->error;
    }
	
	//Create log table
    $sql = "CREATE TABLE IF NOT EXISTS `log`(
       `id` INT AUTO_INCREMENT PRIMARY KEY,
       `user_id` INT NOT NULL,
	   `event_id` INT NULL,
	   `action` ENUM('login', 'logout', 'register', 'create_event', 'edit_event', 'delete_event', 'approve_event', 'reject_event', 'register_for_event', 'cancel_registration', 'add_to_waitlist', 'remove_from_waitlist', 'update_profile', 'update_password', 'promote_user') NOT NULL,
	   `ip_address` VARCHAR(45) NOT NULL,
	   `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (`user_id`) REFERENCES `users`(`UID`)
	)";
	   //removed from above: FOREIGN KEY (`event_id`) REFERENCES `events`(`EID`)
    if($conn->query($sql) === TRUE){
        echo "Table log created successfully";
    } else{
        echo "Error creating database: " . $conn->error;
    }	
	
    //Fill event category table
    $sql = "INSERT INTO event_categories (name) VALUES ('Wedding');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Anniversary');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Birthday');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Barbecue');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Baby Shower');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Sporting Event');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Concert');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Reunion');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }
    $sql = "INSERT INTO event_categories (name) VALUES ('Vacation');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }

    //any other ideas above this one please
    $sql = "INSERT INTO event_categories (name) VALUES ('Other');";
    if($conn->query($sql) === TRUE){
        echo "Table event_categories updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }


    //create admin account
    $sql = "INSERT INTO users (first_name, last_name, password, email) VALUES (?, ?, ?, ?)";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssss", $param_fname, $param_lname, $param_password, $param_email);
        
        $param_fname = "admin";
        $param_lname = "admin";
        $param_password = password_hash("admin1", PASSWORD_DEFAULT); // Creates a password hash
        $param_email = "admin@admin.com";

        if($stmt->execute()){
            echo "Admin created";
        } else{
            echo "Error updating database: " . $conn->error;
        }
    }
    $sql = "UPDATE users SET role='admin' where first_name='admin';";
    if($conn->query($sql) === TRUE){
        echo "Table users updated successfully";
    } else{
        echo "Error updating database: " . $conn->error;
    }

    $conn->close();
?>

