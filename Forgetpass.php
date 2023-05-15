<?php

require_once "config.php";

$email = "";
$email_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } elseif(!preg_match('/^\\S+@\\S+\\.\\S+$/', trim($_POST["email"]))){   // different email validations:  /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
        $email_err = "Invalid email.";                                      // email validation 2:  /^[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM users WHERE email = ?";
    
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
        
            // Set parameters
            $param_email = trim($_POST["email"]);
        
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
            
                if($stmt->num_rows == 1){
                    //$email_err = "This email is already in use.";
                    function_alert("Password recovery email has been sent.");
                    sleep(1);
                    // Redirect to login page
                    header("location: emailsent.php");
                } else{
                    //$email = trim($_POST["email"]);
                    $email_err = "There is no account associated with this email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
}    

// PHP program to pop an alert 
function function_alert($message) {
      
    // Display the alert box 
    echo "<script>alert('$message');</script>";
}

// Function call
// function_alert("Welcome to Geeks for Geeks");  
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            </form>
        </div>
    </body>
</html>

<style>
    body {
        background: lightblue;
    }

    .resetPass {
        border: 1px solid black;
    }
</style>