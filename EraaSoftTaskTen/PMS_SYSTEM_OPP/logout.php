<?php
session_start();

if(isset($_SESSION['role_user'])){
    unset($_SESSION['role_user']);
    unset($_SESSION['role_user_email']);
    unset($_SESSION['role_user_user_id']);
    unset($_SESSION['role_user_img']);
}

header("Location: login.php");
exit();
