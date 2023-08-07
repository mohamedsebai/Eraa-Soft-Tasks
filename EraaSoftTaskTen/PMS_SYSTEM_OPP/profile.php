<?php
include 'includes/header.php'; 
include 'includes/navigation.php';

if(!$session->check('role_user')){
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
        if($session->get('role_user_user_id')){
          echo $session->get('role_user_email') . '<br>';
          ?>
          <img src="<?php echo 'admin/uploaded_imgs/' . $session->get('role_user_img') ?>" alt="">
          <?php 
        }
      ?>
      </div>
    </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
