<?php
$id = $_GET["id"];
/*
require_once "database/Database.php";
try{
    $conn = (new Database())->getConnection();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare(" 
            SELECT * FROM osoby
             WHERE name LIKE '$name' AND surname LIKE '$surname'
           ");
    $stmt->execute();

    //$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Game");
    $result_person = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $stmt = $conn->prepare(" 
            SELECT name, surname, year, city, country, type, discipline FROM umiestnenia
            LEFT JOIN oh ON umiestnenia.oh_id = oh.id
            LEFT JOIN osoby ON umiestnenia.person_id = osoby.id
             WHERE name LIKE '$name' AND surname LIKE '$surname'
           ");
    $stmt->execute();

    //$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Game");
    $result_games = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $exception){
    echo "Error: ".$exception->getMessage();
}
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="refresh" content="0; url=http://147.175.98.139/cviko2/" />
</head>
</html>


