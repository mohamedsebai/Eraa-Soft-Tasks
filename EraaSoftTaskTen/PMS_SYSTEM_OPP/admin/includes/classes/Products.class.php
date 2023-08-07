<?php 


class Products extends DBConnect{
    

    public function getDataWithJoinUsersAndCategories(){
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
        $userData = [
        'row' => $row,
        'count' => $count
        ];
        return $userData;
    }
    
    public function getProductById($product_id){
        global $db;
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt  = $db->connect()->prepare($query);
        $stmt->execute([$product_id]);
        $count = $stmt->rowCount();
        $fetchedData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if($count > 0){
            $data = $fetchedData[0];
        }else{
            $data = $fetchedData;
        }
        $userData = [
        'row' => $data,
        'count' => $count
        ];
        return $userData;
    }
    
    public function insertProductData($prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id, $user_id){
        global $db;
        $q = "INSERT INTO products(prd_name, prd_quantity, prd_price, prd_brand_name ,prd_discount,prd_size, prd_image,category_id,user_id) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $prd_name, $prd_quantity,$prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id, $user_id ]);
    }

    public function updateProductData($prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id, $id){
        global $db;
        $q = "UPDATE products SET prd_name = ?, prd_quantity = ?, prd_price = ?, prd_brand_name = ?,
        prd_discount = ?, prd_size = ?, prd_image = ?, category_id  = ? WHERE id = ?";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id ,$id]);
    }

    public  function deleteData( $id ){
        global $db;
        $q = "DELETE FROM products WHERE id = ?";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $id ]);
    }

    
}