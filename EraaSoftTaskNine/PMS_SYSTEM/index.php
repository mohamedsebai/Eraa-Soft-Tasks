<?php 

session_start();

include 'includes/header.php'; 

?>

    <div class="wrap">
      <?php include 'includes/navigation.php'; ?>
      <!-- END header -->

      <section class="site-section py-sm">
        <div class="container">

          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">Products</h2>
            </div>
          </div>

          <div class="row blog-entries">
            <div class="container">
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
                    ORDER BY id DESC";
                    $stmt  = $db->prepare($query);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php 
                    if($count > 0): 
                      foreach($row as $data):
                    ?>
                  <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo 'admin/uploaded_imgs/' . $data['prd_image'] ?>" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $data['prd_name']; ?></h5>
                      <p class="card-text"><?php echo $data['prd_brand_name']; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Price: <?php echo $data['prd_price']; ?></li>
                      <li class="list-group-item">Discount: <?php echo $data['prd_discount']; ?></li>
                      <li class="list-group-item">Saller: <?php echo $data['username']; ?></li>
                    </ul>
                    <div class="card-body">
                      <a href="product.php?product_id=<?php echo $data['id']; ?>" class="card-link">Details</a>
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
