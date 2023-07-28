<?php
session_start();

include 'includes/header.php';
include 'includes/navigation.php';
?>

  <div class="admin-dashboard">
    <div class="container">
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
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
