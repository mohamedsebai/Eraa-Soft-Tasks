<?php 


class Cart extends DBConnect{

    public function insertData($product_id , $user_id ){
        global $db;
        $q = "INSERT INTO carts(product_id,user_id) VALUES(?,?)";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $product_id , $user_id ]);
    }


    public function selectDataWithCondtion($user_id, $product_id){
        global $db;
        $q = "SELECT * FROM carts where user_id = ? And product_id = ?";
        $stmt = $db->connect()->prepare($q);
        $stmt->execute([ $user_id, $product_id ]);
        $count = $stmt->rowCount();
        $fetchedData   = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($count > 0){
            $data = $fetchedData[0];
        }else{
            $data = $fetchedData;
        }
        $userData = [
        'data' => $data,
        'count' => $count
        ];
        return $userData;
    }

    public function selectDataWithJoin($col, $id){
        global $db;
        $query = "SELECT carts.*,
        products.id as prod_id,
        users.username,
        products.prd_image,
        products.prd_name,
        products.prd_brand_name
        FROM carts 
        INNER JOIN products
        ON carts.product_id = products.id
        INNER JOIN users
        ON carts.user_id = users.id
        WHERE carts.$col = ?";

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


    public function deleteData($product_id , $user_id){
        global $db;
        $q = "DELETE FROM carts WHERE product_id = ? AND user_id = ?";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $product_id , $user_id ]);
    }
    
}