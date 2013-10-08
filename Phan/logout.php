<?php

//1. find the session
session_start();
//2. Unset all varialbes 
$_SESSION = array();

//3. Unset the cookie
if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(),time()-42000,'/',0,0);
}

//4. destroy session
session_destroy();

//redirect
header('location: index.php?stat=1');



?>