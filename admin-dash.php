<?php

// Check that the session
require_once ("includes/session.php");
require_once "includes/db_config.php";

if ($_SESSION["user_type"]=='1') {                               
}
else {
    // Redirect user to welcome page
    header("location: welcome.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to admin Dashboard</title>
    <link rel="shortcut icon" href="images/download.jpg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    
    <style>
       body{ font: 14px sans-serif; text-align: center; }
    </style>
    
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body style="background-color: #ebebe0">

    <h1 class="my-5"  style="color:#ff704d">Hello <b>

<?php  echo htmlspecialchars($_SESSION["username"]); ?></b>, Welcome to File Management System Admin Dashboard</h1>
    <p>
         <div style="text-align:center;padding:1em 0;"> <h3><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/en/timezone/asia--colombo"><span style="color:gray;"><iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=Asia%2FColombo" width="100%" height="115" frameborder="0" seamless></iframe> </div>

        <a href="index.php" class="btn btn-success">Home</a>
        <a href="register.php" class="btn btn-primary">Create a User Account</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Admin Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Admin Account</a>
        <!-- <a href="register.php" class="btn btn-success">Add an user</a>
        -->
    </p>
    <?php 
          $query="SELECT * FROM users";
          $result2 = $link->query($query);
            if ($result2->num_rows > 0) {
                echo "
                <div>
                <table class='table table-bordered table-dark' style='display: inline-block; max-width: fit-content;'>
                <thead>
                <tr>
                    
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>Account Created on</th>
                    <th>Last Password Reset</th>
                    <th>Last Loged on</th>
                    <th>Last Log Out on</th>
                    <th>Login Status</th>
                    <th>Account Status</th>
                    <th style='min-width:150px'><center>Action</center></th>
                </tr>
                </thead>
                <tbody>";
                while($row = $result2->fetch_assoc()) {

                     $id = $row['id'];
                     $username = $row['username'];
                     $pass_reset_on = $row['pass_reset_on'];
                     $pass_reset_by = $row['pass_reset_by'];
                     $created_at = $row['created_at'];
                     $user_type = $row['user_type'];
                     $loged_on = $row['loged_on'];
                     $log_out_on = $row['log_out_on'];
                     $log_state = $row['log_state'];
                     $is_active = $row['is_active'];

                     echo '<tr>';
                     echo "<td>" . $username . "</td>";
                     
                      if ($user_type==1){echo '<td><span  style="color:#a60d0d" class="fa fa-user"></span> ADMIN <a href="change_user_type.php?action=act'.$user_type.'&id='. $id .'" class="mr-3" title="Add as an USER" data-toggle="tooltip"><span style="color:#00ffc3" class="fa fa-chevron-circle-left"></span> </a></td>';}
                     else {echo '<td><span style="color:#00ffc3" class="fa fa-user"></span> USER <a href="change_user_type.php?action=act'.$user_type.'&id='. $id .'" class="mr-3" title="Add as an ADMIN" data-toggle="tooltip"><span style="color:#a60d0d" class="fa fa-chevron-circle-right"></span> </a></td>';}
                     echo "<td><center>" . $created_at . "</center></td>";
                     echo "<td><center>" . $pass_reset_on . " - by ". $pass_reset_by ."</center></td>";
                     echo "<td>" . $loged_on . "</td>";
                     echo "<td>" . $log_out_on . "</td>";
                     if ($log_state==1){echo '<td>online <span  style="color:lime" class="fa fa-circle"></span></td>';}
                     else {echo '<td>offline <span style="color:red" class="fa fa-circle-o"></span></td>';}
                     if ($is_active==1){echo '<td>Active <span  style="color:lime" class="fa fa-circle"></span></td>';}
                     else {echo '<td>Lock <span style="color:red" class="fa fa-circle-o"></span></td>';}
                     
                     echo "<td>";
                     if ($user_type=='0') {
                         if ($is_active==1){
                                echo ('<a href="delete_user.php?action=act'.$is_active.'&id='. $id .'"
                                    class="mr-3" title="Disable Account " data-toggle="tooltip"><span style="color:red" class="fa fa fa-lock"></span></a>');
                                    }
                         else {echo ('<a href="delete_user.php?action=act'.$is_active.'&id='. $id .'"
                                    class="mr-3" title="Active Account" data-toggle="tooltip"><span style="color:lime" class="fa fa fa-unlock"></span></a>');
                         }
                         echo ('<a href="reset_user_pass.php?id='. $id .'" class="mr-3" title="Reset User Password" data-toggle="tooltip"><span class="fa fa-undo"></span> Reset </a>');
                     }else{
                        echo '<span style="color:red" class="fa fa-tags"> </span> Actions Unavailable';
                     }
                     echo "</td>";
                     
                     echo '</tr>';
                }
                echo "</tbody>";                            
                echo "</table></div>";
                //mysqli_free_result($result);

                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            echo '<a href="index.php" class="btn btn-success">Visit Home</a>';
                        
                    } 

    ?>
    
</body>

</html>