<?php 
session_start();
include 'includes/header.php'; 
if(!isset($_SESSION['role_user'])){
    header('Location: login.php');
    exit();
}

?>
   <div class="wrap">

<?php include 'includes/navigation.php'; ?>
    <!-- END header -->

    <section class="site-section py-lg">
      <div class="container">
        <div class="row blog-entries element-animate">
          <div class="col-md-12 col-lg-8 main-content">
            <h2>Your Orders</h2>
            <div class="row">
                <?php
                    $query = "SELECT orders.*,
                    users.username,
                    products.prd_image,
                    products.prd_name,
                    products.prd_quantity
                    FROM orders
                    INNER JOIN products
                    ON products.id = orders.product_id
                    INNER JOIN users
                    ON orders.users_id = users.id
                    WHERE orders.users_id = ?
                    ORDER BY id DESC";
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
                <div class="card" >
                <img class="card-img-top" src="<?php echo 'admin/uploaded_imgs/' . $data['prd_image'] ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['prd_name']; ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    Quantity: <?php echo $data['prd_quantity']; ?>
                    </li>
                    <li class="list-group-item">Total Price: <?php echo $data['total']; ?></li>
                    <li class="list-group-item"> <a href="order_details.php?order_id=<?php echo $data['id']; ?>">Order Details</a></li>
                </ul>
                

                </div>
            </div>
            <?php endforeach;  else: ?>
                    <div class="alert alert-danger">There is no Orders</div>
            <?php endif; ?>
            </div>
            
        </div>

    </div>
    </div>
</section>
</div>

<!-- loader -->
<?php include 'includes/footer.php'; ?>
