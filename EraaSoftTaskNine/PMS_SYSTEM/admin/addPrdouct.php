<?php
session_start();

include 'database/connect.php';
include 'includes/header.php';
include 'includes/navigation.php';
if(!isset($_SESSION['role_admin'])){
    header('Location: login.php');
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

    if(isset($_SESSION['add_product_database_error'])){ ?>
        <div class="container">
                <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $_SESSION['add_product_database_error']; ?>
                </div>
            </div>
    <?php } unset($_SESSION['add_product_database_error']); ?>

    <?php if(isset($_SESSION['success_add'])){ ?>
        <div class="container">
                <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $_SESSION['success_add']; ?>
                </div>
            </div>
    <?php } unset($_SESSION['success_add']); ?>

    
    <div class="create_products">
    <div class="container">
        <div class="row"> 

        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Add Prdoucts</h2>
            <form action="handelers/handelAddProducts.php" method="POST" class="m-auto" enctype="multipart/form-data">

            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">

            <!-- Start prd_name -->
            <div class="form-group">
                <label>prd_name:</label>
                <input type="text" placeholder="prd_name" class="form-control" name="prd_name" ">
            </div>

            <!-- Start prd_quantity -->
            <div class="form-group">
                <label>prd_quantity:</label>
                <input type="text" placeholder="prd_quantity" class="form-control" name="prd_quantity" ">
            </div>

            <!-- Start prd_brand_name -->
            <div class="form-group">
                <label>prd_brand_name:</label>
                <input type="text" placeholder="prd_brand_name" class="form-control" name="prd_brand_name" ">
            </div>


            <!-- Start prd_price -->
            <div class="form-group">
                <label>prd_price:</label>
                <p style="color: red;">Make discount number with $ like (10$) not only number and must only dollar sign</p>
                <input type="text" placeholder="prd_price" class="form-control" name="prd_price" ">
            </div>


            <!-- Start prd_discount -->
            <div class="form-group">
                <label>prd_discount:</label>
                <p style="color: red;">Make discount number with % like (10%) not only number</p>
                <input type="text" placeholder="prd_discount" class="form-control" name="prd_discount" ">
            </div>


            <!-- Start prd_size -->
            <div class="form-group">

                <label>prd_size:</label>
                <p style="color: red;">size ('s', 'm', 'l', 'xl', 'xxl', 'xs') or leave it empty if products doesnot have size</p>
                <input type="text" placeholder="prd_size" class="form-control" name="prd_size" ">
            </div>


            <!-- Start Username -->
            <div class="form-group">
                <label>Category Name:</label>
                <select name="category_id">

                <?php 
                    $query = "SELECT * FROM categories ORDER BY id DESC";
                    $stmt  = $db->prepare($query);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    
                    if($count > 0){
                        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row as $data_cat){ ?>

                    <option value="<?php echo $data_cat['id']; ?>"><?php echo $data_cat['cat_name']?></option>
                <?php }   }else{
                    echo 'there is no category please create at least one category';
                } ?>
                    
                </select>
            </div>

            <!-- Start Profile Image -->
            <label>Choose Profile Image: with jpg or png or jpeg only</label>
            <input type="file" name="prd_image">



            <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="addProduct">
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

<?php include 'includes/footer.php'; ?>