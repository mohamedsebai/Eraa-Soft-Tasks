<?php 


include 'includes/header.php';

if($session->check('role_user')){
  $validation->redirect('index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $form_error = [];

        if(empty($email)){
            $form_error['email_error'] = 'email can not be empty';
        }
        if(empty($password)){
            $form_error['password_error'] = 'password can not be empty';
        }

        if(empty($form_error)){
          
          if($auth->login('user',$email,$password)){
            $validation->redirect('profile.php');
          }else{
            $error_login = 'somthing is wrong with email and password';
          }
          
          
        }
    }
}

?>
<div class="Login">
  <div class="container">
    <div class="row">
<?php
    if(isset($error_login)){
        ?>
          <div class="container">
              <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
              <?php echo $error_login; ?>
              </div>
          </div>
        <?php
    }
?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="m-auto">
        <!-- Start Username -->
        <div class="form-group">
          <label>Email:</label>
          <input type="text" placeholder="email" class="form-control" name="email">
          <?php if(isset($form_error['email_error']) && !empty($form_error['email_error'])){ ?>
              <div class="alert alert-danger py-0 px-1"><?php echo $form_error['email_error']; ?></div>
          <?php } ?>
        </div>
        <!-- Start Password -->
        <div class="form-group">
          <label>Password:</label>
          <input type="text" placeholder="Password" class="form-control" name="password">
          <?php if(isset($form_error['password_error']) && !empty($form_error['password_error'])){ ?>
                <div class="alert alert-danger py-0 px-1"><?php echo $form_error['password_error']; ?></div>
          <?php } ?>
        </div>
        <input type="submit" class="form-control btn btn-primary d-block" value="login" name="login">
      </form>
      <a href="register.php">register</a>
    </div>
  </div>
</div>


<?php include 'includes/footer.php'; ?>
