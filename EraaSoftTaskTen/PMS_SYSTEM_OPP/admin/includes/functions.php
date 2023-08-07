<?php


function checkIfDataExistsInTable($table, $colu, $data){
    global $db;
    $q = "SELECT * FROM $table WHERE $colu = ?";
    $stmt = $db->connect()->prepare($q);
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
  $stmt = $db->connect()->prepare($q);
  return $stmt->execute([ $id ]);
}

