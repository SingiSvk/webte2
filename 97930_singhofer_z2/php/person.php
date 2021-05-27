<?php

    require_once "database/Database.php";
    try{
        $conn = (new Database())->getConnection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare(" 
            SELECT * FROM osoby
             WHERE id = {$_GET["id"]}
           ");
        $stmt->execute();

        //$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Game");
        $result_person = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $stmt = $conn->prepare(" 
            SELECT name, surname, year, city, country, type, placing, discipline FROM umiestnenia
            LEFT JOIN oh ON umiestnenia.oh_id = oh.id
            LEFT JOIN osoby ON umiestnenia.person_id = osoby.id
            WHERE person_id = {$_GET["id"]}
            ORDER BY placing ASC
           ");
        $stmt->execute();

        //$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Game");
        $result_games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $exception){
        echo "Error: ".$exception->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>cviko2</title>

    <link href="../css/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="person_info">
        <div id="personal_info">
            <table>
                <tr>
                    <th>Meno</th>
                    <th>Narodenie</th>
                    <th>Úmrtie</th>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo $result_person[0]["name"] ." ". $result_person[0]["surname"]
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $result_person[0]["birth_day"] ." ". $result_person[0]["birth_place"] ." ". $result_person[0]["birth_country"]
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $result_person[0]["death_day"] ." ". $result_person[0]["death_place"] ." ". $result_person[0]["death_country"]
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div id="games_participated">
            <table>
                <tr>
                    <th>Olympiáda</th>
                    <th>Umiestnenie</th>
                    <th>Disciplína</th>
                    <th>Miesto</th>
                </tr>
                <?php
                foreach($result_games as $row){
                    echo "<tr>
                        <td>{$row["name"]} {$row["surname"]}</td>
                        <td>{$row["year"]} {$row["type"]} {$row["country"]} {$row["city"]}</td>
                        <td>{$row["discipline"]}</td>
                        <td>{$row["placing"]}</td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>
<div>
    <a href="http://147.175.98.139/zadanie2/"><button>späť</button></a>
</div>


</body>
</html>

