<?php

 session_start();

require('../includes/functions.php');
// include '../admin/database/connect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        if(isset($_POST['makeOrder'])){

            $product_id = $_POST['product_id'];

            $prd_size = handelInput($_POST['prd_size']);
            $prd_quantity = handelInput($_POST['prd_quantity']);
            

            // query to get data for products that order wright now
            $q = "SELECT * FROM products WHERE id = ?";
            $stmt = $db->prepare($q);
            $stmt->execute([$product_id]);
            $count = $stmt->rowCount();
            if($count > 0){
                $fetchedDataProduct = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
                
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
                $q = "INSERT INTO orders (size,price,quantity,discount,total, users_id, product_id) VALUES (?,?,?,?,?,?,?)";
                $stmt = $db->prepare($q);
                $stmt->execute( [$prd_size,$price . '$', $prd_quantity, $discount .'%', $total . '$', $_SESSION['role_user_user_id'],$product_id]);
                $_SESSION['success_make_order'] = 'Order made successfully';
                header("Location: ../makeOrder.php?product_id=$product_id");
            }else{
                header("Location: ../products.php");
                exit();
            }
            

        } // end 
}else{
        header('Location: ../index.php');
} // end check request method ?>