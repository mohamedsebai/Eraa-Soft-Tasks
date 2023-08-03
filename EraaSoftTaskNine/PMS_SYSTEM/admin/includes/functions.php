<?php

// include 'database/connect.php';

function handelInput($input){
  return trim(htmlspecialchars($input));
}


function getSingleUserData($email, $role){
    global $db;
    $q = "SELECT * FROM users WHERE email = ? AND role = ?";
    $stmt = $db->prepare($q);
    $stmt->execute([$email, $role]);
    $fetchedData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
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

function insertData($username, $email, $password, $profile_img, $role){
  global $db;
  $q = "INSERT INTO users(username, email, password, profile_img, role) VALUES(?,?,?,?,?)";
  $stmt = $db->prepare($q);
  return $stmt->execute([ $username, $email, $password, $profile_img ,$role]);
}


function checkIfDataExistsInTable($table, $colu, $data){
    global $db;
    $q = "SELECT * FROM $table WHERE $colu = ?";
    $stmt = $db->prepare($q);
    $stmt->execute([$data]);
    $fetchedData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
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

function insertCategoryData($cat_name, $description, $user_id){
  global $db;
  $q = "INSERT INTO categories(cat_name, cat_description, user_id) VALUES(?,?,?)";
  $stmt = $db->prepare($q);
  return $stmt->execute([ $cat_name, $description, $user_id  ]);
}


function updateCategoryData($cat_name, $description, $id){
  global $db;
  $q = "UPDATE categories SET cat_name = ?, cat_description = ? WHERE id = ?";
  $stmt = $db->prepare($q);
  return $stmt->execute([ $cat_name, $description, $id ]);
}


function deleteData( $table, $id ){
  global $db;
  $q = "DELETE FROM $table WHERE id = ?";
  $stmt = $db->prepare($q);
  return $stmt->execute([ $id ]);

}





function insertProductData($prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id, $user_id){
  global $db;
  $q = "INSERT INTO products(prd_name, prd_quantity, prd_price, prd_brand_name ,prd_discount,prd_size, prd_image,category_id,user_id) VALUES(?,?,?,?,?,?,?,?,?)";
  $stmt = $db->prepare($q);
  return $stmt->execute([ $prd_name, $prd_quantity,$prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id, $user_id ]);
}

function updateProductData($prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id, $id){
  global $db;
  $q = "UPDATE products SET prd_name = ?, prd_quantity = ?, prd_price = ?, prd_brand_name = ?,
  prd_discount = ?, prd_size = ?, prd_image = ?, category_id  = ? WHERE id = ?";
  $stmt = $db->prepare($q);
  return $stmt->execute([ $prd_name, $prd_quantity, $prd_price, $prd_brand_name, $prd_discount, $prd_size, $prd_image, $category_id ,$id]);
}