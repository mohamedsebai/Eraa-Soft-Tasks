<?php

session_start();

require('../includes/functions.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['register'])){

            $username = handelInput($_POST['username']);
            $email = handelInput($_POST['email']);
            $password = handelInput($_POST['password']);

            // hash the password
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $profile_img     = $_FILES['profile_img'];
            $img_name        = $profile_img['name'];
            $img_tmp_name    = $profile_img['tmp_name'];
            $img_type        = $profile_img['type'];
            $img_error       = $profile_img['error'];
            $img_size        = $profile_img['size'];

            

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

            

            if(strlen($username) < 3){
                $form_errors[] = 'Username Must be larger than 2 characters';
            }
            if($email == ''){
                $form_errors[] = 'Email Cann\'t be empty';
            }
            if(strlen($password) < 6){
                $form_errors[] = 'Password Must be larger than 5 characters';
            }


            $file = file_get_contents('../data/data_of_users.json');
            $json_data = json_decode($file, true);


            
            if(empty($json_data)){
                $json_data = [];
            }

            foreach($json_data as $data){
                if($data['email'] == $_POST['email']){
                    $form_errors[] = 'email is alerady exisit';
                    break;
                }
            }

            if(! empty($form_errors) ){
                $_SESSION['errors'] = $form_errors;
                header('Location: ../register.php');
                exit();
            }
            // not empty error

            if(empty($form_errors)){

                $extra = array(
                    'id'       => end($json_data)['id'] + 1,
                    'username' => $_POST['username'],
                    'email'    => $_POST["email"],
                    'password' => $password_hashed,
                    'img' => $new_img_name,
                );
                array_push($json_data, $extra);
                $final_data = json_encode($json_data);
            
                file_put_contents('../data/data_of_users.json', $final_data);
                
                $_SESSION['user_id'] = end($json_data)['id'] + 1;
                $_SESSION['img'] = $new_img_name;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header('Location: ../profile.php');
            

                ?>

            <?php } // empty form_errors ?>
    <?php
    }// end 
}else{
        header('Location: ../index.php');
} // end check request method ?>