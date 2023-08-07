<?php
include 'includes/header.php';
include 'includes/navigation.php';

if(!$session->check('role_user')){
    $validation->redirect('login.php');
}

if(isset($_GET['product_id']) && is_numeric($_GET['product_id'])){
    $product_id = $_GET['product_id'];
}else{
    $validation->redirect('product.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['makeOrder'])){

            $product_id = $_POST['product_id'];

            $prd_size = $validation->handelInput($_POST['prd_size']);
            $prd_quantity = $validation->handelInput($_POST['prd_quantity']);
            

            // query to get data for products that order wright now
            $count = $product->getSingleData($product_id)['count'];
            if($count > 0){
                $fetchedDataProduct = $product->getSingleData($product_id)['row'];
                
                $price = $fetchedDataProduct['prd_price'];
                $price = intval(strstr($price, '$', true));

                $discount = $fetchedDataProduct['prd_discount'];
                $discount = intval(strstr($discount, '%', true));

                if($discount > 0){
                    $price_with_quantity = $price * $prd_quantity;
                    $total    =   $price_with_quantity - ( $price_with_quantity  * ($discount / 100) );
                }else{
                    $total = $price * $prd_quantity;
                }

                // query to insert data into orders tabel
                $order->insertData( $prd_size,$price , $prd_quantity, $discount, $total , $session->get('role_user_user_id'),$product_id);
                $success_make_order = 'Order made successfully';
            }else{
                $validation->redirect('product.php');
            }

        } // end
}
?>

    <?php if(isset($success_make_order)){ ?>
        <div class="container">
                <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $success_make_order; ?>
                </div>
            </div>
    <?php } ?>

    <?php
        $count = $product->getSingleData($product_id)['count'];
        if($count > 0 ){
            $row = $product->getSingleData($product_id)['row'];
        }else{
            $validation->redirect('product.php');
        }
    ?>
    <div class="create_products">
    <div class="container">
        <div class="row"> 

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Make Order</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?product_id=<?php echo $product_id; ?>"  method="POST" class="m-auto">

            <input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">

            <!-- Start prd_name -->
            <div class="form-group">
                <label>prd_name:</label>
                <input type="disabled" disabled placeholder="prd_name" class="form-control" name="prd_name" value="<?php echo $row['prd_name']; ?>">
            </div>

            <!-- Start prd_quantity -->
            <div class="form-group">
                <label>prd_quantity:</label>
                <select name="prd_quantity">
                    <?php 
                    for($i = 1; $i <= $row['prd_quantity']; $i++ ){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }?>
                </select>
                <!-- <input type="text" placeholder="prd_quantity" class="form-control" name="prd_quantity" 
                value="<?php echo $row['prd_quantity']; ?>"> -->
            </div>

            <?php if(!empty($row['prd_size'])){ ?>
            <!-- Start prd_size -->
            <div class="form-group">
                <label>prd_size:</label>
                <select name="prd_size">
                <?php 
                    $size_array = ['s', 'm', 'l', 'xl', 'xxl', 'xs'];
                    foreach($size_array as $size_data){ ?>
                    <option value="<?php echo $size_data; ?>"><?php echo $size_data; ?></option>
                    <?php } ?>
                    </select>
            </div>
            <?php }else{ ?>
                <input type="hidden" name="prd_size" value="<?php echo ''; ?>">
            <?php } ?>
        

            <input type="submit" class="form-control btn btn-primary d-block mb-5" value="continue" name="makeOrder">
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

<?php include 'includes/footer.php'; ?>