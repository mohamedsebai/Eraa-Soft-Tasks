<?php

include 'includes/header.php';
include 'includes/navigation.php';
if(!$session->check('role_admin')){
    $validation->redirect('login.php');
}
?>

<div class="admin-dashboard">
<div class="container">
    <div class="row">
        
    <div class="col-md-9">
        <h2 class="text-center">All Orders</h2>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">ProductName</th>
                <th scope="col">Product_img</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Discount</th>
                <th scope="col">Total</th>
                <th scope="col">created_at</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $count = $order->getDataWithJoin()['count'];
                if($count > 0):
                    $row = $order->getDataWithJoin()['row'];
                    foreach($row as $data):
                ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['prd_name']; ?></td>
                    <td><img src="<?php echo 'uploaded_imgs/' . $data['prd_image']; ?>" width="100" height="80"></td>
                    <td><?php echo $data['price']; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td><?php echo $data['discount']; ?></td>
                    <td><?php echo $data['total']; ?></td>
                    <td><?php echo $data['created_at']; ?></td>
                    <td><a class="btn btn-primary" href="order_details.php?order_id=<?php echo $data['id']; ?>">Show Full Details</a></td>
                </tr>
                <?php endforeach;  else: ?>
                    <div class="alert alert-danger">There is no orders</div>
                <?php endif; ?>
        </tbody>
    </table>
    </div>
    </div>
    </div>
</div>
</div>

<?php include 'includes/footer.php'; ?>