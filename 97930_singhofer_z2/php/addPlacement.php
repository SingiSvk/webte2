<?php
require_once "database/Database.php";

try {
    $conn = (new Database())->getConnection();

    $stmt = $conn->prepare(" 
    INSERT INTO umiestnenia (person_id, oh_id, placing, discipline)
    VALUES (
    '".$_POST['person']."',
    '".$_POST['oh']."',
    '".$_POST['placement']."',
    '".$_POST['discipline']."')
   ");
    $stmt->execute();

}catch (PDOException $exception){
    echo "Error: ".$exception->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="refresh" content="0; url=http://147.175.98.139/zadanie2/" />
</head>
</html>
