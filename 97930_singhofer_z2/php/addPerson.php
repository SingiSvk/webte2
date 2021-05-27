<?php
require_once "database/Database.php";



try {
    $conn = (new Database())->getConnection();

    $stmt = $conn->prepare(" 
    INSERT INTO osoby (name, surname, birth_day, birth_place, birth_country, death_day, death_place, death_country) 
    VALUES (
    '" . $_POST['name'] . "',
    '" . $_POST['surname'] . "',
    '" . date('d. m. Y.', strtotime($_POST['birth_day'])) . "',
    '" . $_POST['birth_place'] . "',
    '" . $_POST['birth_country'] . "',
    '" . (isset($_POST['death_day']) ? date('d. m. Y.', strtotime($_POST['death_day'])) : null) . "',
    '" . (isset($_POST['death_place']) ? $_POST['death_place']:null)."',
    '" . (isset($_POST['death_country']) ? $_POST['death_country']:null)."')");
    $stmt->execute();

}catch (PDOException $exception){
    echo "Error: ".$exception->getMessage();
}

?>
