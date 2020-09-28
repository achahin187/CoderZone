<?php 


SESSION_START();
$_SESSION['username'];
session_unset();
session_destroy();
header("location:signup.php");