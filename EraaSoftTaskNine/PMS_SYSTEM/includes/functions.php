<?php

include '../admin/database/connect.php';

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


function deleteData( $table, $id ){
  global $db;
  $q = "DELETE FROM $table WHERE id = ?";
  $stmt = $db->prepare($q);
  return $stmt->execute([ $id ]);

}

