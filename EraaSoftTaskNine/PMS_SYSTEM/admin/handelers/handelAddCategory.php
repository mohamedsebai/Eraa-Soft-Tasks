<?php

session_start();


include '../database/connect.php';
require('../includes/functions.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['addCategory'])){

            $cat_name = handelInput($_POST['cat_name']);
            $description = handelInput($_POST['cat_description']);
            $user_id = $_POST['user_id'];

            $form_errors = array();

            if(strlen($cat_name) < 3){
                $form_errors[] = 'Category name Must be larger than 2 characters';
            }

            if($description == ''){
                $form_errors[] = 'description Cann\'t be empty';
            }
            if(strlen($description) > 60){
                $form_errors[] = 'description Must be small than 60 characters';
            }

            if(! empty($form_errors) ){
                $_SESSION['errors'] = $form_errors;
                header("Location: ../addCategory.php");
                exit();
            }
            // not empty error

            if(empty($form_errors)){
                if(insertCategoryData($cat_name, $description, $user_id )){
                    $_SESSION['success_add'] = 'data update successfully!';
                    header("Location: ../addCategory.php");
                }else{
                    $_SESSION['add_category_database_error'] = 'try agian later!';
                    header("Location: ../addCategory.php");
                    exit();
                }
                ?>
            <?php } // empty form_errors ?>
    <?php
    }// end 
}else{
        header('Location: ../index.php');
} // end check request method ?>