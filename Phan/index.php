<?php session_start(); ?>
<?php if(isset($_SESSION['name'])) {
    header('location:admin.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title>Login</title>
     <link href="style.css" type="text/css" rel="stylesheet" />
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
     <script type="text/javascript">
        $(document).ready(function() {
            $('form').hide();
            $('a').click(function() {
               $(this).parent('div').prev('form').slideToggle('normal');
               $(this).toggleClass('active');
               return false;
            });
        });
     </script>

</head>

<body>
<?php
if(isset($_POST['submit'])) {
$errors = array();
$required = array('email','pword');
foreach($required as $fieldname) {
    if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
        $errors[]= "The <strong> {$fieldname} </strong> was left blank";
    }
}//End: foreach
if(empty($errors)) {
    $conn = mysqli_connect('localhost','root','','users') or die('Could not connect to DB');
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pword = mysqli_real_escape_string($conn,$_POST['pword']);
    $hash_pw = $pword;
    
    $query = "SELECT CONCAT_WS(' ', first_name, last_name) 
              AS name
              FROM users
              WHERE email='$email'
              AND pword='$hash_pw'
              LIMIT 1";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    if(mysqli_num_rows($result) == 1) {
        while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $_SESSION['name'] = $rows['name'];
            header('location: admin.php');
        }
    } else {
        $errors[] = "The email or password do not match those on file.";
    }
}

}//End if($_POST['submit'])
else {
    if(isset($_GET['stat']) && $_GET['stat'] == 1) {
        $message = "<ul><li>You are now logged out.</li></ul>";
    }
}
?>
    <div id="wrapper">
        <?php if(!empty($errors)) {
            echo "<ul>";
            foreach($errors as $error) {
                echo "<li>{$error}</li>";
            }
            echo "</ul>";
        }?>
        
        <?php if(isset($message)) echo $message;?>
        <form action="" method="post">
            <p>
                <label for="email">Email</label>
                <input type="text" name="email" />
            </p>
            
            <p>
                 <label for="password">Password</label>
                <input type="password" name="pword" />
            </p>
            
            <p>
                <input type="submit" name="submit" value="Go" />
            </p>
        </form>
        <div class='login'>
            <a href="#">Login</a>
        </div>
    </div>
</body>

</html>