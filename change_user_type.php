<?php

// Check that the session
require_once ("includes/session.php");
if(!$_SESSION['user_type']=='1'){
    header("location: index.php");
    exit;
}
// Process delete operation after confirmation
if(isset($_GET["id"]) && isset($_GET["action"]) && !empty($_GET["action"]) && !empty($_GET["id"])){
    // Include config file
    require_once "includes/db_config.php";
    
    // Prepare a delete statement
    //$sql = "DELETE FROM users WHERE id = ?";
    $sql = "UPDATE users SET user_type= ? , log_state='0' WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        //mysqli_stmt_bind_param($stmt, "i", $param_id);
        mysqli_stmt_bind_param($stmt, "ii", $user_type, $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        if(trim($_GET["action"])==='act0'){
            $user_type = '1';
        }
        else{
            $user_type = '0';
        }

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            

            header("location: admin-dash.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>