<?php 
include 'includes/header.php'; 

if( (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) ){
    $product_id = $_GET['product_id'];
}else{
    $validation->redirect('index.php');
}


if( $product_id && isset($_GET['user_id']) ){
    $user_id = $_GET['user_id'];
    $cart->insertData($product_id , $user_id );
    $validation->redirect("product.php?product_id=$product_id");
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
                $count = $product->selectDataWithJoin('id',$product_id)['count'];
                    if($count > 0):
                      $row = $product->selectDataWithJoin('id',$product_id)['row'];
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
                    
                    <?php if($session->get('role_user')){?>
                      <a href="makeOrder.php?product_id=<?php echo $data['id']; ?>" class="card-link">Make Order Now</a>

                      <!-- check if this product aleardy  in carts with same user id ( same person ) -->
                      <?php
                      $count = $cart->selectDataWithCondtion( $session->get('role_user_user_id') , $data['id'])['count'];
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
