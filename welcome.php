<?php

// Check that the session
require_once ("includes/session.php");

if ($_SESSION["user_type"]=='1') {
    // Redirect user to admin dashboard page
    header("location: admin-dash.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="shortcut icon" href="images/download.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body background ="images/kandy-sri-lanka-queen-s-hotel-night-traffic-light-trails-police-man-middle-street-149786400.jpg">

    <h1 class="my-5"  style="color:White">Hello <b>

<?php  echo htmlspecialchars($_SESSION["username"]); ?></b>, Welcome to File Management System.</h1>
    <p>
          <div style="text-align:center;padding:1em 0;"> <h3><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/en/city/5368361"><span style="color:gray;"></span><br /></a></h3> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=medium&timezone=America%2FLos_Angeles" width="100%" height="115" frameborder="0" seamless></iframe> </div>

        <a href="index.php" class="btn btn-success">Home</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>

    </p>
</body>

</html>