<?php

// Check that the session
require_once ("includes/session.php");

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "includes/db_config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM registration WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value

                $Reference_number = $row["Reference_number"];
                $Received_number = $row["Received_number"];
                $Date_of_receipt = $row["Date_of_receipt"];
                $How_received = $row["How_received"];
                $Referred_Division= $row["Referred_Division"];
                $S_Title_of_the_Letters= $row["S_Title_of_the_Letters"];
                $E_Title_of_the_Lettere= $row["E_Title_of_the_Lettere"];
                $file= $row["file"];
                $Issue_Date= $row["Issue_Date"];
                $Calender_Date=$row["Calender_Date"];
                $Calender_For_DIG =$row["Calender_For_DIG"];
                $Officer_Name=$row["Officer_Name"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="shortcut icon" href="images/download.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Letter Details</h1>
                    <div class="form-group">
                        <label>Reference number</label>
                        <p><b><?php echo $row["Reference_number"]; ?></b></p>
                    </div>
                     <div class="form-group">
                        <label>Reference number</label>
                        <p><b><?php echo $row["Received_number"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>How received</label>
                        <p><b><?php echo $row["How_received"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Received / Referred Division</label>
                        <p><b><?php echo $row["Referred_Division"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Title of the Letter(English)</label>
                        <p><b><?php echo $row["E_Title_of_the_Lettere"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Title of the Letter(Sinhala)</label>
                        <p><b><?php echo $row["S_Title_of_the_Letters"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date of receipt / referral</label>
                        <p><b><?php echo $row["Date_of_receipt"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Soft copy of the letter Saved Name</label>
                        <p><b><?php echo $row["file"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Issue Date</label>
                        <p><b><?php echo $row["Issue_Date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Calender Date</label>
                        <p><b><?php echo $row["Calender_Date"]; ?></b></p>
                    </div>
                     <div class="form-group">
                        <label>Calender For DIG</label>
                        <p><b><?php echo $row["Calender_For_DIG"]; ?></b></p>
                    </div>
                     <div class="form-group">
                        <label>who accepted the letter</label>
                        <p><b><?php echo $row["Officer_Name"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>