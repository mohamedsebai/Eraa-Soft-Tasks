<?php
session_start();

include 'database/connect.php';
include 'includes/header.php';
include 'includes/navigation.php';
if(!isset($_SESSION['role_admin'])){
    header('Location: login.php');
    exit();
}

if(isset($_GET['order_id']) && is_numeric($_GET['order_id'])){
    $order_id = $_GET['order_id'];
}else{
    header('Location: orders.php');
    exit();
}
?>

<div class="admin-dashboard">
<div class="container">
    <div class="row">
        
    <div class="col-md-9">
        <h2 class="text-center">Order Details</h2>
    <?php
        $query = "SELECT orders.*,
        users.username,
        products.prd_name,
        products.prd_image,
        products.prd_brand_name,
        products.prd_size,
        categories.cat_name
        FROM orders
        INNER JOIN users
        ON orders.users_id = users.id
        INNER JOIN products
        ON orders.product_id = products.id
        INNER JOIN categories
        ON categories.id = products.category_id
        WHERE orders.id = $order_id
        ORDER BY id DESC";
        $stmt  = $db->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">cat name</th>
                <th scope="col">Username</th>
                <th scope="col">ProductName</th>
                <th scope="col">Product_img</th>
                <th scope="col">prd_brand_name</th>
                <th scope="col">prd_size</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Discount</th>
                <th scope="col">Total</th>
                <th scope="col">created_at</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php 
                if($count > 0): 
                    foreach($row as $data):
                ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['cat_name']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['prd_name']; ?></td>
                    <td><img src="<?php echo 'uploaded_imgs/' . $data['prd_image']; ?>" width="100" height="80"></td>
                    <td><?php echo $data['prd_brand_name']; ?></td>
                    <td>
                        <?php echo !empty($data['prd_size']) ? $data['prd_size']: 'there is no size for this type'; ?>
                    </td>
                    <td><?php echo $data['price']; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td><?php echo $data['discount']; ?></td>
                    <td><?php echo $data['total']; ?></td>
                    <td><?php echo $data['created_at']; ?></td>
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