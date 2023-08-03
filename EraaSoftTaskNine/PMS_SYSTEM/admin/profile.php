<?php
session_start();

include 'includes/header.php';
include 'includes/navigation.php';
if(!isset($_SESSION['role_admin'])){
  header('Location: login.php');
  exit();
}
?>
 <div class="profile_page">
   <div class="container">
     <h2 class="text-center">Profile</h2>
      <div class="profile_info">
      <div class="row">
        <div class="col-md-9">
         <?php 
          if(isset($_SESSION['user_id'])){
            echo  $_SESSION['email'] . '<br>';
            ?>
            <img src="<?php echo 'uploaded_imgs/' . $_SESSION['img']; ?>" alt="">
            <?php 
          }
        ?>
        </div>
      </div>
     </div>
</div>

<?php include 'includes/footer.php'; ?>
