<?php 

session_start();

include 'includes/header.php'; 
if(!isset($_SESSION['role_user'])){
    header('Location: login.php');
    exit();
}

if( (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) && isset($_GET['user_id']) ){
    $user_id = $_GET['user_id'];
    $product_id = $_GET['product_id'];
    $q = "DELETE FROM carts WHERE product_id = ? AND user_id = ?";
    $stmt = $db->prepare($q);
    $stmt->execute([ $product_id , $user_id ]);
    header("Location: cart.php");
}
?>

    <div class="wrap">
      <?php include 'includes/navigation.php'; ?>
      <!-- END header -->

      <section class="site-section py-sm">
        <div class="container">

          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">Products In Your Cart</h2>
            </div>
          </div>

          <div class="row blog-entries">
            <div class="container">
              <div class="row">
                <?php
                    $query = "SELECT carts.*,
                    products.id as prod_id,
                    users.username,
                    products.prd_image,
                    products.prd_name,
                    products.prd_brand_name
                    FROM carts 
                    INNER JOIN products
                    ON carts.product_id = products.id
                    INNER JOIN users
                    ON carts.user_id = users.id
                    WHERE carts.user_id = ?";

                    $stmt  = $db->prepare($query);
                    $stmt->execute([$_SESSION['role_user_user_id']]);
                    $count = $stmt->rowCount();
                    $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);

                ?>
                <?php 
                        if($count > 0): 
                        foreach($row as $data):
                        ?>
                    <div class="col-md-4">
    
                            
                    <div class="card">
                        <img class="card-img-top" src="<?php echo 'admin/uploaded_imgs/' . $data['prd_image'] ?>" alt="Card image cap">
                    <div class="card-header">
                        <?php echo $data['prd_name']; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data['prd_brand_name']; ?></h5>
                        <p class="card-text">Saller: <?php  echo $data['username']; ?></p>
                        <a class="btn btn-primary" href="product.php?product_id=<?php echo $data['prod_id']; ?>" class="card-link">Details</a>
                        <a href="cart.php?product_id=<?php echo $data['prod_id']; ?>&user_id=<?php echo $_SESSION['role_user_user_id']; ?>" class="btn btn-danger card-link">Delete from cart</a>
                    </div>
                    </div>



                        </div>
                    <?php endforeach;  else: ?>
                        <div class="alert alert-danger">There is no Products</div>
                    <?php endif; ?>
                </div>
                </div>
            </div>

            </div>
        </section>

    </div>

    <!-- loader -->
<?php include 'includes/footer.php'; ?>