<?php

require_once "Database.php";
try{
    $conn = (new Database())->getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare(" 
            DELETE FROM osoby
            WHERE id = {$_GET["id"]}
           ");
    $stmt->execute();
    $stmt = $conn->prepare(" 
            DELETE FROM umiestnenia
            WHERE person_id = {$_GET["id"]}
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
    <meta http-equiv="refresh" content="0; url=http://147.175.98.139/cviko2/" />
</head>
</html>
