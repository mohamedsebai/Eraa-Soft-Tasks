<?php

session_start();

require('../includes/functions.php');
include '../database/connect.php';


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
            $role = 'admin';
            $count = getSingleUserData($email, $role)['count'];
            if($count > 0){
                $userData = getSingleUserData($email, $role)['data'];

                if($userData['email'] == $email){
                    $stored_password = $userData['password'];
                    if(password_verify($password, $userData['password'])){
                        $_SESSION['role_admin']   = 'role_admin';
                            $_SESSION['email']   = $userData['email'];
                            $_SESSION['user_id'] = $userData['id'];
                            $_SESSION['img'] = $userData['profile_img'];
                            header('Location: ../index.php');
                            exit();
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
