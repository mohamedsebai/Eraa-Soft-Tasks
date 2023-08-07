<?php

include 'includes/header.php';
include 'includes/navigation.php';
if(!$session->check('role_admin')){
  $validation->redirect('login.php');
}
?>

  <div class="admin-dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
        <?php 
            echo $session->get('email') . '<br>';
            ?>
            <img width="100" height="100" src="<?php echo 'uploaded_imgs/' . $session->get('img'); ?>" alt="">
            <?php 
        ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
