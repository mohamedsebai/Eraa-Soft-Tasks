<?php 

include 'includes/header.php'; 
if(!$session->check('role_user')){
    $validation->redirect('login.php');
}

if( (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) && isset($_GET['user_id']) ){
    $user_id = $_GET['user_id'];
    $product_id = $_GET['product_id'];
    $cart->deleteData($product_id , $user_id);
    $validation->redirect('cart.php');
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
                $count = $cart->selectDataWithJoin('user_id',$session->get('role_user_user_id'))['count'];
                    if($count > 0):
                        $row = $cart->selectDataWithJoin('user_id',$session->get('role_user_user_id'))['row'];
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