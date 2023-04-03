<?php
// Initialize the session
session_start();
 

 
// Include config file
require_once "includes/db_config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$user_type= "3";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, user_type FROM users WHERE username = ? and is_active= '1'";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters 
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username , $hashed_password, $user_type);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["user_type"] = $user_type;
                            
                            $sql1 = "UPDATE users SET log_state = ? , loged_on = CURRENT_TIMESTAMP() WHERE id = ?";
        
                                if($stmt1 = mysqli_prepare($link, $sql1)){
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt1, "ii", $param_password, $param_id);
            
                                    // Set parameters
                                    $param_password = '1';
                                    $param_id = $_SESSION["id"];
                                               
                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt1)){
                                        mysqli_stmt_close($stmt);
                                    }
                                }

                            if ($user_type=='1') {
                                // Redirect user to admin dashboard page
                                header("location: admin-dash.php");
                                
                            }
                             else {
                                // Redirect user to welcome page
                                header("location: welcome.php");
                            }
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="shortcut icon" href="images/download.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"/>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <center>
    <div class="wrapper">
        <h2  style="color:#0c8604;">Disciplinary & Conduct Range Unit</h2>
       

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<div class="container">
<center><img src="images/download.jpg" class="img-fluid" alt="" width="110" height="110"></center>
</div>
 <h1 class="login-title" style="color:#0c8604;">File Management System</h1>

            <div class="form-group">
                <label style="color:#0c8604;margin-right:250px"><strong>Username</strong></label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label style="color:#0c8604;margin-right:250px"><strong>Password</strong></label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Login">
                <input type="Reset" class="btn btn-warning" value="Cancel">
            </div>
           
        </form>

    </div>
     <div class="copyrights text-center">
                    <p class="para" style="color:blue">
                        Copyright ©2021 Sri Lanka Police All rights reserved 
                       <span style="color:blue">|Designed by IT Division|</span>
                    </p>
                </div>
</body>
</html>