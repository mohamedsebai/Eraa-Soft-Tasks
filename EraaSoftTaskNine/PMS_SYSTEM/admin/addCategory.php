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

    if(isset($_SESSION['add_category_database_error'])){ ?>
        <div class="container">
                <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $_SESSION['add_category_database_error']; ?>
                </div>
            </div>
    <?php } unset($_SESSION['add_category_database_error']); ?>

    <?php if(isset($_SESSION['success_add'])){ ?>
        <div class="container">
                <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
                <?php echo $_SESSION['success_add']; ?>
                </div>
            </div>
    <?php } unset($_SESSION['success_add']); ?>

    
    <div class="create_admin">
    <div class="container">
        <div class="row"> 
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Add Category</h2>
            <form action="handelers/handelAddCategory.php" method="POST" class="m-auto">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
            <!-- Start Username -->
            <div class="form-group">
                <label>Category Name:</label>
                <input type="text" placeholder="Category Name" class="form-control" name="cat_name" ">
            </div>
            <!-- Start Email -->
            <div class="form-group">
                <label>Description:</label>
                <input type="text" placeholder="Description" class="form-control" name="cat_description">
            </div>
            <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="addCategory">
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

<?php include 'includes/footer.php'; ?>