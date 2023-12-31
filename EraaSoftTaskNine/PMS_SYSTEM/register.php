<?php
session_start();
include 'includes/header.php'; 
if(isset($_SESSION['role_user'])){
  header('Location: index.php');
  exit();
}
?>
<?php 
    if(isset($_SESSION['errors'])){
      foreach ( $_SESSION['errors'] as $error ) {
        ?>
          <div class="container">
              <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
              <?php echo $error; ?>
              </div>
          </div>
        <?php
      }
      unset($_SESSION['errors']);
    }

    if(isset($_SESSION['register_database_error'])){ ?>
      <div class="container">
              <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
              <?php echo $_SESSION['register_database_error']; ?>
              </div>
          </div>
  <?php  } unset($_SESSION['register_database_error']); ?>
<div class="create_admin">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2>Register New Account</h2>
        <form action="handelers/handelRegister.php" method="POST" class="m-auto" enctype="multipart/form-data">
          <!-- Start Username -->
          <div class="form-group">
            <label>username:</label>
            <input type="text" placeholder="Username" class="form-control" name="username">
          </div>
          <!-- Start Email -->
          <div class="form-group">
            <label>Email:</label>
            <input type="text" placeholder="Email" class="form-control" name="email">
          </div>
          <!-- Start Password -->
          <div class="form-group">
            <label>Password:</label>
            <input type="text" placeholder="Password" class="form-control" name="password">
          </div>
          <!-- Start Profile Image -->
          <label>Choose Profile Image: with jpg or png or jpeg only</label>
          <input type="file" name="profile_img">

          <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="register">
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
 </div>

<?php include 'includes/footer.php'; ?>
