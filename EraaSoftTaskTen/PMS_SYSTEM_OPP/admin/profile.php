<?php

include 'includes/header.php';
include 'includes/navigation.php';
if(!$session->check('role_admin')){
    $validation->redirect('login.php');
}
?>
  <div class="profile_page">
    <div class="container">
      <h2 class="text-center">Profile</h2>
        <div class="profile_info">
        <div class="row">
          <div class="col-md-9">
          <?php 
              echo  $session->get('email') . '<br>';
              ?>
              <img src="<?php echo 'uploaded_imgs/' . $session->get('img'); ?>" alt="">
              <?php 
          ?>
          </div>
        </div>
      </div>
  </div>

<?php include 'includes/footer.php'; ?>
