 
<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Search Information Details</title>
    <link rel="shortcut icon" href="images/download.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<body background ="Bana.jpg">
<nav class="navbar navbar-expand-lg navbar-transparent bg-transparent navbar-expand-sm"
color="transparent" size="2"> <a class="navbar-brand" style="margin-left:20px" href="Welcome.php">File Management System</a>
    <ul
    style="margin-right:40px" class="nav navbar-nav ml-auto">
       
        <li class="nav-item"><a href="create.php" class="nav-link">Add New Letter</a>
        </li>
       </li>
        <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a>
        </li>
        </ul>
</nav>
<div class="text-center">
  <h2>Letter Information Details</h2>
</div>
<div class="container">
<form >

	<div class="container" style="margin-left:22px">

 


</head>




<body>

  <div class="form">
     
      <form action="<?php $_PHP_SELF?>" method="GET">

      	<p>
          <label for="RefNum" style='min-width:250px'><b>Reference number</b></label>
  <input type="text" name="RefNum" placeholder="Reference number" >
        </p>
        <p>
          <label for="YrRefNum" style='min-width:250px'><b>Received number</b></label>
  <input type="text" name="YrRefNum" placeholder="Received number" >
        </p>
         <p>
          <label for="HowRecv" style='min-width:250px'><b>How received</b></label>
  <input type="text" name="HowRecv" placeholder="How received">
        </p>
          <p>
          <label for="RefDiv" style='min-width:250px'><b>Received / Referred Division</b></label>
  <input type="text" name="RefDiv" placeholder="Referred Division">
        </p>
         <p>
          <label for="ETitle" style='min-width:250px' ><b>Tittle of the Letter(English)</b></label>
  <input type="text" name="ETitle" placeholder="Title of the Letter(English)">
</p>
 <p>
          <label for="STitle" style='min-width:250px'><b>Tittle of the Letter(Sinhala)</b></label>
  <input type="text" name="STitle" placeholder="Title of the Letter(Sinhala)">
        </p>
         <p>
          <label for="DateRec" style='min-width:250px'><b>Date of receipt / referral</b></label>
  <input type="date" name="DateRec" placeholder="Date of receipt">
        </p>
        <p>
          <label for="Issue_Date" style='min-width:250px'><b>Issue Date</b></label>
  <input type="date" name="Issue_Date" placeholder="Date of Issue">
        </p>
       
        <p>
          <label for="Calender_Date" style='min-width:250px'><b>Calender Date</b></label>
  <input type="date" name="Calender_Date" placeholder="Calender Date">
        </p>
       
        
      
        <p>
          <label for="Officer_Name" style='min-width:250px'><b>Accepted Officer Name</b></label>
  <input type="text" name="Officer_Name" placeholder="Accepted Officer's Name">
        </p>
      
       

<p> 
    <button type="submit" class="btn btn-primary btn-xs" name="submit" style="width:100px;margin-right:500px">Search</button>
</p>
      
</form>
</div>

<?php

require_once "includes/db_config.php";
// Check that the session
require_once ("includes/session.php");

function datedifff($datess) {
    $now = time(); // or your date as well
    $your_date = strtotime($datess);
    $datediff = ceil(($now - $your_date)/86400);
    return ($datediff);
}

    $STitle="";
    $Calender_Date="";
    $Calender_For_DIG="";
    $Officer_Name="";
    $DateRec="";
    $RefNum="";
    $RefDiv="";
    $ETitle="";
    $STitle="";

    $RefNum=$_GET["RefNum"];
    $YrRefNum=$_GET["YrRefNum"];
    $HowRecv=$_GET["HowRecv"];
    $DateRec=$_GET["DateRec"];
    $Officer_Name=$_GET["Officer_Name"];
    #$Calender_For_DIG=$_GET["Calender_For_DIG"];
    $Calender_Date=$_GET["Calender_Date"];
    $Issue_Date=$_GET["Issue_Date"];
    $RefDiv=$_GET["RefDiv"];
    $STitle=$_GET["STitle"];
    $ETitle=$_GET["ETitle"];

if ($RefNum != NULL ||  $DateRec!= NULL || $YrRefNum != NULL || $RefDiv != NULL || $STitle!= NULL || $ETitle!= NULL
        || $Officer_Name != NULL || $HowRecv!= NULL || $Calender_Date!= NULL || $Issue_Date!= NULL) {
	# code...

    if ($STitle== NULL || $ETitle== NULL || $Officer_Name== NULL) {
    
      $query="SELECT * FROM registration where Reference_number = '$RefNum' OR Received_number = '$YrRefNum' OR Date_of_receipt = '$DateRec'
                 OR How_received = '$HowRecv' OR Calender_Date = '$Calender_Date' OR Issue_Date = '$Issue_Date' 
                 OR Referred_Division = '$RefDiv' ";
      $result2 = $link->query($query);
    }
    if($STitle!= null) {
	   $query="SELECT * FROM registration where S_Title_of_the_Letters  LIKE '$STitle%'";
       $result2 = $link->query($query);
    }
    if($ETitle!= null) {
	    $query="SELECT * FROM registration where E_Title_of_the_Lettere LIKE '$ETitle%'";
        $result2 = $link->query($query);
    }
    if($Officer_Name!= null) {
	    $query="SELECT * FROM registration where Officer_Name LIKE '$Officer_Name%'";
        $result2 = $link->query($query);
    }



  if ($result2->num_rows > 0) {
  echo "
  <table class='table table-bordered table-striped' style='margin:0px;line-break: anywhere;'>
  <thead>
  <tr>
      <th>Reference number(Our_Reference)</th>
      <th>Received number(Your_Reference)</th>
      <th>How received</th>
      <th>Referred Division</th>
      <th>Title of the Letter(English)</th>
      <th>Title of the Letter(Sinhala)</th>
      <th>Date of receipt</th>
      <th>Issue Date</th>
      <th>Calender Date</th>
      <th>Calender For DIG</th>
      <th>who accepted the letter</th>
      <th style='width:50px;'><center>Action</center></th>
  </tr>
  </thead>
  <tbody>";

    while($row = $result2->fetch_assoc()) {
     $Reference_number = $row['Reference_number'];
     $Received_number = $row['Received_number'];
     $How_received = $row['How_received'];
     $Date_of_receipt = $row['Date_of_receipt'];
     $Referred_Division = $row['Referred_Division'];
     $STitle_of_the_Letters= $row['S_Title_of_the_Letters'];
     $ETitle_of_the_Lettere= $row['E_Title_of_the_Lettere'];
     $Calender_Date = $row['Calender_Date'];
     $Calender_For_DIG = $row['Calender_For_DIG'];
     $Officer_Name = $row["Officer_Name"];


    echo '<tr ' ;
    if (datedifff($row['Issue_Date'])<=4 or datedifff($row['Calender_Date'])<=4 or datedifff($row['Calender_For_DIG'])<=4) {echo 'style="background-color: #ff3a3a;"';}
    else if  (datedifff($row['Issue_Date'])<=6 or datedifff($row['Calender_Date'])<=6 or datedifff($row['Calender_For_DIG'])<=6) {echo 'style="background-color: #ffa03e;"';}
    else if  (datedifff($row['Issue_Date'])<=10 or datedifff($row['Calender_Date'])<=10 or datedifff($row['Calender_For_DIG'])<=10) {echo 'style="background-color: #e1ff3e;"';}
    echo'>';
     echo "</td>
     <td>" . $Reference_number."</td>
     <td>" . $Received_number. "</td>
     <td>" . $How_received. "</td>
     <td>" . $Referred_Division. "</td>
     <td>" . $ETitle_of_the_Lettere. "</td>
     <td>" . $STitle_of_the_Letters. "</td>
     <td>" . $Date_of_receipt ."</td>
     <td>" . $row["Issue_Date"]."</td>
     <td>".$Calender_Date."</td>
     <td>".$Calender_For_DIG."</td>
     <td>".$Officer_Name."</td>"

     ."<td>".'<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>'
     .'<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
     if($_SESSION['user_type']=='1') { echo ('<a href="delete.php?id='. $row['id'] .'" class="mr-3" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>'); }
     echo '<a href="download.php?file='. $row['file'] .'" class="mr-3" title="Download Document" data-toggle="tooltip"><span class="fa fa-download"></span></a>'."</td>"
     
     ."</tr>";
}
echo "</tbody>
</table>";
echo "<br>";

        }
        else{
                echo '<div class="alert alert-danger"><em>Oops! not records found.</em></div>';
            }
      }  else{
               // echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
    
?>

</body> 
</html>