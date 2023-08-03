<?php

session_start();

require('../includes/functions.php');
include '../admin/database/connect.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $_SESSION['error_login'] = 'email can not be empty';
            header('Location: ../login.php');
            exit();
        }
        if(empty($password)){
            $_SESSION['error_login'] = 'password can not be empty';
            header('Location: ../login.php');
            exit();
        }
            $role = 'user';
            $count = getSingleUserData($email, $role)['count'];
            if($count > 0){
                $userData = getSingleUserData($email, $role)['data'];

                if($userData['email'] == $email){
                    $stored_password = $userData['password'];
                    if(password_verify($password, $userData['password'])){
                        $_SESSION['role_user']   = 'role_user';
                            $_SESSION['role_user_email']   = $userData['email'];
                            $_SESSION['role_user_user_id'] = $userData['id'];
                            $_SESSION['role_user_img'] = $userData['profile_img'];
                            header('Location: ../profile.php');
                    }else{
                        $_SESSION['error_login'] = 'somthing is wrong with email and password';
                        header('Location: ../login.php');
                    }
                }else{
                    $_SESSION['error_login'] = 'you have to create account first';
                    header('Location: ../login.php');
                }

            }else{
                $_SESSION['error_login'] = 'you have to create account first';
                header('Location: ../login.php');
            }

        
    }
}else{
        header('Location: ../index.php');
        exit();
} // end check request method
