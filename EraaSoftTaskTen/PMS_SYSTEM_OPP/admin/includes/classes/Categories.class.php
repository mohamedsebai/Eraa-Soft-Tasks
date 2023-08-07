<?php 

class Categories extends DBConnect{
    

    
    public function getDataJoinWithUsers(){
        global $db;
        $query = "SELECT categories.*,
        users.username
        FROM categories
        INNER JOIN users
        ON categories.user_id = users.id
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
    public function getCategoryById($cat_id){
        global $db;
        $query = "SELECT * FROM categories WHERE id = ?";
        $stmt  = $db->connect()->prepare($query);
        $stmt->execute([$cat_id]);
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

    public function getDataCategoryWithNoCondtion(){
        global $db;
        $query = "SELECT * FROM categories";
        $stmt  = $db->connect()->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        $fetchedData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $userData = [
        'row' => $fetchedData,
        'count' => $count
        ];
        return $userData;
    }

    public function insertCategoryData($cat_name, $description, $user_id){
        global $db;
        $q = "INSERT INTO categories(cat_name, cat_description, user_id) VALUES(?,?,?)";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $cat_name, $description, $user_id  ]);
    }


    public function updateCategoryData($cat_name, $description, $id){
        global $db;
        $q = "UPDATE categories SET cat_name = ?, cat_description = ? WHERE id = ?";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $cat_name, $description, $id ]);
    }

    public  function deleteData( $id ){
        global $db;
        $q = "DELETE FROM categories WHERE id = ?";
        $stmt = $db->connect()->prepare($q);
        return $stmt->execute([ $id ]);
    }

}