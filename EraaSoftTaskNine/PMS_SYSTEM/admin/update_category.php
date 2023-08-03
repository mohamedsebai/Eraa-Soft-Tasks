<?php
session_start();

include 'database/connect.php';
include 'includes/header.php';
include 'includes/navigation.php';
if(!isset($_SESSION['role_admin'])){
    header('Location: login.php');
    exit();
}
if(isset($_GET['category_id']) && is_numeric($_GET['category_id'])){
    $cat_id = $_GET['category_id'];
}else{
    header('Location: categories.php');
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

    if(isset($_SESSION['update_category_database_error'])){ ?>
        <div class="container">
                <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $_SESSION['update_category_database_error']; ?>
                </div>
            </div>
    <?php } unset($_SESSION['update_category_database_error']); ?>

    <?php if(isset($_SESSION['success_update'])){ ?>
        <div class="container">
                <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $_SESSION['success_update']; ?>
                </div>
            </div>
    <?php } unset($_SESSION['success_update']); ?>

    


    <?php
        $query = "SELECT * FROM categories WHERE id = $cat_id";
        $stmt  = $db->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0 ){
            $row   = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        }else{
            header('Location: categories.php');
            exit();
        }
    ?>
    <div class="create_admin">
    <div class="container">
        <div class="row"> 
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Update Category</h2>
            <form action="handelers/handelUpdateCategory.php" method="POST" class="m-auto">
            <input type="hidden" name="cat_id" value="<?php echo $row['id']; ?>">
            <!-- Start Username -->
            <div class="form-group">
                <label>Category Name:</label>
                <input type="text" placeholder="Category Name" class="form-control" name="cat_name" value="<?php echo $row['cat_name']; ?>">
            </div>
            <!-- Start Email -->
            <div class="form-group">
                <label>Description:</label>
                <input type="text" placeholder="Description" class="form-control" name="cat_description" value="<?php echo $row['cat_description']; ?>">
            </div>
            <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="UpdateCategory">
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

<?php include 'includes/footer.php'; ?>