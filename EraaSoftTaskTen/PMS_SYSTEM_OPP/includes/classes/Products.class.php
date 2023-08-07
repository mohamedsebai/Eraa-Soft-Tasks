<?php 

class Products extends DBConnect{
    

    public function getSingleData($product_id){
        global $db;
        $q = "SELECT * FROM products WHERE id = ?";
        $stmt = $db->connect()->prepare($q);
        $stmt->execute([$product_id]);
        $count = $stmt->rowCount();
        $fetchedDataProduct = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        $data = [
            'count' => $count,
            'row'   => $fetchedDataProduct,
        ];

        return $data;
    }

    public function selectDataWithJoin($col,$id){
        global $db;
        $query = "SELECT products.*,
        users.username,
        categories.cat_name
        FROM products
        INNER JOIN users
        ON products.user_id = users.id
        INNER JOIN categories
        ON categories.id = products.category_id
        WHERE products.$col = ?
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


    public function selectDataWithJoinWithNoCondtion(){
        global $db;
        $query = "SELECT products.*,
        users.username,
        categories.cat_name
        FROM products
        INNER JOIN users
        ON products.user_id = users.id
        INNER JOIN categories
        ON categories.id = products.category_id
        ORDER BY id DESC";
        $stmt  = $db->connect()->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = [
            'count' => $count,
            'row'   => $row
        ];

        return $data;
    }


    
}