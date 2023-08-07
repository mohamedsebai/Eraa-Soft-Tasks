<?php

include 'includes/header.php';
include 'includes/navigation.php';
if(!$session->check('role_admin')){
    $validation->redirect('login.php');
}
?>

<div class="container">
    <?php 
if(isset($_GET['category_id']) && is_numeric($_GET['category_id'])){
    $cat_id = $_GET['category_id'];
    if($category->deleteData($cat_id)){ ?>
    <div class="alert alert-success">Data Deleted Successfully</div>
    <?php }else{ ?>
        <div class="alert alert-danger">There is an error</div>
    <?php }
}
?>
</div>

<div class="admin-dashboard">
<div class="container">
    <div class="row">
    <div class="col-md-9">
        <h2 class="text-center">All Categories</h2>
    <a class="btn btn-primary" href="addCategory.php">Add New Category</a>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Who Created this category</th>
                <th scope="col">Name Of Category</th>
                <th scope="col">Description</th>
                <th scope="col">created_at</th>
                <th scope="col">option</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                $count = $category->getDataJoinWithUsers()['count'];
                if($count > 0):
                    $row = $category->getDataJoinWithUsers()['row'];
                    foreach($row as $data):
                ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['cat_name']; ?></td>
                    <td><?php echo $data['cat_description']; ?></td>
                    <td><?php echo $data['created_at']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="update_category.php?category_id=<?php echo $data['id']; ?>">Edit</a>
                        <a class="btn btn-primary" href="categories.php?category_id=<?php echo $data['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach;  else: ?>
                    <div class="alert alert-danger">There is no categories</div>
                <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>
    </div>
</div>
</div>
<?php include 'includes/footer.php'; ?>