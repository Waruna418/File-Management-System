<?php

// Check that the session
require_once ("includes/session.php");
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 8;
$offset = ($pageno-1) * $no_of_records_per_page; 

function datedifff($datess) {
    $now = time(); // or your date as well
    $your_date = strtotime($datess);
    $datediff = ceil(($now - $your_date)/86400);
    return ($datediff);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="images/download.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        table tr td:last-child{
            width: 120px;
        }
        .td1{
            width: 200px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">POLICE LETTER DETAILS</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add New Letter</a>
                        <a href="search.php?RefNum=&YrRefNum=&Issue_Date=&DateRec=&Calender_Date=&HowRecv=&RefDiv=&Officer_Name=&STitle=&ETitle=&submit=" class="btn pull-right"><i class="fa fa-search"></i> Search Now</a>
                        <?php 
                        if ($_SESSION["user_type"]=='1') {
                            echo '<a href="admin-dash.php" class="btn btn-success pull-right"><i class="fa fa-home"></i> Admin Dashboard</a>';
                        }else{
                            echo '<a href="welcome.php" class="btn btn-success pull-right"><i class="fa fa-home"></i> User Account Page</a>';
                        }
                        ?>
                        
                        </div>

                    <?php
                    // Include config file
                    require_once "includes/db_config.php";
                    // var_dump($_SESSION);
                    // exit();
                    $total_pages_sql = "SELECT COUNT(*) FROM registration";
                    $result1 = mysqli_query($link,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result1)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);

                    // Attempt select query execution
                    $sql = "SELECT * FROM registration  LIMIT $offset, $no_of_records_per_page";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        //echo "<th>#</th>";
                                        echo "<th>Reference number(Our_Reference)</th>";
                                        echo "<th>Received number(Your_Reference)</th>";
                                        echo "<th>How received</th>";
                                        echo "<th>Referred Division</th>";
                                        echo "<th>Title of the Letter(English)</th>";
                                        echo "<th>Title of the Letter(Sinhala)</th>";
                                        echo "<th>Date of receipt</th>";
                                        echo "<th>Issue Date</th>";
                                        echo "<th>Calender Date</th>";
                                        echo "<th>Calender For DIG</th>";
                                        echo "<th>who accepted the letter</th>";
                                        echo "<th style='width:50px;'><center>Action</center></th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo '<tr ' ;
                                    if (datedifff($row['Issue_Date'])<=4 or datedifff($row['Calender_Date'])<=4 or datedifff($row['Calender_For_DIG'])<=4) {echo 'style="background-color: #ff3a3a;"';}
                                    else if  (datedifff($row['Issue_Date'])<=6 or datedifff($row['Calender_Date'])<=6 or datedifff($row['Calender_For_DIG'])<=6) {echo 'style="background-color: #ffa03e;"';}
                                    else if  (datedifff($row['Issue_Date'])<=10 or datedifff($row['Calender_Date'])<=10 or datedifff($row['Calender_For_DIG'])<=10) {echo 'style="background-color: #e1ff3e;"';}

                                    echo'>';
                                        //echo "<td>" . $row['id'] . "</td>";
                                        echo "<td><center>" . $row['Reference_number'] . "</center></td>";
                                        echo "<td><center>" . $row['Received_number'] . "</center></td>";
                                        echo "<td>" . $row['How_received'] . "</td>";
                                        echo "<td>" . $row['Referred_Division'] . "</td>";
                                        echo "<td>" . $row['E_Title_of_the_Lettere'] . "</td>";
                                        echo "<td>" . $row['S_Title_of_the_Letters'] . "</td>";
                                        echo "<td>" . $row['Date_of_receipt'] . "</td>";
                                        echo "<td>" . $row['Issue_Date'] . "</td>";
                                        echo "<td>" . $row['Calender_Date'] . "</td>";
                                        echo "<td>" . $row['Calender_For_DIG'] . "</td>";
                                        echo "<td>" . $row['Officer_Name'] . "</td>";

                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            if($_SESSION['user_type']=='1') { echo ('<a href="delete.php?id='. $row['id'] .'" class="mr-3" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>'); }
                                            
                                            echo '<a href="download.php?file='. $row['file'] .'" class="mr-3" title="Download Document" data-toggle="tooltip"><span class="fa fa-download"></span></a>';

                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";?>
                            <ul class="pagination">
                                <li><a href="?pageno=1">First</a></li>
                                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                                </li>
                                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                                </li>
                                <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                            </ul>
                            <?php
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            echo '<a href="index.php" class="btn btn-success">Visit Home</a>';
                        }
                    } else{
                        echo '<div class="alert alert-danger"><em>Oops! Something went wrong. Please try again later.</em></div>';
                        echo '<a href="index.php" class="btn btn-success">Visit Home</a>';
                    
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>