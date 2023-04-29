<?php
// PHP program to pop an alert
// message box on the screen
  
// Function definition
function function_alert($message) {
      
    // Display the alert box 
    echo "<script>alert('$message');</script>";
}
  
  
// Function call
function_alert("Welcome to Geeks for Geeks");
  
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>Forgotpass</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body{ font: 14px sans-serif; }
            .resetPass{ width: 600px; padding: 20px; margin: auto;}
        </style>
    </head>
    <header>

    </header>
    <body>
        <div class="resetPass">
            <h1>Forgot Your Password?</h1>
            <p>Enter your email and we will send you a password reset link.</p>
            <form method="POST" action="database.php" enctype="multipart/form-data">
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="Email" id="Email" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            </form>
        </div>
    </body>
</html>