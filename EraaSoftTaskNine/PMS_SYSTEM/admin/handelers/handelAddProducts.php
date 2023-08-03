<?php

session_start();

require('../includes/functions.php');
include '../database/connect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['addProduct'])){

            $user_id = $_POST['user_id'];
            $category_id = $_POST['category_id'];

            $prd_name = handelInput($_POST['prd_name']);
            $prd_brand_name = handelInput($_POST['prd_brand_name']);
            $prd_price = handelInput($_POST['prd_price']);
            $prd_discount = handelInput($_POST['prd_discount']);
            $prd_size = handelInput($_POST['prd_size']);
            $prd_quantity = handelInput($_POST['prd_quantity']);
            


            $prd_image       = $_FILES['prd_image'];
            $img_name        = $prd_image['name'];
            $img_tmp_name    = $prd_image['tmp_name'];
            $img_type        = $prd_image['type'];
            $img_error       = $prd_image['error'];
            $img_size        = $prd_image['size'];


            $form_errors = array();

            // file extension
            $allowed_extension = ['png', 'jpg', 'jpeg'];
            $file_extension = explode('.', $img_name);
            $file_extension = strtolower(end($file_extension));

            // file mime type
            $allowed_mime_type = ['image/png', 'image/jpg', 'image/jpeg'];


            if( $img_error == 4){
                    $form_errors[] = 'choose an image for your profile';
                }else{ // that mean error is 0
                    if( $img_error == 0
                                    && in_array($file_extension, $allowed_extension) 
                                    &&  in_array(mime_content_type($img_tmp_name), $allowed_mime_type) 
                                    &&  $img_size > 1298034728934073 ){
                        $form_errors[]  = 'profile image it\'s large';
                    }
                    if($img_error == 0 && !in_array($file_extension, $allowed_extension)){
                        $form_errors[] = 'not valid file please chosse image';
                    }

                    if($img_error == 0 && in_array($file_extension, $allowed_extension) 
                    && !in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){
                        $form_errors[] = 'content of file is not image';
                    }

                    if($img_error == 0 
                                    && in_array($file_extension, $allowed_extension)  
                                    && in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){

                        if(!file_exists("..\uploaded_imgs\\")){ // if there is no file like this to uploade img within so we will create it 
                            mkdir("..\uploaded_imgs\\");
                        }

                        $new_img_name = "IMG-" . rand(0, getrandmax()) . ".".$file_extension;
                        move_uploaded_file( $img_tmp_name,  "..\uploaded_imgs\\" . $new_img_name );
                    }
                }


            
            

            if(empty($prd_name)){
                $form_errors[] = 'Product name name Cann\'t be empty';
            }
            

            if(empty($prd_brand_name)){
                $form_errors[] = 'Brand name Cann\'t be empty';
            }
            if(empty($prd_price) ){
                $form_errors[] = 'Price can not be empty';
            }
            if(empty($prd_discount)){
                $form_errors[] = 'Discount can no be empty if there is no discount make it equal zero';
            }
            if(empty($prd_quantity)){
                $form_errors[] = 'Quantity can no be empty if there is no Quantity make it equal zero';
            }

            $array_with_size = ['s', 'm', 'l', 'xl', 'xxl', 'xs', ''];
            if(!in_array($prd_size, $array_with_size)){
                $form_errors[] = 'Insert perfict size';
            }

            if(! empty($form_errors) ){
                $_SESSION['errors'] = $form_errors;
                header('Location: ../addPrdouct.php');
                exit();
            }
            // not empty error

            if(empty($form_errors)){
                $role = 'admin';
                if(insertProductData($prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $new_img_name, $category_id, $user_id)){
                    $_SESSION['success_add'] = 'data update successfully!';
                    header('Location: ../addPrdouct.php');
                }else{
                    $_SESSION['add_product_database_error'] = 'try agian later!';
                    header('Location: ../addPrdouct.php');
                    exit();
                }
                ?>
            <?php } // empty form_errors ?>
    <?php
    }// end 
}else{
        header('Location: ../index.php');
} // end check request method ?>