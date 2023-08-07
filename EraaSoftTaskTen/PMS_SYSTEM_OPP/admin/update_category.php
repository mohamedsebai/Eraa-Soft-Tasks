<?php


include 'includes/header.php';
include 'includes/navigation.php';

if(!$session->check('role_admin')){
    $validation->redirect('login.php');
}

if(isset($_GET['category_id']) && is_numeric($_GET['category_id'])){
    $cat_id = $_GET['category_id'];
}else{
    $validation->redirect('categories.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['UpdateCategory'])){

            $cat_name = $validation->handelInput($_POST['cat_name']);
            $description = $validation->handelInput($_POST['cat_description']);
            $cat_id = $_POST['cat_id'];

            $form_errors = array();

            if(strlen($cat_name) < 3){
                $form_errors['cat_name_error'] = 'Category name Must be larger than 2 characters';
            }

            if($description == ''){
                $form_errors['cat_description_error'] = 'description Cann\'t be empty';
            }
            if(strlen($description) > 60){
                $form_errors['cat_description_error'] = 'description Must be small than 60 characters';
            }


            if(empty($form_errors)){
                if($category->updateCategoryData($cat_name, $description, $cat_id )){
                    $success = 'data update successfully!';
                }else{
                    $error = 'try agian later!';
                }
                ?>
            <?php } // empty form_errors ?>
    <?php
    }// end 
}
?>
<?php 
    if(isset($error)){ ?>
        <div class="container">
            <div class='alert alert-danger' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
            <?php echo $error; ?>
            </div>
            </div>
    <?php } ?>

    <?php if(isset($success)){ ?>
        <div class="container">
            <div class='alert alert-success' style="padding: 2px 10px; max-width: 500px; margin: auto; margin-top: 5px; ">
            <?php echo $success; ?>
            </div>
        </div>
    <?php } ?>

    <?php
        $count = $category->getCategoryById($cat_id)['count'];
        if($count > 0 ){
            $row = $category->getCategoryById($cat_id)['row'];
        }else{
            $validation->redirect('categories.php');
        }
    ?>
    <div class="create_admin">
    <div class="container">
        <div class="row"> 
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h2>Update Category</h2>
            <form  method="POST" class="m-auto">
            <input type="hidden" name="cat_id" value="<?php echo $row['id']; ?>">
            <!-- Start Username -->
            <div class="form-group">
                <label>Category Name:</label>
                <input type="text" placeholder="Category Name" class="form-control" name="cat_name" value="<?php echo $row['cat_name']; ?>">
                <?php if(isset($form_errors['cat_name_error']) && !empty($form_errors['cat_name_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['cat_name_error']; ?></div>
                <?php } ?>

            </div>
            <!-- Start Email -->
            <div class="form-group">
                <label>Description:</label>
                <input type="text" placeholder="Description" class="form-control" name="cat_description" value="<?php echo $row['cat_description']; ?>">
                <?php if(isset($form_errors['cat_description_error']) && !empty($form_errors['cat_description_error'])){ ?>
                    <div class="alert alert-danger py-0 px-1"><?php echo $form_errors['cat_description_error']; ?></div>
                <?php } ?>
            </div>
            <input type="submit" class="form-control btn btn-primary d-block" value="continue" name="UpdateCategory">
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>
    </div>

<?php include 'includes/footer.php'; ?>