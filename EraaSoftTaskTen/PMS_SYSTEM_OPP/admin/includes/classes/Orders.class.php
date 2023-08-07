<?php 

class Orders extends DBConnect{


    public function getDataWithJoinCondition($order_id){
        global $db;
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
        $stmt  = $db->connect()->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $userData = [
        'row' => $row,
        'count' => $count
        ];
        return $userData;
    }



    public function getDataWithJoin(){
        global $db;
        $query = "SELECT orders.*,
        users.username,
        products.prd_name,
        products.prd_image
        FROM orders
        INNER JOIN users
        ON orders.users_id = users.id
        INNER JOIN products
        ON orders.product_id = products.id
        ORDER BY id DESC";
        $stmt  = $db->connect()->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $userData = [
        'row' => $row,
        'count' => $count
        ];
        return $userData;
    }
}