<?php 
include 'includes/header.php'; 
if(!$session->check('role_user')){
    $validation->redirect('login.php');
}
if( (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) ){
    $order_id = $_GET['order_id'];
}else{
    $validation->redirect('index.php');
}
?>

    <div class="wrap">

    <?php include 'includes/navigation.php'; ?>
        <!-- END header -->

        <section class="site-section py-lg">
        <div class="container">
            <div class="row blog-entries element-animate">
            <div class="col-md-12 col-lg-8 main-content">
                <h2>Order Details</h2>
            <div class="row">
                    <?php
                    $count = $order->selectDataWithJoin('id',$order_id)['count'];
                        if($count > 0): 
                            $row   = $order->selectDataWithJoin('id',$order_id)['row'];
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
                        <li class="list-group-item">Saller: <?php echo $data['username']; ?></li>
                        <li class="list-group-item">
                            Quantity: <?php echo $data['quantity']; ?>
                        </li>
                        <?php echo !empty($data['size']) ?  '<li class="list-group-item">Size: ' .$data['size'] . '</li>': '' ?>
                        <li class="list-group-item">Price: <?php echo $data['price']; ?></li>
                        <li class="list-group-item">Discount: <?php echo $data['discount']; ?></li>
                        <li class="list-group-item">Total: <?php echo $data['total']; ?></li>
                        
                        </ul>
                    

                    

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
