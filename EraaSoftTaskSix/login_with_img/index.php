<?php
session_start();

include 'includes/header.php';
include 'includes/navigation.php';
if(!isset($_SESSION['user_id'])){
  header('Location: login.php');
  exit();
}
?>

  <div class="admin-dashboard">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
        <?php 
          if(isset($_SESSION['user_id'])){
            echo $_SESSION['username']. '<br>';
            echo $_SESSION['email'] . '<br>';
            ?>
            <img src="<?php echo 'uploaded_imgs/' . $_SESSION['img']; ?>" alt="">
            <?php
          }
        ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
