<?php 
session_start();
include 'includes/header.php'; 

if( (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) ){
    $product_id = $_GET['product_id'];
}else{
    header('Location: index.php');
    exit();
}


if( $product_id && isset($_GET['user_id']) ){
    $user_id = $_GET['user_id'];
    $q = "INSERT INTO carts(product_id,user_id) VALUES(?,?)";
    $stmt = $db->prepare($q);
    $stmt->execute([ $product_id , $user_id ]);
    header("Location: product.php?product_id=$product_id");
}
?>

    <div class="wrap">

<?php include 'includes/navigation.php'; ?>
      <!-- END header -->

    <section class="site-section py-lg">
      <div class="container">
        <div class="row blog-entries element-animate">
          <div class="col-md-12 col-lg-8 main-content">
            <h2>Product Details</h2>
            <div class="row">
                <?php
                    $query = "SELECT products.*,
                    users.username,
                    categories.cat_name
                    FROM products
                    INNER JOIN users
                    ON products.user_id = users.id
                    INNER JOIN categories
                    ON categories.id = products.category_id
                    WHERE products.id = ?
                    ORDER BY id DESC";
                    $stmt  = $db->prepare($query);
                    $stmt->execute([$product_id]);
                    $count = $stmt->rowCount();
                    $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php 
                    if($count > 0): 
                      foreach($row as $data):
                    ?>
                  <div class="col-md-12">
                    <div class="card" >
                    <img class="card-img-top" src="<?php echo 'admin/uploaded_imgs/' . $data['prd_image'] ?>" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $data['prd_name']; ?></h5>
                      <p class="card-text"><?php echo $data['prd_brand_name']; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        Quantity: <?php echo $data['prd_quantity']; ?>
                      </li>
                      <li class="list-group-item">Price: <?php echo $data['prd_price']; ?></li>
                      <li class="list-group-item">Discount: <?php echo $data['prd_discount']; ?></li>
                      <li class="list-group-item">Saller: <?php echo $data['username']; ?></li>


                      <?php echo !empty($data['prd_size']) ?  '<li class="list-group-item">Size: ' .$data['prd_size'] . '</li>': '' ?>
                      <li class="list-group-item">Category: <?php echo $data['cat_name']; ?></li>
                    </ul>
                    
                    <?php if(isset($_SESSION['role_user'])){?>
                    <a href="makeOrder.php?product_id=<?php echo $data['id']; ?>" class="card-link">Make Order Now</a>

                    <!-- check if this product aleardy  in carts with same user id ( same person ) -->
                    <?php
                    $q = "SELECT * FROM carts where user_id = ? And product_id = ?";
                    $stmt = $db->prepare($q);
                    $stmt->execute([ $_SESSION['role_user_user_id'] , $data['id'] ]);
                    $count = $stmt->rowCount();
                    if( $count > 0){ ?>
                      <span class="btn btn-danger">This product is aleardy in your cart You can not add it again</span> 
                    <?php }else{ ?>
                    <div class="card-body">
                      <a href="product.php?product_id=<?php echo $data['id']; ?>&user_id=<?php echo $_SESSION['role_user_user_id']; ?>" class="card-link">Add to Cart</a>
                    </div>
                    <?php } ?>
                    <?php }else{ ?>
                      <a href="login.php" class="card-link">Login to make order</a>
                    <?php }?>
                    



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
