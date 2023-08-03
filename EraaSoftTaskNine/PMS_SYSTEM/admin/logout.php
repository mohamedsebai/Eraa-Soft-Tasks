<?php
session_start();

if(isset($_SESSION['role_admin'])){
    unset($_SESSION['role_admin']);
    unset($_SESSION['email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['img']);
}


header("Location: login.php");
exit();
