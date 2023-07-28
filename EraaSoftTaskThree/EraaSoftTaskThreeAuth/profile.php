<?php
 session_start();

// if(isset($_SESSION['user'])){
include 'includes/header.php';
include 'includes/navigation.php';
?>
 <div class="profile_page">
   <div class="container">
     <h2 class="text-center">Profile</h2>
      <div class="profile_info">
      <div class="row">
        <div class="col-md-9">
         <?php 
          if(isset($_SESSION['auth'])){
            foreach ( $_SESSION['auth'] as $data ) {
              ?>
                <div class="container">
                    <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                    <?php echo $data; ?>
                    </div>
                </div>
              <?php
            }
          }else{
            header('location: login.php');
            die();
          }
        ?>
        </div>
      </div>
     </div>
</div>

<?php include 'includes/footer.php'; ?>
