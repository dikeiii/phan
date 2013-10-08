<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>Admin Panel</title>
     <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body id="admin">
    <div id="wrapper">
    <?php
        if(isset($_SESSION['name'])) {
            echo "<h3>Welcome to the Admin Panel, ". $_SESSION['name']."</h3>";
                } else {
                    header('location: index.php');
                }
            ?>
            <p><a href="logout.php">Logout</a></p>            
    </div>

</body>

</html>