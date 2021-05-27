<?php
require_once "Database.php";


try {
    $conn = (new Database())->getConnection();

    $stmt = $conn->prepare(" 
    INSERT INTO osoby (name, surname, birth_day, birth_place, birth_country) 
    VALUES (
    '".$_POST['name']."',
    '".$_POST['surname']."',
    '".date('d. m. Y.', strtotime($_POST['birth_day']))."',
    '".$_POST['birth_place']."',
    '".$_POST['birth_country']."')
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
