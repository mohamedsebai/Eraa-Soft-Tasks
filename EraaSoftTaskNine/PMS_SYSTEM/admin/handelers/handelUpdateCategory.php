<?php

session_start();


include '../database/connect.php';
require('../includes/functions.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['UpdateCategory'])){

            $cat_name = handelInput($_POST['cat_name']);
            $description = handelInput($_POST['cat_description']);
            $cat_id = $_POST['cat_id'];

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
                header("Location: ../update_category.php?category_id=$cat_id");
                exit();
            }
            // not empty error

            if(empty($form_errors)){
                if(updateCategoryData($cat_name, $description, $cat_id )){
                    $_SESSION['success_update'] = 'data update successfully!';
                    header("Location: ../update_category.php?category_id=$cat_id");
                }else{
                    $_SESSION['update_category_database_error'] = 'try agian later!';
                    header("Location: ../update_category.php?category_id=$cat_id");
                    exit();
                }
                ?>
            <?php } // empty form_errors ?>
    <?php
    }// end 
}else{
        header('Location: ../index.php');
} // end check request method ?>