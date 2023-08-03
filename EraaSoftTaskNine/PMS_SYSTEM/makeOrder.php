<?php
session_start();

include 'includes/header.php';
include 'includes/navigation.php';
if(!isset($_SESSION['role_user'])){
    header('Location: login.php');
    exit();
}
if(isset($_GET['product_id']) && is_numeric($_GET['product_id'])){
    $product_id = $_GET['product_id'];
}else{
    header('Location: products.php');
    exit();
}
?>
<?php
    if(isset($_SESSION['errors'])){
        foreach ( $_SESSION['errors'] as $error ) {
            ?>
            <div class="container">
                <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $error; ?>
                </div>
            </div>
            <?php
        }
        unset($_SESSION['errors']);
    }
    ?>
    <?php if(isset($_SESSION['success_make_order'])){ ?>
        <div class="container">
                <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $_SESSION['success_make_order']; ?>
                </div>
            </div>
    <?php } unset($_SESSION['success_make_order']); ?>

    <?php
        $query = "SELECT * FROM products WHERE id = $product_id";
        $stmt  = $db->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0 ){
            $row   = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        }else{
            header('Location: products.php');
            exit();
        }
    ?>
    <div class="create_products">
    <div class="container">
        <div class="row"> 

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Make Order</h2>
            <form action="handelers/handelMakeOrder.php"  method="POST" class="m-auto">

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