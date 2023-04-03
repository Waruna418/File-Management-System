<?php
// Initialize the session
session_start();
// Include config file
require_once "includes/db_config.php";

// Logout State change
$sql1 = "UPDATE users SET log_state = ?, log_out_on = CURRENT_TIMESTAMP() WHERE id = ?";
        
if($stmt1 = mysqli_prepare($link, $sql1)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt1, "ii", $param_password, $param_id);
            
    // Set parameters
    $param_password = '0';
    $param_id = $_SESSION["id"];
                                               
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt1)){
        
    }mysqli_stmt_close($stmt);
} 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: login.php");
exit;
?>