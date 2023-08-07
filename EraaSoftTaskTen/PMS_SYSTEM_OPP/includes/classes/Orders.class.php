<?php 

class Orders extends DBConnect{



    public function insertData($prd_size, $price, $prd_quantity, $discount, $total, $user_id, $product_id){
        global $db;
        $q = "INSERT INTO orders (size,price,quantity,discount,total, users_id, product_id) VALUES (?,?,?,?,?,?,?)";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute( [$prd_size,$price . '$', $prd_quantity, $discount .'%', $total . '$', $user_id ,$product_id]);
    }

    public function selectDataWithJoin($col,$id){
        global $db;
        $query = "SELECT orders.*,
        users.username,
        products.prd_image,
        products.prd_name,
        products.prd_brand_name
        FROM orders
        INNER JOIN products
        ON products.id = orders.product_id
        INNER JOIN users
        ON orders.users_id = users.id
        WHERE orders.$col = ?
        ORDER BY id DESC";
        $stmt  = $db->connect()->prepare($query);
        $stmt->execute([$id]);
        $count = $stmt->rowCount();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            'count' => $count,
            'row'   => $row
        ];

        return $data;
    }
}