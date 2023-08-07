<?php

include 'includes/header.php';
include 'includes/navigation.php';
if(!$session->check('role_admin')){
    $validation->redirect('login.php');
}
?>

<div class="container">
    <?php 
if(isset($_GET['product_id']) && is_numeric($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    if($product->deleteData(  $product_id )){ ?>
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

    <a class="btn btn-primary" href="addPrdouct.php">Add New Products</a>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">prd_quantity</th>
                <th scope="col">prd_name</th>
                <th scope="col">prd_brand_name</th>
                <th scope="col">prd_price</th>
                <th scope="col">prd_discount</th>
                <th scope="col">prd_size</th>
                <th scope="col">prd_img</th>
                <th scope="col">created by user</th>
                <th scope="col">category_name</th>
                <th scope="col">created_at</th>
                <th scope="col">option</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $count = $product->getDataWithJoinUsersAndCategories()['count'];
                if($count > 0):
                    $row = $product->getDataWithJoinUsersAndCategories()['row'];
                    foreach($row as $data):
                ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['prd_quantity']; ?></td>
                    <td><?php echo $data['prd_name']; ?></td>
                    <td><?php echo $data['prd_brand_name']; ?></td>
                    <td><?php echo $data['prd_price']; ?></td>
                    <td><?php echo $data['prd_discount']; ?></td>
                    <td><?php echo !empty($data['prd_size']) ?  $data['prd_size'] : 'there is no size for this type of products' ?></td>

                    <td><img src="<?php echo 'uploaded_imgs/' . $data['prd_image'] ?>" width="100" height="100" ></td>

                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['cat_name']; ?></td>
                    <td><?php echo $data['created_at']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="update_product.php?product_id=<?php echo $data['id']; ?>">Edit</a>
                        <a class="btn btn-primary" href="products.php?product_id=<?php echo $data['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach;  else: ?>
                    <div class="alert alert-danger">There is no Products</div>
                <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>
    </div>
</div>
</div>
<?php include 'includes/footer.php'; ?>