<?php

include 'includes/header.php'; 
if($session->check('role_user')){
  $validation->redirect('index.php');
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['register'])){

            $username = $validation->handelInput($_POST['username']);
            $email = $validation->handelInput($_POST['email']);
            $password = $validation->handelInput($_POST['password']);

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

            $file_extension = $validation->file_extension($img_name);

            // file mime type
            $allowed_mime_type = ['image/png', 'image/jpg', 'image/jpeg'];

            if( $img_error == 4){
                    $form_errors['image_error'] = 'choose an image for your profile';
                }else{ // that mean error is 0
                    if( $img_error == 0
                                    &&  in_array($file_extension, $allowed_extension)
                                    &&  in_array(mime_content_type($img_tmp_name), $allowed_mime_type)
                                    &&  $img_size > 1298034728934073 ){
                        $form_errors['image_error']  = 'profile image it\'s large';
                    }
                    if($img_error == 0 && !in_array($file_extension, $allowed_extension)){
                        $form_errors['image_error'] = 'not valid file please chosse image';
                    }

                    if($img_error == 0 && in_array($file_extension, $allowed_extension) 
                    && !in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){
                        $form_errors['image_error'] = 'content of file is not image';
                    }


                    if($img_error == 0
                                    && in_array($file_extension, $allowed_extension)  
                                    && in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){

                        $new_img_name = "IMG-" . rand(0, getrandmax()) . "." . $file_extension;

                        $validation->uploade_file("admin\uploaded_imgs",$img_tmp_name, $new_img_name);
                    }
                }

            if(strlen($username) < 3){
                $form_errors['username_error'] = 'Username Must be larger than 2 characters';
            }
            $count = $auth->getSingleUserData($email, 'user')['count'];
            if( $count > 0 ){
                $form_errors['email_error'] = 'Email aleardy exists';
            }
            if($email == ''){
                $form_errors['email_error'] = 'Email Cann\'t be empty';
            }
            if(strlen($password) < 6){
                $form_errors['password_error'] = 'Password Must be larger than 5 characters';
            }


            if(empty($form_errors)){
                if($auth->register($username, $email, $password_hashed, $new_img_name, 'user')){
                    $validation->redirect('login.php');
                }else{
                    $register_database_error = 'try agian later!';
                    $validation->redirect('register.php');
                }
                ?>
            <?php } // empty form_errors ?>
    <?php
    }// end 
}
?>
<?php 

  if(isset($register_database_error)){ ?>
      <div class="container">
              <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
              <?php echo $register_database_error; ?>
              </div>
          </div>
  <?php  } ?>
<div class="create_admin">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2>Register New Account</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="m-auto" enctype="multipart/form-data">
          <!-- Start Username -->
          <div class="form-group">
            <label>username:</label>
            <input type="text" placeholder="Username" class="form-control" name="username">
            <?php if(isset($form_errors['username_error']) && !empty($form_errors['username_error'])){ ?>
                <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['username_error']; ?></div>
            <?php } ?>
          </div>
          <!-- Start Email -->
          <div class="form-group">
            <label>Email:</label>
            <input type="text" placeholder="Email" class="form-control" name="email">
            <?php if(isset($form_errors['email_error']) && !empty($form_errors['email_error'])){ ?>
                <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['email_error']; ?></div>
            <?php } ?>
          </div>
          <!-- Start Password -->
          <div class="form-group">
            <label>Password:</label>
            <input type="text" placeholder="Password" class="form-control" name="password">
            <?php if(isset($form_errors['password_error']) && !empty($form_errors['password_error'])){ ?>
                <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['password_error']; ?></div>
            <?php } ?>
          </div>

          <!-- Start Profile Image -->
          <label>Choose Profile Image: with jpg or png or jpeg only</label>
          <input type="file" name="profile_img">
          <?php if(isset($form_errors['image_error']) && !empty($form_errors['image_error'])){ ?>
                <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['image_error']; ?></div>
          <?php } ?>

          <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="register">
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
 </div>

<?php include 'includes/footer.php'; ?>
