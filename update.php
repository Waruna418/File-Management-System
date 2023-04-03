<?php

// Check that the session
require_once ("includes/session.php");

// Include config file
require_once "includes/db_config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = $name1 = $address1 = $address2 = $address3 = $address4 = $salary1 = "";
$name_err = $address_err = $address1_err = $salary_err = $Referred_Division=$How_received1= 
$Referred_Division1 = $How_received_err = $How_received_err1 = $salary_err1 =$file_err= "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter the Reference number.";
    } else{
        $name = $input_name;
    }


     $input_name1 = trim($_POST["name1"]);
    if(empty($input_name)){
        $name1_err = "Please enter the Received number.";
    } else{
        $name1 = $input_name1;
    }
    
    // Validate address
    $input_address = trim($_POST["address1"]);
    if(empty($input_address)){
        $address_err = "Please enter Title of the Letter(English).";     
    } else{
        $address = $input_address;
    }
        
    // Validate address1
    $input_address1 = trim($_POST["address"]);
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
        $salary_err1 = "Please enter the Date of Issue.";     
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
        $How_received_err1 = "Please enter the Date of Issue.";     
    } else{
        $Referred_Division1 = $Referred_Division;
    }
 
   
    $input_address2 = trim($_POST["address2"]);
    if(empty($input_address2)){
         $address2_err= "Please enter the Calender Date.";     
    } else{
        $address2 = $input_address2;
    }

    $input_address3 = trim($_POST["address3"]);
    if(empty($input_address3)){
         $address3_err= "Please enter the Calender Date.";     
    } else{
        $address3 = $input_address3;
    }

    $input_address4 = trim($_POST["address4"]);
    if(empty($input_address4)){
         $address4_err= "Please enter the Calender Date.";     
    } else{
        $address4 = $input_address4;
    }

// hand_Over_Officer
    $hand_Over_Officer = trim($_POST["hand_Over_Officer"]);
    if(empty($hand_Over_Officer)){
        $hand_Over_Officer_err = "Please enter the hand_Over_Officer.";     
    } else{
        $hand_Over_Officer1 = $hand_Over_Officer;
    }


    if($_FILES["photo"]["size"]<=0){
        $rfilename=$_POST["photo1"];
    }
    else{
        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
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
                if(file_exists("upload/" . $rfilename)){
                    $file_err = $rfilename . " is already exists.";
                } else{
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $rfilename);
                    echo "Your file was uploaded successfully.";
                } 
            } else{
                $file_err = "Error: There was a problem uploading your file. Please try again."; 
            }
        } else{
            $file_err = "Error: " . $_FILES["photo"]["error"];
        }
    }

    

    // Check input errors before inserting in database
    if(empty($name_err)){
        // Prepare an update statement
   
        $sql = "UPDATE registration SET Reference_number=?,Received_number=?,Date_of_receipt=?, How_received=? ,
        Referred_Division=?, S_Title_of_the_Letters=?, E_Title_of_the_Lettere=?, file=?,Issue_Date=?,Calender_Date=?,   Calender_For_DIG=?, Officer_Name =?
        WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssss",$param_name,$param_name1,$param_salary,$How_received1,
            $Referred_Division1, $param_address, $param_address1, $rfilename1, $param_salary1, $param_address2, $param_address3, $param_address4, $param_id);

            // Set parameters
            $param_name = $name;
            $param_name1 = $name1;
            $param_address = $address;
            $param_salary = $salary;
            $rfilename1=$rfilename;
            $How_received1=$How_received;
            $Referred_Division1=$Referred_Division;
            $param_address1 = $address1;
            $param_salary1 = $salary1;
            $param_address2 =$address2;
            $param_address3 =$address3;
            $param_address4 =$address4;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page

                header("location: index.php");
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM registration WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
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
                    $Calender_Date = $row["Calender_Date"];
                    $Calender_For_DIG = $row["Calender_For_DIG"];
                    $Officer_Name = $row["Officer_Name"];
                    $hand_Over_Officer =$row["hand_Over_Officer"];
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Letter Details</h2>
                    <p>Please edit the input values and submit to update the Letter record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" name="upadate_details" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Reference number(Our Reference)</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Reference_number; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>

                         <div class="form-group">
                            <label>Received number(Your Reference)</label>
                            <input type="text" name="name1" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Received_number; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="How_received">How received</label>
                            <select name="How_received">
                                <option value="None">None</option>
                                <option <?php $value="Letter"; echo ($How_received===$value) ? 'selected="selected"' :  ''; ?> value="Letter">Letter</option>
                                <option <?php $value="Fax"; echo ($How_received===$value) ? 'selected="selected"' :  ''; ?> value="Fax">Fax</option>
                                <option <?php $value="Petition"; echo ($How_received===$value) ? 'selected="selected"' :  ''; ?> value="Petition">Petition</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Referred_Division">Received / Referred Division</label>
                        <select name="Referred_Division">
                                <option <?php $value="Select Division or Police Station"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Select Division or Police Station">Select Division or Police Station</option>
                                <option <?php $value="Achchuveli"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Achchuveli">Achchuveli</option>
                                <option <?php $value="Agalawatta"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Agalawatta">Agalawatta</option>
                                <option <?php $value="Agarapathana"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Agarapathana">Agarapathana</option>
                                <option <?php $value="Agbopura"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Agbopura">Agbopura</option>
                                <option <?php $value="Ahangama"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ahangama">Ahangama</option>
                                <option <?php $value="Ahungalla"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ahungalla">Ahungalla</option>
                                <option <?php $value="Air Port"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Air Port">Air Port</option>
                                <option <?php $value="Aithimalaya"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Aithimalaya">Aithimalaya</option>
                                <option <?php $value="Akkaraipattu"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Akkaraipattu">Akkaraipattu</option>
                                <option <?php $value="Akkarayankulama"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Akkarayankulama">Akkarayankulama</option>
                                <option <?php $value="Akmeemana"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Akmeemana">Akmeemana</option>
                                <option <?php $value="Akuressa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Akuressa">Akuressa</option>
                                <option <?php $value="Alawathugoda"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Alawathugoda">Alawathugoda</option>
                                <option <?php $value="Alawwa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Alawwa">Alawwa</option>
                                <option <?php $value="Aluthgama"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Aluthgama">Aluthgama</option>
                                <option <?php $value="Ambagasdoowa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ambagasdoowa">Ambagasdoowa</option>
                                <option <?php $value="Ambalangoda"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ambalangoda">Ambalangoda</option>
                                <option <?php $value="Ambalantota"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ambalantota">Ambalantota</option>
                                <option <?php $value="Ambanpola"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ambanpola">Ambanpola</option>
                                <option <?php $value="Ampara"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ampara">Ampara</option>
                                <option <?php $value="Anamaduwa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Anamaduwa">Anamaduwa</option>
                                <option <?php $value="Angulana"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Angulana">Angulana</option>
                                <option <?php $value="Angunakolapelessa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Angunakolapelessa">Angunakolapelessa</option>
                                <option <?php $value="Anguruwatota"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Anguruwatota">Anguruwatota</option>
                                <option <?php $value="Ankumbura"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ankumbura">Ankumbura</option>
                                <option <?php $value="Antiquities Protection Division"; echo ($Referred_Division===$value) ? ' selected="selected"' :  ''; ?> value="Antiquities Protection Division">Antiquities Protection Division</option>
                                <option <?php $value="Anuradhapura"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Anuradhapura">Anuradhapura</option>
                                <option <?php $value="Arachchikattuwa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Arachchikattuwa">Arachchikattuwa</option>
                                <option <?php $value="Aralaganwila"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Aralaganwila">Aralaganwila</option>
                                <option <?php $value="Aranayake"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Aranayake">Aranayake</option>
                                <option <?php $value="Athurugiriya"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Athurugiriya">Athurugiriya</option>
                                <option <?php $value="Avissawella"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Avissawella">Avissawella</option>
                                <option <?php $value="Ayagama"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Ayagama">Ayagama</option>
                                <option <?php $value="B.M.I.C.H."; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="B.M.I.C.H.">B.M.I.C.H.</option>
                                <option <?php $value="Badalkumbura"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Badalkumbura">Badalkumbura</option>
                                <option <?php $value="Baddegama"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Baddegama">Baddegama</option>
                                <option <?php $value="Badulla"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Badulla">Badulla</option>
                                <option <?php $value="Baduraliya"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Baduraliya">Baduraliya</option>
                                <option <?php $value="Bakamuna"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bakamuna">Bakamuna</option>
                                <option <?php $value="Bakkiella"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bakkiella">Bakkiella</option>
                                <option <?php $value="Balangoda"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Balangoda">Balangoda</option>
                                <option <?php $value="Bambalapitiya"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bambalapitiya">Bambalapitiya</option>
                                <option <?php $value="Bandaragama"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bandaragama">Bandaragama</option>
                                <option <?php $value="Bandarawela"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bandarawela">Bandarawela</option>
                                <option <?php $value="Batapola"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Batapola">Batapola</option>
                                <option <?php $value="Batticalo"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Batticalo">Batticalo</option>
                                <option <?php $value="Beliatta"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Beliatta">Beliatta</option>
                                <option <?php $value="Bemmulla"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bemmulla">Bemmulla</option>
                                <option <?php $value="Bentota"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bentota">Bentota</option>
                                <option <?php $value="Beruwala"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Beruwala">Beruwala</option>
                                <option <?php $value="Bibila"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bibila">Bibila</option>
                                <option <?php $value="Bingiriya"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bingiriya">Bingiriya</option>
                                <option <?php $value="Biyagama"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Biyagama">Biyagama</option>
                                <option <?php $value="Bluemendhal"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bluemendhal">Bluemendhal</option>
                                <option <?php $value="Bogahakumbura"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bogahakumbura">Bogahakumbura</option>
                                <option <?php $value="Bogaswewa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bogaswewa">Bogaswewa</option>
                                <option <?php $value="Bogawantalawa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Bogawantalawa">Bogawantalawa</option>
                                <option <?php $value="Boralesgamuwa"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Boralesgamuwa">Boralesgamuwa</option>
                                <option <?php $value="Borella"; echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value="Borella">Borella</option> <option    <?php $value=  "   Bribery Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Bribery Division    "   >   Bribery Division    </option>
 <option     <?php $value=  "   Buildings Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Buildings Division  "   >   Buildings Division  </option>
 <option     <?php $value=  "   Bulathkohupitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Bulathkohupitiya    "   >   Bulathkohupitiya    </option>
 <option     <?php $value=  "   Bulathsinhala   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Bulathsinhala   "   >   Bulathsinhala   </option>
 <option     <?php $value=  "   Buttala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Buttala "   >   Buttala </option>
 <option     <?php $value=  "   Central Anti Vice Striking Force    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Central Anti Vice Striking Force    "   >   Central Anti Vice Striking Force    </option>
 <option     <?php $value=  "   Central Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Central Camp    "   >   Central Camp    </option>
 <option     <?php $value=  "   Central Province    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Central Province    "   >   Central Province    </option>
 <option     <?php $value=  "   Chawakachcheri  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Chawakachcheri  "   >   Chawakachcheri  </option>
 <option     <?php $value=  "   Chawalakade "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Chawalakade "   >   Chawalakade </option>
 <option     <?php $value=  "   Cheddikulam "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Cheddikulam "   >   Cheddikulam </option>
 <option     <?php $value=  "   Chilaw  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Chilaw  "   >   Chilaw  </option>
 <option     <?php $value=  "   Children  &  Women Bureau   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Children  &  Women Bureau   "   >   Children  &  Women Bureau   </option>
 <option     <?php $value=  "   China Bay   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   China Bay   "   >   China Bay   </option>
 <option     <?php $value=  "   Chunnakam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Chunnakam   "   >   Chunnakam   </option>
 <option     <?php $value=  "   Cinamon Garden  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Cinamon Garden  "   >   Cinamon Garden  </option>
 <option     <?php $value=  "   Civil Security Department   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Civil Security Department   "   >   Civil Security Department   </option>
 <option     <?php $value=  "   Close Circuit Television    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Close Circuit Television    "   >   Close Circuit Television    </option>
 <option     <?php $value=  "   Colombo Central "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Colombo Central "   >   Colombo Central </option>
 <option     <?php $value=  "   Colombo City Traffic    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Colombo City Traffic    "   >   Colombo City Traffic    </option>
 <option     <?php $value=  "   Colombo Crimes Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Colombo Crimes Division "   >   Colombo Crimes Division </option>
 <option     <?php $value=  "   Colombo Fraud Investigation Bureau  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Colombo Fraud Investigation Bureau  "   >   Colombo Fraud Investigation Bureau  </option>
 <option     <?php $value=  "   Colombo North   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Colombo North   "   >   Colombo North   </option>
 <option     <?php $value=  "   Colombo South   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Colombo South   "   >   Colombo South   </option>
 <option     <?php $value=  "   Communication   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Communication   "   >   Communication   </option>
 <option     <?php $value=  "   Community Policing  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Community Policing  "   >   Community Policing  </option>
 <option     <?php $value=  "   Crime Detective Bureau  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Crime Detective Bureau  "   >   Crime Detective Bureau  </option>
 <option     <?php $value=  "   Crimes Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Crimes Division "   >   Crimes Division </option>
 <option     <?php $value=  "   Criminal Investigation Department   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Criminal Investigation Department   "   >   Criminal Investigation Department   </option>
 <option     <?php $value=  "   Criminal Record Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Criminal Record Division    "   >   Criminal Record Division    </option>
 <option     <?php $value=  "   Dahrmapuram "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dahrmapuram "   >   Dahrmapuram </option>
 <option     <?php $value=  "   Daladamaligawa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Daladamaligawa  "   >   Daladamaligawa  </option>
 <option     <?php $value=  "   Dam Street  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dam Street  "   >   Dam Street  </option>
 <option     <?php $value=  "   Damana  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Damana  "   >   Damana  </option>
 <option     <?php $value=  "   Dambagalla  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dambagalla  "   >   Dambagalla  </option>
 <option     <?php $value=  "   Dambulla    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dambulla    "   >   Dambulla    </option>
 <option     <?php $value=  "   Dankotuwa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dankotuwa   "   >   Dankotuwa   </option>
 <option     <?php $value=  "   Daulagala   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Daulagala   "   >   Daulagala   </option>
 <option     <?php $value=  "   Dayagama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dayagama    "   >   Dayagama    </option>
 <option     <?php $value=  "   Dedigama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dedigama    "   >   Dedigama    </option>
 <option     <?php $value=  "   Dehiattakandiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dehiattakandiya "   >   Dehiattakandiya </option>
 <option     <?php $value=  "   Dehiwela    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dehiwela    "   >   Dehiwela    </option>
 <option     <?php $value=  "   Deiyandara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Deiyandara  "   >   Deiyandara  </option>
 <option     <?php $value=  "   Delft   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Delft   "   >   Delft   </option>
 <option     <?php $value=  "   Dematagoda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dematagoda  "   >   Dematagoda  </option>
 <option     <?php $value=  "   Deniyaya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Deniyaya    "   >   Deniyaya    </option>
 <option     <?php $value=  "   Deplometic Security Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Deplometic Security Division    "   >   Deplometic Security Division    </option>
 <option     <?php $value=  "   Deraniyagala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Deraniyagala    "   >   Deraniyagala    </option>
 <option     <?php $value=  "   Dikwella    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dikwella    "   >   Dikwella    </option>
 <option     <?php $value=  "   Dimbula "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dimbula "   >   Dimbula </option>
 <option     <?php $value=  "   Discipline & Conduct    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Discipline & Conduct    "   >   Discipline & Conduct    </option>
 <option     <?php $value=  "   Divulapitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Divulapitiya    "   >   Divulapitiya    </option>
 <option     <?php $value=  "   Diyatalawa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Diyatalawa  "   >   Diyatalawa  </option>
 <option     <?php $value=  "   Dodangoda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dodangoda   "   >   Dodangoda   </option>
 <option     <?php $value=  "   Dompe   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dompe   "   >   Dompe   </option>
 <option     <?php $value=  "   Dummalasuriya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dummalasuriya   "   >   Dummalasuriya   </option>
 <option     <?php $value=  "   Dungalpitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Dungalpitiya    "   >   Dungalpitiya    </option>
 <option     <?php $value=  "   Eastern Province    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Eastern Province    "   >   Eastern Province    </option>
 <option     <?php $value=  "   Echchcankulama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Echchcankulama  "   >   Echchcankulama  </option>
 <option     <?php $value=  "   Egodauyana  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Egodauyana  "   >   Egodauyana  </option>
 <option     <?php $value=  "   Eheliyagoda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Eheliyagoda "   >   Eheliyagoda </option>
 <option     <?php $value=  "   Election Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Election Division   "   >   Election Division   </option>
 <option     <?php $value=  "   Ella    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ella    "   >   Ella    </option>
 <option     <?php $value=  "   Elpitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Elpitiya    "   >   Elpitiya    </option>
 <option     <?php $value=  "   Elpitiya Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Elpitiya Division   "   >   Elpitiya Division   </option>
 <option     <?php $value=  "   Embilipitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Embilipitiya    "   >   Embilipitiya    </option>
 <option     <?php $value=  "   Emergency   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Emergency   "   >   Emergency   </option>
 <option     <?php $value=  "   Environment Protection  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Environment Protection  "   >   Environment Protection  </option>
 <option     <?php $value=  "   Eppawala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Eppawala    "   >   Eppawala    </option>
 <option     <?php $value=  "   Eravur  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Eravur  "   >   Eravur  </option>
 <option     <?php $value=  "   Etampitiya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Etampitiya  "   >   Etampitiya  </option>
 <option     <?php $value=  "   Ethimale    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ethimale    "   >   Ethimale    </option>
 <option     <?php $value=  "   Ex. Presidential Security Division I    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ex. Presidential Security Division I    "   >   Ex. Presidential Security Division I    </option>
 <option     <?php $value=  "   Ex. Presidential Security Division Il   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ex. Presidential Security Division Il   "   >   Ex. Presidential Security Division Il   </option>
 <option     <?php $value=  "   Ex. Presidential Security Division Ill  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ex. Presidential Security Division Ill  "   >   Ex. Presidential Security Division Ill  </option>
 <option     <?php $value=  "   Ex. Presidential Security Division IV   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ex. Presidential Security Division IV   "   >   Ex. Presidential Security Division IV   </option>
 <option     <?php $value=  "   Ex. Presidential Security Division V    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ex. Presidential Security Division V    "   >   Ex. Presidential Security Division V    </option>
 <option     <?php $value=  "   Ex. Presidential Security Division Vi   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ex. Presidential Security Division Vi   "   >   Ex. Presidential Security Division Vi   </option>
 <option     <?php $value=  "   Exam Divison    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Exam Divison    "   >   Exam Divison    </option>
 <option     <?php $value=  "   Express Highway "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Express Highway "   >   Express Highway </option>
 <option     <?php $value=  "   Field Force Headquarters    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Field Force Headquarters    "   >   Field Force Headquarters    </option>
 <option     <?php $value=  "   Financial Crimes Investigation  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Financial Crimes Investigation  "   >   Financial Crimes Investigation  </option>
 <option     <?php $value=  "   Foreshore   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Foreshore   "   >   Foreshore   </option>
 <option     <?php $value=  "   Fort    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Fort    "   >   Fort    </option>
 <option     <?php $value=  "   Galagedara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galagedara  "   >   Galagedara  </option>
 <option     <?php $value=  "   Galaha  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galaha  "   >   Galaha  </option>
 <option     <?php $value=  "   Galenbindunuwewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galenbindunuwewa    "   >   Galenbindunuwewa    </option>
 <option     <?php $value=  "   Galewela    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galewela    "   >   Galewela    </option>
 <option     <?php $value=  "   Galgamuwa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galgamuwa   "   >   Galgamuwa   </option>
 <option     <?php $value=  "   Galkiriyagama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galkiriyagama   "   >   Galkiriyagama   </option>
 <option     <?php $value=  "   Galle   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galle   "   >   Galle   </option>
 <option     <?php $value=  "   Galle Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galle Division  "   >   Galle Division  </option>
 <option     <?php $value=  "   Galle Harbour   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galle Harbour   "   >   Galle Harbour   </option>
 <option     <?php $value=  "   Galnewa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Galnewa "   >   Galnewa </option>
 <option     <?php $value=  "   Gampaha "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gampaha "   >   Gampaha </option>
 <option     <?php $value=  "   Gampaha Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gampaha Division    "   >   Gampaha Division    </option>
 <option     <?php $value=  "   Gampola "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gampola "   >   Gampola </option>
 <option     <?php $value=  "   Gampola Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gampola Division    "   >   Gampola Division    </option>
 <option     <?php $value=  "   Gandara "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gandara "   >   Gandara </option>
 <option     <?php $value=  "   Ganemulla   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ganemulla   "   >   Ganemulla   </option>
 <option     <?php $value=  "   Ginigathhena    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ginigathhena    "   >   Ginigathhena    </option>
 <option     <?php $value=  "   Girandurukotta  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Girandurukotta  "   >   Girandurukotta  </option>
 <option     <?php $value=  "   Giribawa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Giribawa    "   >   Giribawa    </option>
 <option     <?php $value=  "   Giriulla    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Giriulla    "   >   Giriulla    </option>
 <option     <?php $value=  "   Godakawela  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Godakawela  "   >   Godakawela  </option>
 <option     <?php $value=  "   Gokarella   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gokarella   "   >   Gokarella   </option>
 <option     <?php $value=  "   Gomarankadawala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gomarankadawala "   >   Gomarankadawala </option>
 <option     <?php $value=  "   Gonaganara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gonaganara  "   >   Gonaganara  </option>
 <option     <?php $value=  "   Gothatuwa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Gothatuwa   "   >   Gothatuwa   </option>
 <option     <?php $value=  "   Govindupura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Govindupura "   >   Govindupura </option>
 <option     <?php $value=  "   Grandpass   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Grandpass   "   >   Grandpass   </option>
 <option     <?php $value=  "   Habaraduwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Habaraduwa  "   >   Habaraduwa  </option>
 <option     <?php $value=  "   Habarana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Habarana    "   >   Habarana    </option>
 <option     <?php $value=  "   Hakmana "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hakmana "   >   Hakmana </option>
 <option     <?php $value=  "   Haldummulla "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Haldummulla "   >   Haldummulla </option>
 <option     <?php $value=  "   Haliella    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Haliella    "   >   Haliella    </option>
 <option     <?php $value=  "   Hambantota  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hambantota  "   >   Hambantota  </option>
 <option     <?php $value=  "   Hambegamuwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hambegamuwa "   >   Hambegamuwa </option>
 <option     <?php $value=  "   Hanguranketha   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hanguranketha   "   >   Hanguranketha   </option>
 <option     <?php $value=  "   Hanwella    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hanwella    "   >   Hanwella    </option>
 <option     <?php $value=  "   Haputale    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Haputale    "   >   Haputale    </option>
 <option     <?php $value=  "   Harbour "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Harbour "   >   Harbour </option>
 <option     <?php $value=  "   Hasalaka    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hasalaka    "   >   Hasalaka    </option>
 <option     <?php $value=  "   Hataraliyadda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hataraliyadda   "   >   Hataraliyadda   </option>
 <option     <?php $value=  "   Hatton  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hatton  "   >   Hatton  </option>
 <option     <?php $value=  "   Hatton Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hatton Division "   >   Hatton Division </option>
 <option     <?php $value=  "   Hemmathagama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hemmathagama    "   >   Hemmathagama    </option>
 <option     <?php $value=  "   Hettipola   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hettipola   "   >   Hettipola   </option>
 <option     <?php $value=  "   Hidogama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hidogama    "   >   Hidogama    </option>
 <option     <?php $value=  "   Hikkaduwa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hikkaduwa   "   >   Hikkaduwa   </option>
 <option     <?php $value=  "   Hingurakgoda    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hingurakgoda    "   >   Hingurakgoda    </option>
 <option     <?php $value=  "   Hiniduma    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hiniduma    "   >   Hiniduma    </option>
 <option     <?php $value=  "   Homagama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Homagama    "   >   Homagama    </option>
 <option     <?php $value=  "   Horana  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Horana  "   >   Horana  </option>
 <option     <?php $value=  "   Horowpathana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Horowpathana    "   >   Horowpathana    </option>
 <option     <?php $value=  "   Human Resource Management Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Human Resource Management Division  "   >   Human Resource Management Division  </option>
 <option     <?php $value=  "   Human Rights    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Human Rights    "   >   Human Rights    </option>
 <option     <?php $value=  "   Hungama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Hungama "   >   Hungama </option>
 <option     <?php $value=  "   IGs Command & Information   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   IGs Command & Information   "   >   IGs Command & Information   </option>
 <option     <?php $value=  "   Illavali    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Illavali    "   >   Illavali    </option>
 <option     <?php $value=  "   Illuppakadawai  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Illuppakadawai  "   >   Illuppakadawai  </option>
 <option     <?php $value=  "   Imaduwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Imaduwa "   >   Imaduwa </option>
 <option     <?php $value=  "   Information Technology Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Information Technology Division "   >   Information Technology Division </option>
 <option     <?php $value=  "   Inginiyagala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Inginiyagala    "   >   Inginiyagala    </option>
 <option     <?php $value=  "   Ingiriya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ingiriya    "   >   Ingiriya    </option>
 <option     <?php $value=  "   Inservice Anuradhapura  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Inservice Anuradhapura  "   >   Inservice Anuradhapura  </option>
 <option     <?php $value=  "   Inservice Neeththa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Inservice Neeththa  "   >   Inservice Neeththa  </option>
 <option     <?php $value=  "   Inspection & Reaview    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Inspection & Reaview    "   >   Inspection & Reaview    </option>
 <option     <?php $value=  "   Ipalogama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ipalogama   "   >   Ipalogama   </option>
 <option     <?php $value=  "   Irattaperiyakulam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Irattaperiyakulam   "   >   Irattaperiyakulam   </option>
 <option     <?php $value=  "   Ja-Ela  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ja-Ela  "   >   Ja-Ela  </option>
 <option     <?php $value=  "   Jaffna  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Jaffna  "   >   Jaffna  </option>
 <option     <?php $value=  "   Jaffna Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Jaffna Division "   >   Jaffna Division </option>
 <option     <?php $value=  "   Jayapuram   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Jayapuram   "   >   Jayapuram   </option>
 <option     <?php $value=  "   Judicial Security Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Judicial Security Division  "   >   Judicial Security Division  </option>
 <option     <?php $value=  "   K.K.S.  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   K.K.S.  "   >   K.K.S.  </option>
 <option     <?php $value=  "   Kadawatha   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kadawatha   "   >   Kadawatha   </option>
 <option     <?php $value=  "   Kadugannawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kadugannawa "   >   Kadugannawa </option>
 <option     <?php $value=  "   Kahatagasdigiliya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kahatagasdigiliya   "   >   Kahatagasdigiliya   </option>
 <option     <?php $value=  "   Kahatuduwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kahatuduwa  "   >   Kahatuduwa  </option>
 <option     <?php $value=  "   Kahawatte   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kahawatte   "   >   Kahawatte   </option>
 <option     <?php $value=  "   Kalawana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalawana    "   >   Kalawana    </option>
 <option     <?php $value=  "   Kalawanchikudy  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalawanchikudy  "   >   Kalawanchikudy  </option>
 <option     <?php $value=  "   Kalkudha    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalkudha    "   >   Kalkudha    </option>
 <option     <?php $value=  "   Kalmunai    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalmunai    "   >   Kalmunai    </option>
 <option     <?php $value=  "   Kalpitiya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalpitiya   "   >   Kalpitiya   </option>
 <option     <?php $value=  "   Kaltota "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kaltota "   >   Kaltota </option>
 <option     <?php $value=  "   Kalutara    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalutara    "   >   Kalutara    </option>
 <option     <?php $value=  "   Kalutara Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalutara Division   "   >   Kalutara Division   </option>
 <option     <?php $value=  "   Kalutara North  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalutara North  "   >   Kalutara North  </option>
 <option     <?php $value=  "   Kalutara South  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kalutara South  "   >   Kalutara South  </option>
 <option     <?php $value=  "   Kamburupitiya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kamburupitiya   "   >   Kamburupitiya   </option>
 <option     <?php $value=  "   Kanagarayankulam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kanagarayankulam    "   >   Kanagarayankulam    </option>
 <option     <?php $value=  "   Kananke "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kananke "   >   Kananke </option>
 <option     <?php $value=  "   Kandaketiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kandaketiya "   >   Kandaketiya </option>
 <option     <?php $value=  "   Kandana "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kandana "   >   Kandana </option>
 <option     <?php $value=  "   Kandapola   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kandapola   "   >   Kandapola   </option>
 <option     <?php $value=  "   Kandy   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kandy   "   >   Kandy   </option>
 <option     <?php $value=  "   Kandy Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kandy Division  "   >   Kandy Division  </option>
 <option     <?php $value=  "   Kantale "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kantale "   >   Kantale </option>
 <option     <?php $value=  "   Kantale Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kantale Division    "   >   Kantale Division    </option>
 <option     <?php $value=  "   Karadiyanaru    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Karadiyanaru    "   >   Karadiyanaru    </option>
 <option     <?php $value=  "   Karandeniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Karandeniya "   >   Karandeniya </option>
 <option     <?php $value=  "   Karandugala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Karandugala "   >   Karandugala </option>
 <option     <?php $value=  "   Karuwalagaswewa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Karuwalagaswewa "   >   Karuwalagaswewa </option>
 <option     <?php $value=  "   Katana  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Katana  "   >   Katana  </option>
 <option     <?php $value=  "   Kataragama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kataragama  "   >   Kataragama  </option>
 <option     <?php $value=  "   Kathankudy  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kathankudy  "   >   Kathankudy  </option>
 <option     <?php $value=  "   Katugastota "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Katugastota "   >   Katugastota </option>
 <option     <?php $value=  "   Katunayaka  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Katunayaka  "   >   Katunayaka  </option>
 <option     <?php $value=  "   Katupotha   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Katupotha   "   >   Katupotha   </option>
 <option     <?php $value=  "   Katuwana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Katuwana    "   >   Katuwana    </option>
 <option     <?php $value=  "   Kayts   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kayts   "   >   Kayts   </option>
 <option     <?php $value=  "   Kebithigollewa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kebithigollewa  "   >   Kebithigollewa  </option>
 <option     <?php $value=  "   Kegalle "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kegalle "   >   Kegalle </option>
 <option     <?php $value=  "   Kegalle Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kegalle Division    "   >   Kegalle Division    </option>
 <option     <?php $value=  "   Kekirawa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kekirawa    "   >   Kekirawa    </option>
 <option     <?php $value=  "   Kelanithissa Power Station  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kelanithissa Power Station  "   >   Kelanithissa Power Station  </option>
 <option     <?php $value=  "   Kelaniya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kelaniya    "   >   Kelaniya    </option>
 <option     <?php $value=  "   Kelaniya Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kelaniya Division   "   >   Kelaniya Division   </option>
 <option     <?php $value=  "   Kennels "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kennels "   >   Kennels </option>
 <option     <?php $value=  "   Keragala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Keragala    "   >   Keragala    </option>
 <option     <?php $value=  "   Keselwatta  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Keselwatta  "   >   Keselwatta  </option>
 <option     <?php $value=  "   Kilinochchi "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kilinochchi "   >   Kilinochchi </option>
 <option     <?php $value=  "   Kilinochchi Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kilinochchi Division    "   >   Kilinochchi Division    </option>
 <option     <?php $value=  "   Kinniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kinniya "   >   Kinniya </option>
 <option     <?php $value=  "   Kiribathgoda    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kiribathgoda    "   >   Kiribathgoda    </option>
 <option     <?php $value=  "   Kiriella    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kiriella    "   >   Kiriella    </option>
 <option     <?php $value=  "   Kirinda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kirinda "   >   Kirinda </option>
 <option     <?php $value=  "   Kirindiwela "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kirindiwela "   >   Kirindiwela </option>
 <option     <?php $value=  "   Kirulapone  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kirulapone  "   >   Kirulapone  </option>
 <option     <?php $value=  "   Kithulgala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kithulgala  "   >   Kithulgala  </option>
 <option     <?php $value=  "   KKS Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   KKS Division    "   >   KKS Division    </option>
 <option     <?php $value=  "   Kobeigane   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kobeigane   "   >   Kobeigane   </option>
 <option     <?php $value=  "   Kochchikade "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kochchikade "   >   Kochchikade </option>
 <option     <?php $value=  "   Kodikamam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kodikamam   "   >   Kodikamam   </option>
 <option     <?php $value=  "   Kohuwala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kohuwala    "   >   Kohuwala    </option>
 <option     <?php $value=  "   Kokkadicholai   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kokkadicholai   "   >   Kokkadicholai   </option>
 <option     <?php $value=  "   Kollupitiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kollupitiya "   >   Kollupitiya </option>
 <option     <?php $value=  "   Kolonna "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kolonna "   >   Kolonna </option>
 <option     <?php $value=  "   Kopai   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kopai   "   >   Kopai   </option>
 <option     <?php $value=  "   Kosgama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kosgama "   >   Kosgama </option>
 <option     <?php $value=  "   Kosgoda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kosgoda "   >   Kosgoda </option>
 <option     <?php $value=  "   Koslanda    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Koslanda    "   >   Koslanda    </option>
 <option     <?php $value=  "   Kosmodara   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kosmodara   "   >   Kosmodara   </option>
 <option     <?php $value=  "   Koswatte    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Koswatte    "   >   Koswatte    </option>
 <option     <?php $value=  "   Kotadeniyawa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kotadeniyawa    "   >   Kotadeniyawa    </option>
 <option     <?php $value=  "   Kotagala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kotagala    "   >   Kotagala    </option>
 <option     <?php $value=  "   Kotahena    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kotahena    "   >   Kotahena    </option>
 <option     <?php $value=  "   Kotavila    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kotavila    "   >   Kotavila    </option>
 <option     <?php $value=  "   Kotawehera  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kotawehera  "   >   Kotawehera  </option>
 <option     <?php $value=  "   Kothmale    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kothmale    "   >   Kothmale    </option>
 <option     <?php $value=  "   Kottawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kottawa "   >   Kottawa </option>
 <option     <?php $value=  "   Kuchchaveli "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kuchchaveli "   >   Kuchchaveli </option>
 <option     <?php $value=  "   Kudaoya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kudaoya "   >   Kudaoya </option>
 <option     <?php $value=  "   Kuliyapitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kuliyapitiya    "   >   Kuliyapitiya    </option>
 <option     <?php $value=  "   Kuliyapitiya Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kuliyapitiya Division   "   >   Kuliyapitiya Division   </option>
 <option     <?php $value=  "   Kumbukgete  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kumbukgete  "   >   Kumbukgete  </option>
 <option     <?php $value=  "   Kurunegala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kurunegala  "   >   Kurunegala  </option>
 <option     <?php $value=  "   Kurunegala Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kurunegala Division "   >   Kurunegala Division </option>
 <option     <?php $value=  "   Kuruwita    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kuruwita    "   >   Kuruwita    </option>
 <option     <?php $value=  "   Kuttigala   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Kuttigala   "   >   Kuttigala   </option>
 <option     <?php $value=  "   Laggala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Laggala "   >   Laggala </option>
 <option     <?php $value=  "   Legal Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Legal Division  "   >   Legal Division  </option>
 <option     <?php $value=  "   Lindula "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Lindula "   >   Lindula </option>
 <option     <?php $value=  "   Lunugala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Lunugala    "   >   Lunugala    </option>
 <option     <?php $value=  "   Lunugamwehera   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Lunugamwehera   "   >   Lunugamwehera   </option>
 <option     <?php $value=  "   Madampe "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Madampe "   >   Madampe </option>
 <option     <?php $value=  "   Madolsima   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Madolsima   "   >   Madolsima   </option>
 <option     <?php $value=  "   Madu    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Madu    "   >   Madu    </option>
 <option     <?php $value=  "   Madukanda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Madukanda   "   >   Madukanda   </option>
 <option     <?php $value=  "   Maha Oya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Maha Oya    "   >   Maha Oya    </option>
 <option     <?php $value=  "   Mahabage    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mahabage    "   >   Mahabage    </option>
 <option     <?php $value=  "   Mahakalugolla   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mahakalugolla   "   >   Mahakalugolla   </option>
 <option     <?php $value=  "   Maharagama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Maharagama  "   >   Maharagama  </option>
 <option     <?php $value=  "   Mahavilachchiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mahavilachchiya "   >   Mahavilachchiya </option>
 <option     <?php $value=  "   Mahawela    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mahawela    "   >   Mahawela    </option>
 <option     <?php $value=  "   Mahiyanganaya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mahiyanganaya   "   >   Mahiyanganaya   </option>
 <option     <?php $value=  "   Maho    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Maho    "   >   Maho    </option>
 <option     <?php $value=  "   Maligawatta "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Maligawatta "   >   Maligawatta </option>
 <option     <?php $value=  "   Malimbada   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Malimbada   "   >   Malimbada   </option>
 <option     <?php $value=  "   Mallavi "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mallavi "   >   Mallavi </option>
 <option     <?php $value=  "   Malwathu Hiripitiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Malwathu Hiripitiya "   >   Malwathu Hiripitiya </option>
 <option     <?php $value=  "   Mamaduwa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mamaduwa    "   >   Mamaduwa    </option>
 <option     <?php $value=  "   Management & Development    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Management & Development    "   >   Management & Development    </option>
 <option     <?php $value=  "   Mandaramnuwara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mandaramnuwara  "   >   Mandaramnuwara  </option>
 <option     <?php $value=  "   Mangalagama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mangalagama "   >   Mangalagama </option>
 <option     <?php $value=  "   Manipay "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Manipay "   >   Manipay </option>
 <option     <?php $value=  "   Mankulam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mankulam    "   >   Mankulam    </option>
 <option     <?php $value=  "   Mannar  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mannar  "   >   Mannar  </option>
 <option     <?php $value=  "   Mannar Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mannar Division "   >   Mannar Division </option>
 <option     <?php $value=  "   Maradana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Maradana    "   >   Maradana    </option>
 <option     <?php $value=  "   Marawila    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Marawila    "   >   Marawila    </option>
 <option     <?php $value=  "   Marine Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Marine Division "   >   Marine Division </option>
 <option     <?php $value=  "   Maskeliya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Maskeliya   "   >   Maskeliya   </option>
 <option     <?php $value=  "   Matale  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Matale  "   >   Matale  </option>
 <option     <?php $value=  "   Matale Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Matale Division "   >   Matale Division </option>
 <option     <?php $value=  "   Matara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Matara  "   >   Matara  </option>
 <option     <?php $value=  "   Matara Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Matara Division "   >   Matara Division </option>
 <option     <?php $value=  "   Mathurata   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mathurata   "   >   Mathurata   </option>
 <option     <?php $value=  "   Mattakkuliya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mattakkuliya    "   >   Mattakkuliya    </option>
 <option     <?php $value=  "   Mattegoda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mattegoda   "   >   Mattegoda   </option>
 <option     <?php $value=  "   Matugama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Matugama    "   >   Matugama    </option>
 <option     <?php $value=  "   Mawanella   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mawanella   "   >   Mawanella   </option>
 <option     <?php $value=  "   Mawarala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mawarala    "   >   Mawarala    </option>
 <option     <?php $value=  "   Mawathagama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mawathagama "   >   Mawathagama </option>
 <option     <?php $value=  "   Medagama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Medagama    "   >   Medagama    </option>
 <option     <?php $value=  "   Medawachchiya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Medawachchiya   "   >   Medawachchiya   </option>
 <option     <?php $value=  "   Medirigiriya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Medirigiriya    "   >   Medirigiriya    </option>
 <option     <?php $value=  "   Meegahathenna   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Meegahathenna   "   >   Meegahathenna   </option>
 <option     <?php $value=  "   Meegahawatta    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Meegahawatta    "   >   Meegahawatta    </option>
 <option     <?php $value=  "   Meegalewa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Meegalewa   "   >   Meegalewa   </option>
 <option     <?php $value=  "   Meepe   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Meepe   "   >   Meepe   </option>
 <option     <?php $value=  "   Meetiyagoda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Meetiyagoda "   >   Meetiyagoda </option>
 <option     <?php $value=  "   Menikhinna  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Menikhinna  "   >   Menikhinna  </option>
 <option     <?php $value=  "   Middeniya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Middeniya   "   >   Middeniya   </option>
 <option     <?php $value=  "   Mihintale   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mihintale   "   >   Mihintale   </option>
 <option     <?php $value=  "   Millaniya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Millaniya   "   >   Millaniya   </option>
 <option     <?php $value=  "   Ministers Security Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ministers Security Division "   >   Ministers Security Division </option>
 <option     <?php $value=  "   Ministry Co-Ordinating Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ministry Co-Ordinating Division "   >   Ministry Co-Ordinating Division </option>
 <option     <?php $value=  "   Minneriya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Minneriya   "   >   Minneriya   </option>
 <option     <?php $value=  "   Minuwangoda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Minuwangoda "   >   Minuwangoda </option>
 <option     <?php $value=  "   Mirigama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mirigama    "   >   Mirigama    </option>
 <option     <?php $value=  "   Mirihana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mirihana    "   >   Mirihana    </option>
 <option     <?php $value=  "   Mirihana Crime Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mirihana Crime Division "   >   Mirihana Crime Division </option>
 <option     <?php $value=  "   Modara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Modara  "   >   Modara  </option>
 <option     <?php $value=  "   Monaragala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Monaragala  "   >   Monaragala  </option>
 <option     <?php $value=  "   Monaragala Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Monaragala Division "   >   Monaragala Division </option>
 <option     <?php $value=  "   Moragahahena    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Moragahahena    "   >   Moragahahena    </option>
 <option     <?php $value=  "   Moragoda    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Moragoda    "   >   Moragoda    </option>
 <option     <?php $value=  "   Moratumulla "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Moratumulla "   >   Moratumulla </option>
 <option     <?php $value=  "   Moratuwa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Moratuwa    "   >   Moratuwa    </option>
 <option     <?php $value=  "   Morawaka    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Morawaka    "   >   Morawaka    </option>
 <option     <?php $value=  "   Morawewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Morawewa    "   >   Morawewa    </option>
 <option     <?php $value=  "   Moronthuduwa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Moronthuduwa    "   >   Moronthuduwa    </option>
 <option     <?php $value=  "   Mounted Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mounted Division    "   >   Mounted Division    </option>
 <option     <?php $value=  "   Mt. Lavinia "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mt. Lavinia "   >   Mt. Lavinia </option>
 <option     <?php $value=  "   MTC Akuramboda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   MTC Akuramboda  "   >   MTC Akuramboda  </option>
 <option     <?php $value=  "   MTC Dewahoowa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   MTC Dewahoowa   "   >   MTC Dewahoowa   </option>
 <option     <?php $value=  "   MTC Madampe "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   MTC Madampe "   >   MTC Madampe </option>
 <option     <?php $value=  "   MTC Madampe "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   MTC Madampe "   >   MTC Madampe </option>
 <option     <?php $value=  "   MTC Mahiyangana "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   MTC Mahiyangana "   >   MTC Mahiyangana </option>
 <option     <?php $value=  "   MTC Pahalagama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   MTC Pahalagama  "   >   MTC Pahalagama  </option>
 <option     <?php $value=  "   MTC Uva Kuda Oya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   MTC Uva Kuda Oya    "   >   MTC Uva Kuda Oya    </option>
 <option     <?php $value=  "   Mulalliyaweli   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mulalliyaweli   "   >   Mulalliyaweli   </option>
 <option     <?php $value=  "   Mulankavil  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mulankavil  "   >   Mulankavil  </option>
 <option     <?php $value=  "   Mulathivu   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mulathivu   "   >   Mulathivu   </option>
 <option     <?php $value=  "   Mulathivu Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mulathivu Division  "   >   Mulathivu Division  </option>
 <option     <?php $value=  "   Mulleriyawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mulleriyawa "   >   Mulleriyawa </option>
 <option     <?php $value=  "   Mundal  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Mundal  "   >   Mundal  </option>
 <option     <?php $value=  "   Murunkan    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Murunkan    "   >   Murunkan    </option>
 <option     <?php $value=  "   Muttur  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Muttur  "   >   Muttur  </option>
 <option     <?php $value=  "   Nachchikuda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nachchikuda "   >   Nachchikuda </option>
 <option     <?php $value=  "   Nagoda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nagoda  "   >   Nagoda  </option>
 <option     <?php $value=  "   Nallathanniya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nallathanniya   "   >   Nallathanniya   </option>
 <option     <?php $value=  "   Nanu-Oya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nanu-Oya    "   >   Nanu-Oya    </option>
 <option     <?php $value=  "   Narahenpita "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Narahenpita "   >   Narahenpita </option>
 <option     <?php $value=  "   Narammala   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Narammala   "   >   Narammala   </option>
 <option     <?php $value=  "   Narcotics Bureau    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Narcotics Bureau    "   >   Narcotics Bureau    </option>
 <option     <?php $value=  "   National Police Academy "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   National Police Academy "   >   National Police Academy </option>
 <option     <?php $value=  "   National Police Academy - Inservice "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   National Police Academy - Inservice "   >   National Police Academy - Inservice </option>
 <option     <?php $value=  "   Naula   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Naula   "   >   Naula   </option>
 <option     <?php $value=  "   Nawa Kurunduwatta   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nawa Kurunduwatta   "   >   Nawa Kurunduwatta   </option>
 <option     <?php $value=  "   Nawagamuwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nawagamuwa  "   >   Nawagamuwa  </option>
 <option     <?php $value=  "   Nawagattegama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nawagattegama   "   >   Nawagattegama   </option>
 <option     <?php $value=  "   Nawalapitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nawalapitiya    "   >   Nawalapitiya    </option>
 <option     <?php $value=  "   Nedumkerni  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nedumkerni  "   >   Nedumkerni  </option>
 <option     <?php $value=  "   Negombo "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Negombo "   >   Negombo </option>
 <option     <?php $value=  "   Negombo Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Negombo Division    "   >   Negombo Division    </option>
 <option     <?php $value=  "   Nelliaddy   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nelliaddy   "   >   Nelliaddy   </option>
 <option     <?php $value=  "   Neluwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Neluwa  "   >   Neluwa  </option>
 <option     <?php $value=  "   Nikaweratiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nikaweratiya    "   >   Nikaweratiya    </option>
 <option     <?php $value=  "   Nikaweratiya Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nikaweratiya Division   "   >   Nikaweratiya Division   </option>
 <option     <?php $value=  "   Nilaweli    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nilaweli    "   >   Nilaweli    </option>
 <option     <?php $value=  "   Nildandahinna   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nildandahinna   "   >   Nildandahinna   </option>
 <option     <?php $value=  "   Nittambuwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nittambuwa  "   >   Nittambuwa  </option>
 <option     <?php $value=  "   Nivithigala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nivithigala "   >   Nivithigala </option>
 <option     <?php $value=  "   Nochchiyagama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nochchiyagama   "   >   Nochchiyagama   </option>
 <option     <?php $value=  "   Norochchola "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Norochchola "   >   Norochchola </option>
 <option     <?php $value=  "   North Central Province  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   North Central Province  "   >   North Central Province  </option>
 <option     <?php $value=  "   North Western Province  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   North Western Province  "   >   North Western Province  </option>
 <option     <?php $value=  "   Northern Province   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Northern Province   "   >   Northern Province   </option>
 <option     <?php $value=  "   Norton Bridge   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Norton Bridge   "   >   Norton Bridge   </option>
 <option     <?php $value=  "   Norwood "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Norwood "   >   Norwood </option>
 <option     <?php $value=  "   Nugegoda    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nugegoda    "   >   Nugegoda    </option>
 <option     <?php $value=  "   Nugegoda Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nugegoda Division   "   >   Nugegoda Division   </option>
 <option     <?php $value=  "   Nuwara Eliya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nuwara Eliya    "   >   Nuwara Eliya    </option>
 <option     <?php $value=  "   Nuwara Eliya Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Nuwara Eliya Division   "   >   Nuwara Eliya Division   </option>
 <option     <?php $value=  "   Oddusudsn   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Oddusudsn   "   >   Oddusudsn   </option>
 <option     <?php $value=  "   Okkampitiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Okkampitiya "   >   Okkampitiya </option>
 <option     <?php $value=  "   Omanthai    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Omanthai    "   >   Omanthai    </option>
 <option     <?php $value=  "   Ombudsman   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ombudsman   "   >   Ombudsman   </option>
 <option     <?php $value=  "   Opanayake   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Opanayake   "   >   Opanayake   </option>
 <option     <?php $value=  "   Organized Crimes and Criminal Intelligence Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Organized Crimes and Criminal Intelligence Division "   >   Organized Crimes and Criminal Intelligence Division </option>
 <option     <?php $value=  "   Organized Crimes Preventive Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Organized Crimes Preventive Division    "   >   Organized Crimes Preventive Division    </option>
 <option     <?php $value=  "   Other   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Other   "   >   Other   </option>
 <option     <?php $value=  "   Padaviya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Padaviya    "   >   Padaviya    </option>
 <option     <?php $value=  "   Padiyathalawa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Padiyathalawa   "   >   Padiyathalawa   </option>
 <option     <?php $value=  "   Padukka "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Padukka "   >   Padukka </option>
 <option     <?php $value=  "   Palali  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Palali  "   >   Palali  </option>
 <option     <?php $value=  "   Palei   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Palei   "   >   Palei   </option>
 <option     <?php $value=  "   Pallama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pallama "   >   Pallama </option>
 <option     <?php $value=  "   Pallebedda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pallebedda  "   >   Pallebedda  </option>
 <option     <?php $value=  "   Pallekele (Balagolla)   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pallekele (Balagolla)   "   >   Pallekele (Balagolla)   </option>
 <option     <?php $value=  "   Pallewela   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pallewela   "   >   Pallewela   </option>
 <option     <?php $value=  "   Pamunugama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pamunugama  "   >   Pamunugama  </option>
 <option     <?php $value=  "   Panadura    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Panadura    "   >   Panadura    </option>
 <option     <?php $value=  "   Panadura Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Panadura Division   "   >   Panadura Division   </option>
 <option     <?php $value=  "   Panadura North  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Panadura North  "   >   Panadura North  </option>
 <option     <?php $value=  "   Panadura South  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Panadura South  "   >   Panadura South  </option>
 <option     <?php $value=  "   Panama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Panama  "   >   Panama  </option>
 <option     <?php $value=  "   Panamura    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Panamura    "   >   Panamura    </option>
 <option     <?php $value=  "   Pannala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pannala "   >   Pannala </option>
 <option     <?php $value=  "   Panwila "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Panwila "   >   Panwila </option>
 <option     <?php $value=  "   Parasangaswewa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Parasangaswewa  "   >   Parasangaswewa  </option>
 <option     <?php $value=  "   Parayanalakulam "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Parayanalakulam "   >   Parayanalakulam </option>
 <option     <?php $value=  "   Parliament Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Parliament Division "   >   Parliament Division </option>
 <option     <?php $value=  "   Passara "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Passara "   >   Passara </option>
 <option     <?php $value=  "   Pattipola   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pattipola   "   >   Pattipola   </option>
 <option     <?php $value=  "   Payagala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Payagala    "   >   Payagala    </option>
 <option     <?php $value=  "   Peliyagoda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Peliyagoda  "   >   Peliyagoda  </option>
 <option     <?php $value=  "   Pelmadulla  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pelmadulla  "   >   Pelmadulla  </option>
 <option     <?php $value=  "   Peradeniya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Peradeniya  "   >   Peradeniya  </option>
 <option     <?php $value=  "   Personnel B Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Personnel B Division    "   >   Personnel B Division    </option>
 <option     <?php $value=  "   Personnel Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Personnel Division  "   >   Personnel Division  </option>
 <option     <?php $value=  "   Pesale  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pesale  "   >   Pesale  </option>
 <option     <?php $value=  "   Pettah  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pettah  "   >   Pettah  </option>
 <option     <?php $value=  "   PHTI    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   PHTI    "   >   PHTI    </option>
 <option     <?php $value=  "   Physical Assets Management  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Physical Assets Management  "   >   Physical Assets Management  </option>
 <option     <?php $value=  "   Piliyandala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Piliyandala "   >   Piliyandala </option>
 <option     <?php $value=  "   Pindeniya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pindeniya   "   >   Pindeniya   </option>
 <option     <?php $value=  "   Pinnawala   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pinnawala   "   >   Pinnawala   </option>
 <option     <?php $value=  "   Pitabeddara "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pitabeddara "   >   Pitabeddara </option>
 <option     <?php $value=  "   Pitigala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pitigala    "   >   Pitigala    </option>
 <option     <?php $value=  "   Poddala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Poddala "   >   Poddala </option>
 <option     <?php $value=  "   Point Pedro "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Point Pedro "   >   Point Pedro </option>
 <option     <?php $value=  "   Polgahawela "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Polgahawela "   >   Polgahawela </option>
 <option     <?php $value=  "   Police Headquarters     "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Police Headquarters     "   >   Police Headquarters     </option>
 <option     <?php $value=  "   Police Media Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Police Media Division   "   >   Police Media Division   </option>
 <option     <?php $value=  "   Police Medical Service  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Police Medical Service  "   >   Police Medical Service  </option>
 <option     <?php $value=  "   Police Medical Service Kundasale    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Police Medical Service Kundasale    "   >   Police Medical Service Kundasale    </option>
 <option     <?php $value=  "   Police Public Relation  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Police Public Relation  "   >   Police Public Relation  </option>
 <option     <?php $value=  "   Polonnaruwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Polonnaruwa "   >   Polonnaruwa </option>
 <option     <?php $value=  "   Polonnaruwa Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Polonnaruwa Division    "   >   Polonnaruwa Division    </option>
 <option     <?php $value=  "   Polpithigama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Polpithigama    "   >   Polpithigama    </option>
 <option     <?php $value=  "   Pothuhera   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pothuhera   "   >   Pothuhera   </option>
 <option     <?php $value=  "   Pothuvil    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pothuvil    "   >   Pothuvil    </option>
 <option     <?php $value=  "   Presidential Security Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Presidential Security Division  "   >   Presidential Security Division  </option>
 <option     <?php $value=  "   Prime Ministers Security Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Prime Ministers Security Division   "   >   Prime Ministers Security Division   </option>
 <option     <?php $value=  "   Pudukuduiruppu  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pudukuduiruppu  "   >   Pudukuduiruppu  </option>
 <option     <?php $value=  "   Pugoda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pugoda  "   >   Pugoda  </option>
 <option     <?php $value=  "   Pujapitiya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pujapitiya  "   >   Pujapitiya  </option>
 <option     <?php $value=  "   Pulasthigama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pulasthigama    "   >   Pulasthigama    </option>
 <option     <?php $value=  "   Puliyankulam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Puliyankulam    "   >   Puliyankulam    </option>
 <option     <?php $value=  "   Pulmudai    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pulmudai    "   >   Pulmudai    </option>
 <option     <?php $value=  "   Punareen    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Punareen    "   >   Punareen    </option>
 <option     <?php $value=  "   Pundalu-Oya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pundalu-Oya "   >   Pundalu-Oya </option>
 <option     <?php $value=  "   Pussellawa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Pussellawa  "   >   Pussellawa  </option>
 <option     <?php $value=  "   Puttalam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Puttalam    "   >   Puttalam    </option>
 <option     <?php $value=  "   Puttalam Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Puttalam Division   "   >   Puttalam Division   </option>
 <option     <?php $value=  "   Puwarsankulam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Puwarsankulam   "   >   Puwarsankulam   </option>
 <option     <?php $value=  "   Raddolugama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Raddolugama "   >   Raddolugama </option>
 <option     <?php $value=  "   Ragala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ragala  "   >   Ragala  </option>
 <option     <?php $value=  "   Ragama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ragama  "   >   Ragama  </option>
 <option     <?php $value=  "   Rajanganaya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rajanganaya "   >   Rajanganaya </option>
 <option     <?php $value=  "   Rakwana "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rakwana "   >   Rakwana </option>
 <option     <?php $value=  "   Rambodagalla    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rambodagalla    "   >   Rambodagalla    </option>
 <option     <?php $value=  "   Rambukkana  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rambukkana  "   >   Rambukkana  </option>
 <option     <?php $value=  "   Rangala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rangala "   >   Rangala </option>
 <option     <?php $value=  "   Rasnayakapura   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rasnayakapura   "   >   Rasnayakapura   </option>
 <option     <?php $value=  "   Ratgama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ratgama "   >   Ratgama </option>
 <option     <?php $value=  "   Rathnapura  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rathnapura  "   >   Rathnapura  </option>
 <option     <?php $value=  "   Rathnapura Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rathnapura Division "   >   Rathnapura Division </option>
 <option     <?php $value=  "   Rattota "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rattota "   >   Rattota </option>
 <option     <?php $value=  "   Recruitment Office  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Recruitment Office  "   >   Recruitment Office  </option>
 <option     <?php $value=  "   Research & Development  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Research & Development  "   >   Research & Development  </option>
 <option     <?php $value=  "   Research & Planning     "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Research & Planning     "   >   Research & Planning     </option>
 <option     <?php $value=  "   Rideegama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rideegama   "   >   Rideegama   </option>
 <option     <?php $value=  "   Ridimaliyadda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ridimaliyadda   "   >   Ridimaliyadda   </option>
 <option     <?php $value=  "   Rotumba "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Rotumba "   >   Rotumba </option>
 <option     <?php $value=  "   RPTS Akuramboda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   RPTS Akuramboda "   >   RPTS Akuramboda </option>
 <option     <?php $value=  "   RPTS Boralanda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   RPTS Boralanda  "   >   RPTS Boralanda  </option>
 <option     <?php $value=  "   RPTS Katana "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   RPTS Katana "   >   RPTS Katana </option>
 <option     <?php $value=  "   RPTS Kundasale  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   RPTS Kundasale  "   >   RPTS Kundasale  </option>
 <option     <?php $value=  "   RPTS Mahiyangana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   RPTS Mahiyangana    "   >   RPTS Mahiyangana    </option>
 <option     <?php $value=  "   RPTS Morawewa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   RPTS Morawewa   "   >   RPTS Morawewa   </option>
 <option     <?php $value=  "   RPTS Pahalagama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   RPTS Pahalagama "   >   RPTS Pahalagama </option>
 <option     <?php $value=  "   Ruwanwella  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ruwanwella  "   >   Ruwanwella  </option>
 <option     <?php $value=  "   Sabaragamuwa Province   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sabaragamuwa Province   "   >   Sabaragamuwa Province   </option>
 <option     <?php $value=  "   Saliyawewa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Saliyawewa  "   >   Saliyawewa  </option>
 <option     <?php $value=  "   Samanthurai "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Samanthurai "   >   Samanthurai </option>
 <option     <?php $value=  "   Sampoor "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sampoor "   >   Sampoor </option>
 <option     <?php $value=  "   Sapugaskanda    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sapugaskanda    "   >   Sapugaskanda    </option>
 <option     <?php $value=  "   Seeduwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Seeduwa "   >   Seeduwa </option>
 <option     <?php $value=  "   Seethawakapura Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Seethawakapura Division "   >   Seethawakapura Division </option>
 <option     <?php $value=  "   Serunuwara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Serunuwara  "   >   Serunuwara  </option>
 <option     <?php $value=  "   Sevanagala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sevanagala  "   >   Sevanagala  </option>
 <option     <?php $value=  "   Sigiriya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sigiriya    "   >   Sigiriya    </option>
 <option     <?php $value=  "   Silawathura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Silawathura "   >   Silawathura </option>
 <option     <?php $value=  "   Siripagama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Siripagama  "   >   Siripagama  </option>
 <option     <?php $value=  "   Siyambalanduwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Siyambalanduwa  "   >   Siyambalanduwa  </option>
 <option     <?php $value=  "   Slave Islande   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Slave Islande   "   >   Slave Islande   </option>
 <option     <?php $value=  "   SLPC Aralaganwila   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Aralaganwila   "   >   SLPC Aralaganwila   </option>
 <option     <?php $value=  "   SLPC Asgiriya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Asgiriya   "   >   SLPC Asgiriya   </option>
 <option     <?php $value=  "   SLPC Boralanda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Boralanda  "   >   SLPC Boralanda  </option>
 <option     <?php $value=  "   SLPC Elpitiya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Elpitiya   "   >   SLPC Elpitiya   </option>
 <option     <?php $value=  "   SLPC Kalladi    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Kalladi    "   >   SLPC Kalladi    </option>
 <option     <?php $value=  "   SLPC Kalutara   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Kalutara   "   >   SLPC Kalutara   </option>
 <option     <?php $value=  "   SLPC Katana "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Katana "   >   SLPC Katana </option>
 <option     <?php $value=  "   SLPC Kundasale  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Kundasale  "   >   SLPC Kundasale  </option>
 <option     <?php $value=  "   SLPC Mahiyangana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Mahiyangana    "   >   SLPC Mahiyangana    </option>
 <option     <?php $value=  "   SLPC Nikaweratiya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Nikaweratiya   "   >   SLPC Nikaweratiya   </option>
 <option     <?php $value=  "   SLPC Pahalagama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPC Pahalagama "   >   SLPC Pahalagama </option>
 <option     <?php $value=  "   SLPR Hqrs   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   SLPR Hqrs   "   >   SLPR Hqrs   </option>
 <option     <?php $value=  "   Sooriyapura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sooriyapura "   >   Sooriyapura </option>
 <option     <?php $value=  "   Sooriyawewa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sooriyawewa "   >   Sooriyawewa </option>
 <option     <?php $value=  "   Southern Province   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Southern Province   "   >   Southern Province   </option>
 <option     <?php $value=  "   Special Branch  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Special Branch  "   >   Special Branch  </option>
 <option     <?php $value=  "   Special Investigation Unit  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Special Investigation Unit  "   >   Special Investigation Unit  </option>
 <option     <?php $value=  "   Sports Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sports Division "   >   Sports Division </option>
 <option     <?php $value=  "   Sripura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Sripura "   >   Sripura </option>
 <option     <?php $value=  "   State Intelligence Service  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   State Intelligence Service  "   >   State Intelligence Service  </option>
 <option     <?php $value=  "   Statistics  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Statistics  "   >   Statistics  </option>
 <option     <?php $value=  "   STF "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF "   >   STF </option>
 <option     <?php $value=  "   STF  Akmeemana Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Akmeemana Camp "   >   STF  Akmeemana Camp </option>
 <option     <?php $value=  "   STF  Aluthgama Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Aluthgama Camp "   >   STF  Aluthgama Camp </option>
 <option     <?php $value=  "   STF  Aralaganwila Sub Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Aralaganwila Sub Camp  "   >   STF  Aralaganwila Sub Camp  </option>
 <option     <?php $value=  "   STF  Aranthalawa Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Aranthalawa Camp   "   >   STF  Aranthalawa Camp   </option>
 <option     <?php $value=  "   STF  Bandirekka Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Bandirekka Sub Camp    "   >   STF  Bandirekka Sub Camp    </option>
 <option     <?php $value=  "   STF  Buddangala Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Buddangala Sub Camp    "   >   STF  Buddangala Sub Camp    </option>
 <option     <?php $value=  "   STF  Buddangala Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Buddangala Sub Camp    "   >   STF  Buddangala Sub Camp    </option>
 <option     <?php $value=  "   STF  Dambulla Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Dambulla Camp  "   >   STF  Dambulla Camp  </option>
 <option     <?php $value=  "   STF  Debarawewa Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Debarawewa Camp    "   >   STF  Debarawewa Camp    </option>
 <option     <?php $value=  "   STF  Deniyaya Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Deniyaya Camp  "   >   STF  Deniyaya Camp  </option>
 <option     <?php $value=  "   STF  Eravur Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Eravur Sub Camp    "   >   STF  Eravur Sub Camp    </option>
 <option     <?php $value=  "   STF  Gampola Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Gampola Camp   "   >   STF  Gampola Camp   </option>
 <option     <?php $value=  "   STF  Ganeshapuram Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Ganeshapuram Camp  "   >   STF  Ganeshapuram Camp  </option>
 <option     <?php $value=  "   STF  Hambantota Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Hambantota Camp    "   >   STF  Hambantota Camp    </option>
 <option     <?php $value=  "   STF  Haputale Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Haputale Camp  "   >   STF  Haputale Camp  </option>
 <option     <?php $value=  "   STF  Headquarters   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Headquarters   "   >   STF  Headquarters   </option>
 <option     <?php $value=  "   STF  Jaffna Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Jaffna Camp    "   >   STF  Jaffna Camp    </option>
 <option     <?php $value=  "   STF  Kahawatta Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kahawatta Camp "   >   STF  Kahawatta Camp </option>
 <option     <?php $value=  "   STF  Kalawanchikudi Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kalawanchikudi Camp    "   >   STF  Kalawanchikudi Camp    </option>
 <option     <?php $value=  "   STF  Kalubowila Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kalubowila Camp    "   >   STF  Kalubowila Camp    </option>
 <option     <?php $value=  "   STF  Kandy Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kandy Camp "   >   STF  Kandy Camp </option>
 <option     <?php $value=  "   STF  Kantale Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kantale Camp   "   >   STF  Kantale Camp   </option>
 <option     <?php $value=  "   STF  Katharagama Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Katharagama Camp   "   >   STF  Katharagama Camp   </option>
 <option     <?php $value=  "   STF  Kebithigollewa Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kebithigollewa Camp    "   >   STF  Kebithigollewa Camp    </option>
 <option     <?php $value=  "   STF  Kegalle Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kegalle Camp   "   >   STF  Kegalle Camp   </option>
 <option     <?php $value=  "   STF  Kilinochchi Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kilinochchi Camp   "   >   STF  Kilinochchi Camp   </option>
 <option     <?php $value=  "   STF  Kirindiwela Sub Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kirindiwela Sub Camp   "   >   STF  Kirindiwela Sub Camp   </option>
 <option     <?php $value=  "   STF  Kurunegala Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Kurunegala Camp    "   >   STF  Kurunegala Camp    </option>
 <option     <?php $value=  "   STF  Lahugala Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Lahugala Camp  "   >   STF  Lahugala Camp  </option>
 <option     <?php $value=  "   STF  Madiwela Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Madiwela Camp  "   >   STF  Madiwela Camp  </option>
 <option     <?php $value=  "   STF  Mahagamasekara Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Mahagamasekara Sub Camp    "   >   STF  Mahagamasekara Sub Camp    </option>
 <option     <?php $value=  "   STF  Mahaoya Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Mahaoya Camp   "   >   STF  Mahaoya Camp   </option>
 <option     <?php $value=  "   STF  Mankulam Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Mankulam Camp  "   >   STF  Mankulam Camp  </option>
 <option     <?php $value=  "   STF  Mannar Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Mannar Camp    "   >   STF  Mannar Camp    </option>
 <option     <?php $value=  "   STF  Maradana Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Maradana Camp  "   >   STF  Maradana Camp  </option>
 <option     <?php $value=  "   STF  Maskeliya Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Maskeliya Camp "   >   STF  Maskeliya Camp </option>
 <option     <?php $value=  "   STF  Mulathivu Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Mulathivu Camp "   >   STF  Mulathivu Camp </option>
 <option     <?php $value=  "   STF  Nuwaraeliya Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Nuwaraeliya Camp   "   >   STF  Nuwaraeliya Camp   </option>
 <option     <?php $value=  "   STF  Passara Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Passara Camp   "   >   STF  Passara Camp   </option>
 <option     <?php $value=  "   STF  PMSD, Kollupitiya Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  PMSD, Kollupitiya Camp "   >   STF  PMSD, Kollupitiya Camp </option>
 <option     <?php $value=  "   STF  Puliyankulam Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Puliyankulam Camp  "   >   STF  Puliyankulam Camp  </option>
 <option     <?php $value=  "   STF  Pulmudai Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Pulmudai Camp  "   >   STF  Pulmudai Camp  </option>
 <option     <?php $value=  "   STF  Puwarasankulam Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Puwarasankulam Camp    "   >   STF  Puwarasankulam Camp    </option>
 <option     <?php $value=  "   STF  Rajagiriya Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Rajagiriya Camp    "   >   STF  Rajagiriya Camp    </option>
 <option     <?php $value=  "   STF  Rathnapura Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Rathnapura Sub Camp    "   >   STF  Rathnapura Sub Camp    </option>
 <option     <?php $value=  "   STF  Rear Headquarters  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Rear Headquarters  "   >   STF  Rear Headquarters  </option>
 <option     <?php $value=  "   STF  Samanthurai Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Samanthurai Camp   "   >   STF  Samanthurai Camp   </option>
 <option     <?php $value=  "   STF  Settikulam Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Settikulam Camp    "   >   STF  Settikulam Camp    </option>
 <option     <?php $value=  "   STF  Shasthrawela Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Shasthrawela Camp  "   >   STF  Shasthrawela Camp  </option>
 <option     <?php $value=  "   STF  Siyambalanduwa Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Siyambalanduwa Camp    "   >   STF  Siyambalanduwa Camp    </option>
 <option     <?php $value=  "   STF  Tangalle Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Tangalle Camp  "   >   STF  Tangalle Camp  </option>
 <option     <?php $value=  "   STF  Thirukkovil Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Thirukkovil Camp   "   >   STF  Thirukkovil Camp   </option>
 <option     <?php $value=  "   STF  Training School    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Training School    "   >   STF  Training School    </option>
 <option     <?php $value=  "   STF  Trincomalee Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Trincomalee Camp   "   >   STF  Trincomalee Camp   </option>
 <option     <?php $value=  "   STF  Udawalawa Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Udawalawa Camp "   >   STF  Udawalawa Camp </option>
 <option     <?php $value=  "   STF  Vavunathivu Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Vavunathivu Camp   "   >   STF  Vavunathivu Camp   </option>
 <option     <?php $value=  "   STF  Vavuniya Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Vavuniya Camp  "   >   STF  Vavuniya Camp  </option>
 <option     <?php $value=  "   STF  Welipitiya Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF  Welipitiya Sub Camp    "   >   STF  Welipitiya Sub Camp    </option>
 <option     <?php $value=  "   STF 02 Mile Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 02 Mile Post    "   >   STF 02 Mile Post    </option>
 <option     <?php $value=  "   STF 03 Mile Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 03 Mile Post    "   >   STF 03 Mile Post    </option>
 <option     <?php $value=  "   STF 05 Mile Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 05 Mile Post    "   >   STF 05 Mile Post    </option>
 <option     <?php $value=  "   STF 08 Mile Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 08 Mile Post    "   >   STF 08 Mile Post    </option>
 <option     <?php $value=  "   STF 10 Mile Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 10 Mile Post    "   >   STF 10 Mile Post    </option>
 <option     <?php $value=  "   STF 12 Kolaniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 12 Kolaniya "   >   STF 12 Kolaniya </option>
 <option     <?php $value=  "   STF 13 Kolaniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 13 Kolaniya "   >   STF 13 Kolaniya </option>
 <option     <?php $value=  "   STF 14 Kolaniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 14 Kolaniya "   >   STF 14 Kolaniya </option>
 <option     <?php $value=  "   STF 16 Colaniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 16 Colaniya "   >   STF 16 Colaniya </option>
 <option     <?php $value=  "   STF 17 Mile Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 17 Mile Post    "   >   STF 17 Mile Post    </option>
 <option     <?php $value=  "   STF 18 Mill Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 18 Mill Post    "   >   STF 18 Mill Post    </option>
 <option     <?php $value=  "   STF 233 Balasena Mulasthanaya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 233 Balasena Mulasthanaya   "   >   STF 233 Balasena Mulasthanaya   </option>
 <option     <?php $value=  "   STF 38 Kolaniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 38 Kolaniya "   >   STF 38 Kolaniya </option>
 <option     <?php $value=  "   STF 38 Mile Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 38 Mile Post    "   >   STF 38 Mile Post    </option>
 <option     <?php $value=  "   STF 3rd Mile Post Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF 3rd Mile Post Camp  "   >   STF 3rd Mile Post Camp  </option>
 <option     <?php $value=  "   STF Abimanapura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Abimanapura "   >   STF Abimanapura </option>
 <option     <?php $value=  "   STF Admin Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Admin Division  "   >   STF Admin Division  </option>
 <option     <?php $value=  "   STF Aiththamale "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Aiththamale "   >   STF Aiththamale </option>
 <option     <?php $value=  "   STF Akkarapattuwa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Akkarapattuwa   "   >   STF Akkarapattuwa   </option>
 <option     <?php $value=  "   STF Alamkulam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Alamkulam   "   >   STF Alamkulam   </option>
 <option     <?php $value=  "   STF Ambakote    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ambakote    "   >   STF Ambakote    </option>
 <option     <?php $value=  "   STF Ambalangoda "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ambalangoda "   >   STF Ambalangoda </option>
 <option     <?php $value=  "   STF Ambalanthota Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ambalanthota Camp   "   >   STF Ambalanthota Camp   </option>
 <option     <?php $value=  "   STF Ambalanthure    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ambalanthure    "   >   STF Ambalanthure    </option>
 <option     <?php $value=  "   STF Ambanpola   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ambanpola   "   >   STF Ambanpola   </option>
 <option     <?php $value=  "   STF Ambawathttha    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ambawathttha    "   >   STF Ambawathttha    </option>
 <option     <?php $value=  "   STF Ampara Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ampara Camp "   >   STF Ampara Camp </option>
 <option     <?php $value=  "   STF Angunakolapelessa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Angunakolapelessa   "   >   STF Angunakolapelessa   </option>
 <option     <?php $value=  "   STF Annamalei   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Annamalei   "   >   STF Annamalei   </option>
 <option     <?php $value=  "   STF Anuradhapura Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Anuradhapura Camp   "   >   STF Anuradhapura Camp   </option>
 <option     <?php $value=  "   STF Aralaganwila    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Aralaganwila    "   >   STF Aralaganwila    </option>
 <option     <?php $value=  "   STF Ariyampadhi "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ariyampadhi "   >   STF Ariyampadhi </option>
 <option     <?php $value=  "   STF Ariyampaththuwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ariyampaththuwa "   >   STF Ariyampaththuwa </option>
 <option     <?php $value=  "   STF Arugambe Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Arugambe Camp   "   >   STF Arugambe Camp   </option>
 <option     <?php $value=  "   STF AThurugiriya Express Way Post   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF AThurugiriya Express Way Post   "   >   STF AThurugiriya Express Way Post   </option>
 <option     <?php $value=  "   STF Atuchena    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Atuchena    "   >   STF Atuchena    </option>
 <option     <?php $value=  "   STF Badalkubura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Badalkubura "   >   STF Badalkubura </option>
 <option     <?php $value=  "   STF Badamassawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Badamassawa "   >   STF Badamassawa </option>
 <option     <?php $value=  "   STF Badulla "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Badulla "   >   STF Badulla </option>
 <option     <?php $value=  "   STF Badulugaha Juncion Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Badulugaha Juncion Camp "   >   STF Badulugaha Juncion Camp </option>
 <option     <?php $value=  "   STF Baduluhandiya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Baduluhandiya   "   >   STF Baduluhandiya   </option>
 <option     <?php $value=  "   STF Bakmitiyawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Bakmitiyawa "   >   STF Bakmitiyawa </option>
 <option     <?php $value=  "   STF Bamburegala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Bamburegala "   >   STF Bamburegala </option>
 <option     <?php $value=  "   STF Batticaloa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Batticaloa  "   >   STF Batticaloa  </option>
 <option     <?php $value=  "   STF Battohandiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Battohandiya    "   >   STF Battohandiya    </option>
 <option     <?php $value=  "   STF Beliattha   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Beliattha   "   >   STF Beliattha   </option>
 <option     <?php $value=  "   STF Bibila  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Bibila  "   >   STF Bibila  </option>
 <option     <?php $value=  "   STF Boburuella  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Boburuella  "   >   STF Boburuella  </option>
 <option     <?php $value=  "   STF Bogamuyaya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Bogamuyaya  "   >   STF Bogamuyaya  </option>
 <option     <?php $value=  "   STF Borapola    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Borapola    "   >   STF Borapola    </option>
 <option     <?php $value=  "   STF Building Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Building Division   "   >   STF Building Division   </option>
 <option     <?php $value=  "   STF Buttala Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Buttala Camp    "   >   STF Buttala Camp    </option>
 <option     <?php $value=  "   STF Communication Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Communication Division  "   >   STF Communication Division  </option>
 <option     <?php $value=  "   STF Computer Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Computer Division   "   >   STF Computer Division   </option>
 <option     <?php $value=  "   STF Cross Juntion   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Cross Juntion   "   >   STF Cross Juntion   </option>
 <option     <?php $value=  "   STF Cultural Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Cultural Division   "   >   STF Cultural Division   </option>
 <option     <?php $value=  "   STF Dambagalla  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Dambagalla  "   >   STF Dambagalla  </option>
 <option     <?php $value=  "   STF Danagiriya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Danagiriya  "   >   STF Danagiriya  </option>
 <option     <?php $value=  "   STF Darampalava "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Darampalava "   >   STF Darampalava </option>
 <option     <?php $value=  "   STF Darampalawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Darampalawa "   >   STF Darampalawa </option>
 <option     <?php $value=  "   STF Diddenipotha    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Diddenipotha    "   >   STF Diddenipotha    </option>
 <option     <?php $value=  "   STF Digawapiya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Digawapiya  "   >   STF Digawapiya  </option>
 <option     <?php $value=  "   STF Dutuwewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Dutuwewa    "   >   STF Dutuwewa    </option>
 <option     <?php $value=  "   STF Ethakada    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ethakada    "   >   STF Ethakada    </option>
 <option     <?php $value=  "   STF Ethakadha   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ethakadha   "   >   STF Ethakadha   </option>
 <option     <?php $value=  "   STF Galanigama Express Way Post "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Galanigama Express Way Post "   >   STF Galanigama Express Way Post </option>
 <option     <?php $value=  "   STF Galle   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Galle   "   >   STF Galle   </option>
 <option     <?php $value=  "   STF Gonahena    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Gonahena    "   >   STF Gonahena    </option>
 <option     <?php $value=  "   STF Hambegamuwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Hambegamuwa "   >   STF Hambegamuwa </option>
 <option     <?php $value=  "   STF Hanawalvila "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Hanawalvila "   >   STF Hanawalvila </option>
 <option     <?php $value=  "   STF Horana Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Horana Camp "   >   STF Horana Camp </option>
 <option     <?php $value=  "   STF Hulannuge   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Hulannuge   "   >   STF Hulannuge   </option>
 <option     <?php $value=  "   STF Human Resources Management  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Human Resources Management  "   >   STF Human Resources Management  </option>
 <option     <?php $value=  "   STF Humbegamuwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Humbegamuwa "   >   STF Humbegamuwa </option>
 <option     <?php $value=  "   STF Idigollewa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Idigollewa  "   >   STF Idigollewa  </option>
 <option     <?php $value=  "   STF Iluppadichena   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Iluppadichena   "   >   STF Iluppadichena   </option>
 <option     <?php $value=  "   STF Information Technology Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Information Technology Division "   >   STF Information Technology Division </option>
 <option     <?php $value=  "   STF Int Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Int Division    "   >   STF Int Division    </option>
 <option     <?php $value=  "   STF Janadipathimedura   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Janadipathimedura   "   >   STF Janadipathimedura   </option>
 <option     <?php $value=  "   STF Janapada    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Janapada    "   >   STF Janapada    </option>
 <option     <?php $value=  "   STF Jayawardanapura Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Jayawardanapura Camp    "   >   STF Jayawardanapura Camp    </option>
 <option     <?php $value=  "   STF Kaburupitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kaburupitiya    "   >   STF Kaburupitiya    </option>
 <option     <?php $value=  "   STF Kaddankulam "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kaddankulam "   >   STF Kaddankulam </option>
 <option     <?php $value=  "   STF Kahambana   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kahambana   "   >   STF Kahambana   </option>
 <option     <?php $value=  "   STF Kahatagollewa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kahatagollewa   "   >   STF Kahatagollewa   </option>
 <option     <?php $value=  "   STF Kakachchiwatta  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kakachchiwatta  "   >   STF Kakachchiwatta  </option>
 <option     <?php $value=  "   STF Kalladi "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kalladi "   >   STF Kalladi </option>
 <option     <?php $value=  "   STF Kalmunai Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kalmunai Camp   "   >   STF Kalmunai Camp   </option>
 <option     <?php $value=  "   STF Kalupalama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kalupalama  "   >   STF Kalupalama  </option>
 <option     <?php $value=  "   STF Kaluppukulam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kaluppukulam    "   >   STF Kaluppukulam    </option>
 <option     <?php $value=  "   STF Kanagarayankulama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kanagarayankulama   "   >   STF Kanagarayankulama   </option>
 <option     <?php $value=  "   STF Kanchanakuda    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kanchanakuda    "   >   STF Kanchanakuda    </option>
 <option     <?php $value=  "   STF Kanchikudiaru   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kanchikudiaru   "   >   STF Kanchikudiaru   </option>
 <option     <?php $value=  "   STF Kanchnakuda Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kanchnakuda Camp    "   >   STF Kanchnakuda Camp    </option>
 <option     <?php $value=  "   STF Kanchurankuda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kanchurankuda   "   >   STF Kanchurankuda   </option>
 <option     <?php $value=  "   STF Kankankulama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kankankulama    "   >   STF Kankankulama    </option>
 <option     <?php $value=  "   STF Kannagipuram    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kannagipuram    "   >   STF Kannagipuram    </option>
 <option     <?php $value=  "   STF Karadandawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Karadandawa "   >   STF Karadandawa </option>
 <option     <?php $value=  "   STF Karadaoya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Karadaoya   "   >   STF Karadaoya   </option>
 <option     <?php $value=  "   STF Karadaoya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Karadaoya   "   >   STF Karadaoya   </option>
 <option     <?php $value=  "   STF Karadiyanaru    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Karadiyanaru    "   >   STF Karadiyanaru    </option>
 <option     <?php $value=  "   STF Karagahaella    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Karagahaella    "   >   STF Karagahaella    </option>
 <option     <?php $value=  "   STF Karthiv "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Karthiv "   >   STF Karthiv </option>
 <option     <?php $value=  "   STF Kathtankudi "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kathtankudi "   >   STF Kathtankudi </option>
 <option     <?php $value=  "   STF Katukurunda Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Katukurunda Camp    "   >   STF Katukurunda Camp    </option>
 <option     <?php $value=  "   STF Kelaniya Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kelaniya Camp   "   >   STF Kelaniya Camp   </option>
 <option     <?php $value=  "   STF Kelapuliyankulam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kelapuliyankulam    "   >   STF Kelapuliyankulam    </option>
 <option     <?php $value=  "   STF Keviliyamadu    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Keviliyamadu    "   >   STF Keviliyamadu    </option>
 <option     <?php $value=  "   STF Kibithgollewa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kibithgollewa   "   >   STF Kibithgollewa   </option>
 <option     <?php $value=  "   STF Kiraan  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kiraan  "   >   STF Kiraan  </option>
 <option     <?php $value=  "   STF Kithula "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kithula "   >   STF Kithula </option>
 <option     <?php $value=  "   STF Kohombagasthalawa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kohombagasthalawa   "   >   STF Kohombagasthalawa   </option>
 <option     <?php $value=  "   STF Kokkadichole    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kokkadichole    "   >   STF Kokkadichole    </option>
 <option     <?php $value=  "   STF Komari  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Komari  "   >   STF Komari  </option>
 <option     <?php $value=  "   STF Kopaweli    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kopaweli    "   >   STF Kopaweli    </option>
 <option     <?php $value=  "   STF Kosgolla    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kosgolla    "   >   STF Kosgolla    </option>
 <option     <?php $value=  "   STF Kotiyagala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kotiyagala  "   >   STF Kotiyagala  </option>
 <option     <?php $value=  "   STF Kotteviharaya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kotteviharaya   "   >   STF Kotteviharaya   </option>
 <option     <?php $value=  "   STF Kovil Juntion   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kovil Juntion   "   >   STF Kovil Juntion   </option>
 <option     <?php $value=  "   STF Kovilhandiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kovilhandiya    "   >   STF Kovilhandiya    </option>
 <option     <?php $value=  "   STF Kridahandiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kridahandiya    "   >   STF Kridahandiya    </option>
 <option     <?php $value=  "   STF Kudaloluwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kudaloluwa  "   >   STF Kudaloluwa  </option>
 <option     <?php $value=  "   STF Kulawana    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kulawana    "   >   STF Kulawana    </option>
 <option     <?php $value=  "   STF Kumana  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kumana  "   >   STF Kumana  </option>
 <option     <?php $value=  "   STF Kurukkalmadam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kurukkalmadam   "   >   STF Kurukkalmadam   </option>
 <option     <?php $value=  "   STF Kurukkalpudikulam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kurukkalpudikulam   "   >   STF Kurukkalpudikulam   </option>
 <option     <?php $value=  "   STF Kurundugaha Hatakma Express Way Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kurundugaha Hatakma Express Way Post    "   >   STF Kurundugaha Hatakma Express Way Post    </option>
 <option     <?php $value=  "   STF Kurusa Junction "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kurusa Junction "   >   STF Kurusa Junction </option>
 <option     <?php $value=  "   STF Kurusuddamadu   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kurusuddamadu   "   >   STF Kurusuddamadu   </option>
 <option     <?php $value=  "   STF Kuruwancheli    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Kuruwancheli    "   >   STF Kuruwancheli    </option>
 <option     <?php $value=  "   STF Lake 01 "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Lake 01 "   >   STF Lake 01 </option>
 <option     <?php $value=  "   STF Leweniaru   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Leweniaru   "   >   STF Leweniaru   </option>
 <option     <?php $value=  "   STF Liyanagolla "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Liyanagolla "   >   STF Liyanagolla </option>
 <option     <?php $value=  "   STF Liyanagolla "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Liyanagolla "   >   STF Liyanagolla </option>
 <option     <?php $value=  "   STF Logistic Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Logistic Division   "   >   STF Logistic Division   </option>
 <option     <?php $value=  "   STF Maddiya Kadaura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Maddiya Kadaura "   >   STF Maddiya Kadaura </option>
 <option     <?php $value=  "   STF Madupara    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Madupara    "   >   STF Madupara    </option>
 <option     <?php $value=  "   STF Mahanikawewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Mahanikawewa    "   >   STF Mahanikawewa    </option>
 <option     <?php $value=  "   STF Mailanbawali    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Mailanbawali    "   >   STF Mailanbawali    </option>
 <option     <?php $value=  "   STF Mailavettuwan   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Mailavettuwan   "   >   STF Mailavettuwan   </option>
 <option     <?php $value=  "   STF Maligavichchi   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Maligavichchi   "   >   STF Maligavichchi   </option>
 <option     <?php $value=  "   STF Maligavila  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Maligavila  "   >   STF Maligavila  </option>
 <option     <?php $value=  "   STF Malwatta    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Malwatta    "   >   STF Malwatta    </option>
 <option     <?php $value=  "   STF Mandure "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Mandure "   >   STF Mandure </option>
 <option     <?php $value=  "   STF Mangalagama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Mangalagama "   >   STF Mangalagama </option>
 <option     <?php $value=  "   STF Manmoona    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Manmoona    "   >   STF Manmoona    </option>
 <option     <?php $value=  "   STF Mantottama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Mantottama  "   >   STF Mantottama  </option>
 <option     <?php $value=  "   STF Maradhamuna "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Maradhamuna "   >   STF Maradhamuna </option>
 <option     <?php $value=  "   STF Marapalama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Marapalama  "   >   STF Marapalama  </option>
 <option     <?php $value=  "   STF Matale  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Matale  "   >   STF Matale  </option>
 <option     <?php $value=  "   STF Matara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Matara  "   >   STF Matara  </option>
 <option     <?php $value=  "   STF Matottama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Matottama   "   >   STF Matottama   </option>
 <option     <?php $value=  "   STF Mawadivummari   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Mawadivummari   "   >   STF Mawadivummari   </option>
 <option     <?php $value=  "   STF Meepilimanna    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Meepilimanna    "   >   STF Meepilimanna    </option>
 <option     <?php $value=  "   STF Melevidiya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Melevidiya  "   >   STF Melevidiya  </option>
 <option     <?php $value=  "   STF Monaragala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Monaragala  "   >   STF Monaragala  </option>
 <option     <?php $value=  "   STF Monarathenna    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Monarathenna    "   >   STF Monarathenna    </option>
 <option     <?php $value=  "   STF Moratottanchena "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Moratottanchena "   >   STF Moratottanchena </option>
 <option     <?php $value=  "   STF Moratuwa Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Moratuwa Camp   "   >   STF Moratuwa Camp   </option>
 <option     <?php $value=  "   STF Morayaya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Morayaya    "   >   STF Morayaya    </option>
 <option     <?php $value=  "   STF Munrumurippukulama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Munrumurippukulama  "   >   STF Munrumurippukulama  </option>
 <option     <?php $value=  "   STF Murunkan    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Murunkan    "   >   STF Murunkan    </option>
 <option     <?php $value=  "   STF Muwamilade  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Muwamilade  "   >   STF Muwamilade  </option>
 <option     <?php $value=  "   STF Nadidankulama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nadidankulama   "   >   STF Nadidankulama   </option>
 <option     <?php $value=  "   STF Nanattan    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nanattan    "   >   STF Nanattan    </option>
 <option     <?php $value=  "   STF Narakamulla 01  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Narakamulla 01  "   >   STF Narakamulla 01  </option>
 <option     <?php $value=  "   STF Narakamulla 02  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Narakamulla 02  "   >   STF Narakamulla 02  </option>
 <option     <?php $value=  "   STF Narakamulla 03  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Narakamulla 03  "   >   STF Narakamulla 03  </option>
 <option     <?php $value=  "   STF Narakamulla 2 Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Narakamulla 2 Camp  "   >   STF Narakamulla 2 Camp  </option>
 <option     <?php $value=  "   STF Naripulthottama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Naripulthottama "   >   STF Naripulthottama </option>
 <option     <?php $value=  "   STF Nawakkulam  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nawakkulam  "   >   STF Nawakkulam  </option>
 <option     <?php $value=  "   STF Nedukkulam  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nedukkulam  "   >   STF Nedukkulam  </option>
 <option     <?php $value=  "   STF Neeththa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Neeththa    "   >   STF Neeththa    </option>
 <option     <?php $value=  "   STF Nelliyankudiruppu   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nelliyankudiruppu   "   >   STF Nelliyankudiruppu   </option>
 <option     <?php $value=  "   STF Nikawewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nikawewa    "   >   STF Nikawewa    </option>
 <option     <?php $value=  "   STF Niknode "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Niknode "   >   STF Niknode </option>
 <option     <?php $value=  "   STF Nugelandha  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nugelandha  "   >   STF Nugelandha  </option>
 <option     <?php $value=  "   STF Nuwaragalathenna    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Nuwaragalathenna    "   >   STF Nuwaragalathenna    </option>
 <option     <?php $value=  "   STF Okada   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Okada   "   >   STF Okada   </option>
 <option     <?php $value=  "   STF Oluvil  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Oluvil  "   >   STF Oluvil  </option>
 <option     <?php $value=  "   STF Ondachimadam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Ondachimadam    "   >   STF Ondachimadam    </option>
 <option     <?php $value=  "   STF Paladiwattha    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Paladiwattha    "   >   STF Paladiwattha    </option>
 <option     <?php $value=  "   STF Pallachena  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pallachena  "   >   STF Pallachena  </option>
 <option     <?php $value=  "   STF Palugamam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Palugamam   "   >   STF Palugamam   </option>
 <option     <?php $value=  "   STF Panama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Panama  "   >   STF Panama  </option>
 <option     <?php $value=  "   STF Panikkaraikulam "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Panikkaraikulam "   >   STF Panikkaraikulam </option>
 <option     <?php $value=  "   STF Pankudaweli "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pankudaweli "   >   STF Pankudaweli </option>
 <option     <?php $value=  "   STF Pannalgama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pannalgama  "   >   STF Pannalgama  </option>
 <option     <?php $value=  "   STF Parayanakulam Camp  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Parayanakulam Camp  "   >   STF Parayanakulam Camp  </option>
 <option     <?php $value=  "   STF Pattipola   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pattipola   "   >   STF Pattipola   </option>
 <option     <?php $value=  "   STF Pawakkudichena  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pawakkudichena  "   >   STF Pawakkudichena  </option>
 <option     <?php $value=  "   STF Pelwaththa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pelwaththa  "   >   STF Pelwaththa  </option>
 <option     <?php $value=  "   STF Perawelithalawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Perawelithalawa "   >   STF Perawelithalawa </option>
 <option     <?php $value=  "   STF Periyamadu  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Periyamadu  "   >   STF Periyamadu  </option>
 <option     <?php $value=  "   STF Piliyandala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Piliyandala "   >   STF Piliyandala </option>
 <option     <?php $value=  "   STF Pilleyaradi "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pilleyaradi "   >   STF Pilleyaradi </option>
 <option     <?php $value=  "   STF Pillumalei  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pillumalei  "   >   STF Pillumalei  </option>
 <option     <?php $value=  "   STF Pinnaduwa Express Way Post  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pinnaduwa Express Way Post  "   >   STF Pinnaduwa Express Way Post  </option>
 <option     <?php $value=  "   STF Pirappanmadu 01 "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pirappanmadu 01 "   >   STF Pirappanmadu 01 </option>
 <option     <?php $value=  "   STF Pirappanmadu 02 "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pirappanmadu 02 "   >   STF Pirappanmadu 02 </option>
 <option     <?php $value=  "   STF Piyangala   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Piyangala   "   >   STF Piyangala   </option>
 <option     <?php $value=  "   STF Point Pedro "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Point Pedro "   >   STF Point Pedro </option>
 <option     <?php $value=  "   STF Polonnaruwa Sub Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Polonnaruwa Sub Camp    "   >   STF Polonnaruwa Sub Camp    </option>
 <option     <?php $value=  "   STF Porathiv    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Porathiv    "   >   STF Porathiv    </option>
 <option     <?php $value=  "   STF Potuvil "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Potuvil "   >   STF Potuvil </option>
 <option     <?php $value=  "   STF Property Management Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Property Management Division    "   >   STF Property Management Division    </option>
 <option     <?php $value=  "   STF Pudikudiruppuwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pudikudiruppuwa "   >   STF Pudikudiruppuwa </option>
 <option     <?php $value=  "   STF Pudukudiiruppu Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pudukudiiruppu Camp "   >   STF Pudukudiiruppu Camp </option>
 <option     <?php $value=  "   STF Pugoda Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pugoda Camp "   >   STF Pugoda Camp </option>
 <option     <?php $value=  "   STF Pulawalee   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pulawalee   "   >   STF Pulawalee   </option>
 <option     <?php $value=  "   STF Puliyankulama 02    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Puliyankulama 02    "   >   STF Puliyankulama 02    </option>
 <option     <?php $value=  "   STF Pulleadiirakkam "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pulleadiirakkam "   >   STF Pulleadiirakkam </option>
 <option     <?php $value=  "   STF Pulukunava  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pulukunava  "   >   STF Pulukunava  </option>
 <option     <?php $value=  "   STF Pulukunawa Camp "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Pulukunawa Camp "   >   STF Pulukunawa Camp </option>
 <option     <?php $value=  "   STF Puttlam Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Puttlam Camp    "   >   STF Puttlam Camp    </option>
 <option     <?php $value=  "   STF Radella "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Radella "   >   STF Radella </option>
 <option     <?php $value=  "   STF Rankaduvegoda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Rankaduvegoda   "   >   STF Rankaduvegoda   </option>
 <option     <?php $value=  "   STF Rankaduwegoda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Rankaduwegoda   "   >   STF Rankaduwegoda   </option>
 <option     <?php $value=  "   STF Rathgama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Rathgama    "   >   STF Rathgama    </option>
 <option     <?php $value=  "   STF Rottekulam  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Rottekulam  "   >   STF Rottekulam  </option>
 <option     <?php $value=  "   STF Rugama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Rugama  "   >   STF Rugama  </option>
 <option     <?php $value=  "   STF Rupaskulam  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Rupaskulam  "   >   STF Rupaskulam  </option>
 <option     <?php $value=  "   STF Rupawahini  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Rupawahini  "   >   STF Rupawahini  </option>
 <option     <?php $value=  "   STF Sagama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sagama  "   >   STF Sagama  </option>
 <option     <?php $value=  "   STF Saharukondan    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Saharukondan    "   >   STF Saharukondan    </option>
 <option     <?php $value=  "   STF Samanthiaru "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Samanthiaru "   >   STF Samanthiaru </option>
 <option     <?php $value=  "   STF Samanturiy  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Samanturiy  "   >   STF Samanturiy  </option>
 <option     <?php $value=  "   STF Sangamankanda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sangamankanda   "   >   STF Sangamankanda   </option>
 <option     <?php $value=  "   STF Santhimale  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Santhimale  "   >   STF Santhimale  </option>
 <option     <?php $value=  "   STF Search and Bomb Disposal Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Search and Bomb Disposal Division   "   >   STF Search and Bomb Disposal Division   </option>
 <option     <?php $value=  "   STF Seeduwa Express Way Post    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Seeduwa Express Way Post    "   >   STF Seeduwa Express Way Post    </option>
 <option     <?php $value=  "   STF Senagamuwewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Senagamuwewa    "   >   STF Senagamuwewa    </option>
 <option     <?php $value=  "   STF Settipalama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Settipalama "   >   STF Settipalama </option>
 <option     <?php $value=  "   STF Settipalama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Settipalama "   >   STF Settipalama </option>
 <option     <?php $value=  "   STF Sewanagala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sewanagala  "   >   STF Sewanagala  </option>
 <option     <?php $value=  "   STF Sinnapuliyankulam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sinnapuliyankulam   "   >   STF Sinnapuliyankulam   </option>
 <option     <?php $value=  "   STF Sinnaurni   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sinnaurni   "   >   STF Sinnaurni   </option>
 <option     <?php $value=  "   STF Sinnawaththa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sinnawaththa    "   >   STF Sinnawaththa    </option>
 <option     <?php $value=  "   STF Sirikotha   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sirikotha   "   >   STF Sirikotha   </option>
 <option     <?php $value=  "   STF Sooriyakattanadu    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sooriyakattanadu    "   >   STF Sooriyakattanadu    </option>
 <option     <?php $value=  "   STF Sooriyawewa Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sooriyawewa Camp    "   >   STF Sooriyawewa Camp    </option>
 <option     <?php $value=  "   STF Sorikalmuna "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sorikalmuna "   >   STF Sorikalmuna </option>
 <option     <?php $value=  "   STF Sport Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Sport Division  "   >   STF Sport Division  </option>
 <option     <?php $value=  "   STF Tangawaladipuram    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Tangawaladipuram    "   >   STF Tangawaladipuram    </option>
 <option     <?php $value=  "   STF Tempitiya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Tempitiya   "   >   STF Tempitiya   </option>
 <option     <?php $value=  "   STF Thalawai    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Thalawai    "   >   STF Thalawai    </option>
 <option     <?php $value=  "   STF Thalawakele Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Thalawakele Camp    "   >   STF Thalawakele Camp    </option>
 <option     <?php $value=  "   STF Thambanekulam   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Thambanekulam   "   >   STF Thambanekulam   </option>
 <option     <?php $value=  "   STF Thanamalvila    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Thanamalvila    "   >   STF Thanamalvila    </option>
 <option     <?php $value=  "   STF Thikkodai   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Thikkodai   "   >   STF Thikkodai   </option>
 <option     <?php $value=  "   STF Thumpalanchola  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Thumpalanchola  "   >   STF Thumpalanchola  </option>
 <option     <?php $value=  "   STF Torinton    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Torinton    "   >   STF Torinton    </option>
 <option     <?php $value=  "   STF Transport Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Transport Division  "   >   STF Transport Division  </option>
 <option     <?php $value=  "   STF Tummulla    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Tummulla    "   >   STF Tummulla    </option>
 <option     <?php $value=  "   STF Tumpankerani    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Tumpankerani    "   >   STF Tumpankerani    </option>
 <option     <?php $value=  "   STF Udimbikulam "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Udimbikulam "   >   STF Udimbikulam </option>
 <option     <?php $value=  "   STF Unnachchiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Unnachchiya "   >   STF Unnachchiya </option>
 <option     <?php $value=  "   STF Urani   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Urani   "   >   STF Urani   </option>
 <option     <?php $value=  "   STF Urasari "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Urasari "   >   STF Urasari </option>
 <option     <?php $value=  "   STF Urubokka    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Urubokka    "   >   STF Urubokka    </option>
 <option     <?php $value=  "   STF Uyangolla   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Uyangolla   "   >   STF Uyangolla   </option>
 <option     <?php $value=  "   STF Valigahakandiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Valigahakandiya "   >   STF Valigahakandiya </option>
 <option     <?php $value=  "   STF Varikuttu East  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Varikuttu East  "   >   STF Varikuttu East  </option>
 <option     <?php $value=  "   STF Varikuttu West  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Varikuttu West  "   >   STF Varikuttu West  </option>
 <option     <?php $value=  "   STF Vellavali   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Vellavali   "   >   STF Vellavali   </option>
 <option     <?php $value=  "   STF Velvetithurai   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Velvetithurai   "   >   STF Velvetithurai   </option>
 <option     <?php $value=  "   STF Vembiyadikulam  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Vembiyadikulam  "   >   STF Vembiyadikulam  </option>
 <option     <?php $value=  "   STF Veppavettuvan   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Veppavettuvan   "   >   STF Veppavettuvan   </option>
 <option     <?php $value=  "   STF Vidundikulam    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Vidundikulam    "   >   STF Vidundikulam    </option>
 <option     <?php $value=  "   STF Viharahalmillewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Viharahalmillewa    "   >   STF Viharahalmillewa    </option>
 <option     <?php $value=  "   STF Wadinagala  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Wadinagala  "   >   STF Wadinagala  </option>
 <option     <?php $value=  "   STF Walasmulla  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Walasmulla  "   >   STF Walasmulla  </option>
 <option     <?php $value=  "   STF Waligahakandiya Camp    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Waligahakandiya Camp    "   >   STF Waligahakandiya Camp    </option>
 <option     <?php $value=  "   STF Wankale "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Wankale "   >   STF Wankale </option>
 <option     <?php $value=  "   STF Waranagama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Waranagama  "   >   STF Waranagama  </option>
 <option     <?php $value=  "   STF Weherakema  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Weherakema  "   >   STF Weherakema  </option>
 <option     <?php $value=  "   STF Welfare Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Welfare Division    "   >   STF Welfare Division    </option>
 <option     <?php $value=  "   STF Welikada    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Welikada    "   >   STF Welikada    </option>
 <option     <?php $value=  "   STF Wijerama Sub Camp   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Wijerama Sub Camp   "   >   STF Wijerama Sub Camp   </option>
 <option     <?php $value=  "   STF Wordpedesa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Wordpedesa  "   >   STF Wordpedesa  </option>
 <option     <?php $value=  "   STF Yakawewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Yakawewa    "   >   STF Yakawewa    </option>
 <option     <?php $value=  "   STF Yalabowa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Yalabowa    "   >   STF Yalabowa    </option>
 <option     <?php $value=  "   STF Yodawewa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   STF Yodawewa    "   >   STF Yodawewa    </option>
 <option     <?php $value=  "   Supplies    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Supplies    "   >   Supplies    </option>
 <option     <?php $value=  "   Talaimannar "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Talaimannar "   >   Talaimannar </option>
 <option     <?php $value=  "   Talathuoya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Talathuoya  "   >   Talathuoya  </option>
 <option     <?php $value=  "   Tangalle    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Tangalle    "   >   Tangalle    </option>
 <option     <?php $value=  "   Tangalle Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Tangalle Division   "   >   Tangalle Division   </option>
 <option     <?php $value=  "   Teldeniya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Teldeniya   "   >   Teldeniya   </option>
 <option     <?php $value=  "   Tell IGP    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Tell IGP    "   >   Tell IGP    </option>
 <option     <?php $value=  "   Terrorist Investigation Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Terrorist Investigation Division    "   >   Terrorist Investigation Division    </option>
 <option     <?php $value=  "   Thalangama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thalangama  "   >   Thalangama  </option>
 <option     <?php $value=  "   Thalawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thalawa "   >   Thalawa </option>
 <option     <?php $value=  "   Thalawakele "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thalawakele "   >   Thalawakele </option>
 <option     <?php $value=  "   Thambalagamuwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thambalagamuwa  "   >   Thambalagamuwa  </option>
 <option     <?php $value=  "   Thambuttegama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thambuttegama   "   >   Thambuttegama   </option>
 <option     <?php $value=  "   Thanamalwila    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thanamalwila    "   >   Thanamalwila    </option>
 <option     <?php $value=  "   Thanthirimale   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thanthirimale   "   >   Thanthirimale   </option>
 <option     <?php $value=  "   Thebuwana   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thebuwana   "   >   Thebuwana   </option>
 <option     <?php $value=  "   Thelikada   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thelikada   "   >   Thelikada   </option>
 <option     <?php $value=  "   Thellippalai    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thellippalai    "   >   Thellippalai    </option>
 <option     <?php $value=  "   Theripehe   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Theripehe   "   >   Theripehe   </option>
 <option     <?php $value=  "   Thihagoda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thihagoda   "   >   Thihagoda   </option>
 <option     <?php $value=  "   Thiniyawala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thiniyawala "   >   Thiniyawala </option>
 <option     <?php $value=  "   Thirappane  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thirappane  "   >   Thirappane  </option>
 <option     <?php $value=  "   Thirukkowil "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thirukkowil "   >   Thirukkowil </option>
 <option     <?php $value=  "   Thissamaharama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Thissamaharama  "   >   Thissamaharama  </option>
 <option     <?php $value=  "   Tourist Police  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Tourist Police  "   >   Tourist Police  </option>
 <option     <?php $value=  "   Traffic Admin & Road Safety "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Traffic Admin & Road Safety "   >   Traffic Admin & Road Safety </option>
 <option     <?php $value=  "   Transport Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division  "   >   Transport Division  </option>
 <option     <?php $value=  "   Transport Division Ampara   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Ampara   "   >   Transport Division Ampara   </option>
 <option     <?php $value=  "   Transport Division Anuradhapura "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Anuradhapura "   >   Transport Division Anuradhapura </option>
 <option     <?php $value=  "   Transport Division Bingiriya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Bingiriya    "   >   Transport Division Bingiriya    </option>
 <option     <?php $value=  "   Transport Division Jaffna   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Jaffna   "   >   Transport Division Jaffna   </option>
 <option     <?php $value=  "   Transport Division Kalutara "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Kalutara "   >   Transport Division Kalutara </option>
 <option     <?php $value=  "   Transport Division Kundasale    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Kundasale    "   >   Transport Division Kundasale    </option>
 <option     <?php $value=  "   Transport Division Matara   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Matara   "   >   Transport Division Matara   </option>
 <option     <?php $value=  "   Transport Division Narahenpita  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Narahenpita  "   >   Transport Division Narahenpita  </option>
 <option     <?php $value=  "   Transport Division Trincomalee  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Trincomalee  "   >   Transport Division Trincomalee  </option>
 <option     <?php $value=  "   Transport Division Vavuniya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Transport Division Vavuniya "   >   Transport Division Vavuniya </option>
 <option     <?php $value=  "   Trinco-Harbour  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Trinco-Harbour  "   >   Trinco-Harbour  </option>
 <option     <?php $value=  "   Trincomalee "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Trincomalee "   >   Trincomalee </option>
 <option     <?php $value=  "   Trincomalee Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Trincomalee Division    "   >   Trincomalee Division    </option>
 <option     <?php $value=  "   Udamaluwa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Udamaluwa   "   >   Udamaluwa   </option>
 <option     <?php $value=  "   Udappuwa    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Udappuwa    "   >   Udappuwa    </option>
 <option     <?php $value=  "   Udawalawa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Udawalawa   "   >   Udawalawa   </option>
 <option     <?php $value=  "   Ududumbara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ududumbara  "   >   Ududumbara  </option>
 <option     <?php $value=  "   Udugama "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Udugama "   >   Udugama </option>
 <option     <?php $value=  "   Udupussellawa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Udupussellawa   "   >   Udupussellawa   </option>
 <option     <?php $value=  "   Uhana   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Uhana   "   >   Uhana   </option>
 <option     <?php $value=  "   Ulukkulama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Ulukkulama  "   >   Ulukkulama  </option>
 <option     <?php $value=  "   Uppuveli    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Uppuveli    "   >   Uppuveli    </option>
 <option     <?php $value=  "   Uragasmanhandiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Uragasmanhandiya    "   >   Uragasmanhandiya    </option>
 <option     <?php $value=  "   Urubokka    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Urubokka    "   >   Urubokka    </option>
 <option     <?php $value=  "   Uva Paranagama  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Uva Paranagama  "   >   Uva Paranagama  </option>
 <option     <?php $value=  "   Uva Province    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Uva Province    "   >   Uva Province    </option>
 <option     <?php $value=  "   Valachchenai    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Valachchenai    "   >   Valachchenai    </option>
 <option     <?php $value=  "   Vaunathivu  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Vaunathivu  "   >   Vaunathivu  </option>
 <option     <?php $value=  "   Vavuniya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Vavuniya    "   >   Vavuniya    </option>
 <option     <?php $value=  "   Vavuniya Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Vavuniya Division   "   >   Vavuniya Division   </option>
 <option     <?php $value=  "   Vellavely   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Vellavely   "   >   Vellavely   </option>
 <option     <?php $value=  "   Velvetithurai   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Velvetithurai   "   >   Velvetithurai   </option>
 <option     <?php $value=  "   Veyangoda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Veyangoda   "   >   Veyangoda   </option>
 <option     <?php $value=  "   Victims Of Crime And Witnesses Assistance And  Protection Division  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Victims Of Crime And Witnesses Assistance And  Protection Division  "   >   Victims Of Crime And Witnesses Assistance And  Protection Division  </option>
 <option     <?php $value=  "   Wadduwa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wadduwa "   >   Wadduwa </option>
 <option     <?php $value=  "   Wadukotte   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wadukotte   "   >   Wadukotte   </option>
 <option     <?php $value=  "   Wakarai "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wakarai "   >   Wakarai </option>
 <option     <?php $value=  "   Walapone    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Walapone    "   >   Walapone    </option>
 <option     <?php $value=  "   Walasmulla  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Walasmulla  "   >   Walasmulla  </option>
 <option     <?php $value=  "   Wanathawilluwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wanathawilluwa  "   >   Wanathawilluwa  </option>
 <option     <?php $value=  "   Wanduramba  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wanduramba  "   >   Wanduramba  </option>
 <option     <?php $value=  "   Wan-Ela "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wan-Ela "   >   Wan-Ela </option>
 <option     <?php $value=  "   Wankalai    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wankalai    "   >   Wankalai    </option>
 <option     <?php $value=  "   Warakagoda  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Warakagoda  "   >   Warakagoda  </option>
 <option     <?php $value=  "   Warakapola  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Warakapola  "   >   Warakapola  </option>
 <option     <?php $value=  "   Wariyapola  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wariyapola  "   >   Wariyapola  </option>
 <option     <?php $value=  "   Watawala    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Watawala    "   >   Watawala    </option>
 <option     <?php $value=  "   Wattala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wattala "   >   Wattala </option>
 <option     <?php $value=  "   Wattegama   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wattegama   "   >   Wattegama   </option>
 <option     <?php $value=  "   Wedithalthivu (Adappan) "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wedithalthivu (Adappan) "   >   Wedithalthivu (Adappan) </option>
 <option     <?php $value=  "   Weeraketiya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Weeraketiya "   >   Weeraketiya </option>
 <option     <?php $value=  "   Weerambugedara  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Weerambugedara  "   >   Weerambugedara  </option>
 <option     <?php $value=  "   Weerangula  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Weerangula  "   >   Weerangula  </option>
 <option     <?php $value=  "   Weeravila   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Weeravila   "   >   Weeravila   </option>
 <option     <?php $value=  "   Welambada   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Welambada   "   >   Welambada   </option>
 <option     <?php $value=  "   Welfare Division    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Welfare Division    "   >   Welfare Division    </option>
 <option     <?php $value=  "   Weligama    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Weligama    "   >   Weligama    </option>
 <option     <?php $value=  "   Weligepola  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Weligepola  "   >   Weligepola  </option>
 <option     <?php $value=  "   Welikada    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Welikada    "   >   Welikada    </option>
 <option     <?php $value=  "   Welikanda   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Welikanda   "   >   Welikanda   </option>
 <option     <?php $value=  "   Welimada    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Welimada    "   >   Welimada    </option>
 <option     <?php $value=  "   Welioya "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Welioya "   >   Welioya </option>
 <option     <?php $value=  "   Welipenna   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Welipenna   "   >   Welipenna   </option>
 <option     <?php $value=  "   Weliweriya  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Weliweriya  "   >   Weliweriya  </option>
 <option     <?php $value=  "   Wellampitiya    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wellampitiya    "   >   Wellampitiya    </option>
 <option     <?php $value=  "   Wellawa "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wellawa "   >   Wellawa </option>
 <option     <?php $value=  "   Wellawatta  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wellawatta  "   >   Wellawatta  </option>
 <option     <?php $value=  "   Wellawaya   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wellawaya   "   >   Wellawaya   </option>
 <option     <?php $value=  "   Wennappuwa  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wennappuwa  "   >   Wennappuwa  </option>
 <option     <?php $value=  "   Western Province    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Western Province    "   >   Western Province    </option>
 <option     <?php $value=  "   Western Province Intelligence Bureau    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Western Province Intelligence Bureau    "   >   Western Province Intelligence Bureau    </option>
 <option     <?php $value=  "   Wewelwatta  "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wewelwatta  "   >   Wewelwatta  </option>
 <option     <?php $value=  "   Wilgamuwa   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Wilgamuwa   "   >   Wilgamuwa   </option>
 <option     <?php $value=  "   Woulfendhal "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Woulfendhal "   >   Woulfendhal </option>
 <option     <?php $value=  "   WP North Crime Division "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   WP North Crime Division "   >   WP North Crime Division </option>
 <option     <?php $value=  "   WP North Traffic Division   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   WP North Traffic Division   "   >   WP North Traffic Division   </option>
 <option     <?php $value=  "   Yakkala "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Yakkala "   >   Yakkala </option>
 <option     <?php $value=  "   Yakkalamulla    "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Yakkalamulla    "   >   Yakkalamulla    </option>
 <option     <?php $value=  "   Yatawatta   "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Yatawatta   "   >   Yatawatta   </option>
 <option     <?php $value=  "   Yatiyantota "   ;    echo ($Referred_Division===$value) ? 'selected="selected"' :  ''; ?> value=    "   Yatiyantota "   >   Yatiyantota </option>

                                
                            </select>
                        <div class="form-group">
                            <label>Tittle of the Letter(English)</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $E_Title_of_the_Lettere; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Tittle of the Letter(Sinhala)</label>
                            <textarea name="address1" class="form-control <?php echo (!empty($address1_err)) ? 'is-invalid' : ''; ?>"><?php echo $S_Title_of_the_Letters; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address1_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Date of receipt / referral</label>
                            <input type="date" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Date_of_receipt; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Issue Date</label>
                            <input type="date" name="salary1" class="form-control <?php echo (!empty($salary1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Issue_Date; ?>">
                            <span class="invalid-feedback"><?php echo $salary1_err;?></span>
                        </div>


                        <div class="form-group">
                            <label>Calender Date</label>
                            <input type="date" name="address2" class="form-control <?php echo (!empty($address2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Calender_Date; ?>">
                            <span class="invalid-feedback"><?php echo $address2_err;?></span>
                        </div>


                         <div class="form-group">
                            <label>Calender Date For DIG</label>
                            <input type="date" name="address3" class="form-control <?php echo (!empty($address3_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Calender_For_DIG; ?>">
                            <span class="invalid-feedback"><?php echo $address3_err;?></span>
                        </div>



                        <div class="form-group">
                            <label>Current Soft copy of the letter file name is :<strong> <?php echo $file; ?> </label>
                            <input type="hidden" name="photo1" value="<?php echo $file; ?>"/>
                            <label>If you want to Add New Please select </strong></label>
                            <input type="file" name="photo" class="form-control" value="<?php echo $file; ?>" id="fileSelect">
                            <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png, .pdf formats allowed to a max size of 5 MB.</p>
                        </div>

                        <div class="form-group">
                            <label>Who accepted the letter</label>
                            <input type="name" name="address4" class="form-control <?php echo (!empty($address4_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Officer_Name; ?>">
                            <span class="invalid-feedback"><?php echo $address4_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">


                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>