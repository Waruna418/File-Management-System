<?php
// Include config file
require_once "db_config.php";

// Check that the session
require_once ("session.php");

// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter the Reference number.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter Title of the Letter(English).";     
    } else{
        $address = $input_address;
    }
        
    // Validate address1
    $input_address1 = trim($_POST["address1"]);
    if(empty($input_address1)){
        $address1_err = "Please enter Title of the Letter(Sinhala).";     
    } else{
        $address1 = $input_address1;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the Date of receipt.";     
    } else{
        $salary = $input_salary;
    }

    // Validate salary
    $input_salary1 = trim($_POST["salary1"]);
    if(empty($input_salary1)){
        $salary_err = "Please enter the Date of Issue.";     
    } else{
        $salary1 = $input_salary1;
    }
    
    // Validate salary
    $How_received = trim($_POST["How_received"]);
    if(empty($How_received)){
        $How_received_err = "Please enter the Date of Issue.";     
    } else{
        $How_received1 = $How_received;
    }

    // Validate salary
    $Referred_Division = trim($_POST["Referred_Division"]);
    if(empty($Referred_Division)){
        $How_received_err = "Please enter the Date of Issue.";     
    } else{
        $Referred_Division1 = $Referred_Division;
    }

    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "pdf" => "application/pdf");
        $filename = $_FILES["photo"]["name"];
        $a=explode(".",$filename);
        $rfilename = "file-".time().rand(1111,9999).".".$a[count($a)-1];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("../upload/" . $rfilename)){
                $file_err = $rfilename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../upload/" . $rfilename);
                echo "Your file was uploaded successfully.";
            } 
        } else{
            $file_err = "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        $file_err = "Error: " . $_FILES["photo"]["error"];
    }

        // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO registration (Reference_number, Date_of_receipt, How_received, Referred_Division,
        S_Title_of_the_Letters, E_Title_of_the_Lettere,file ,Issue_Date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_name,$param_salary, $How_received1, $Referred_Division1,
            $param_address,$param_address1,$rfilename1,$param_salary1);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $rfilename1=$rfilename;
            $How_received1=$How_received;
            $Referred_Division1=$Referred_Division;
            $param_address1 = $address1;
            $param_salary1 = $salary1;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>