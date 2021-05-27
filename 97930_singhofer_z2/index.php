<?php

require_once "php/database/Database.php";
require_once "php/controllers/PersonController.php";
//require_once "database/Game.php";

$personController = new PersonController();

$firstPlacements = $personController->getAllFirstPlacements();
$numOfGoldMedals = $personController->getNumOfGoldMedals();
$allSportsmen = $personController->getAllSportsmen();
$allGames = $personController->getAllGames();

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>cviko2</title>

    <link href="css/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div>
        <h2>
            Olympijský víťazi
        </h2>
        <div class="container">
            <table id="winners_table">
                <tr>
                    <th><a onclick="sortTable(0)">Meno</a></th>
                    <th><a onclick="sortTable(1)">Olympiáda</a></th>
                    <th><a onclick="sortTable(2)">Typ</a></th>
                    <th><a onclick="sortTable(3)">Rok</a></th>
                    <th><a onclick="sortTable(4)">Disciplína</a></th>
                </tr>
                <?php
                foreach($firstPlacements as $row){
                    echo "<tr>
                        <td><a href='php/person.php?id=".$row["person_id"]."'>{$row["name"]} {$row["surname"]}</a></td>
                        <td>{$row["country"]} {$row["city"]}</td>
                        <td>{$row["type"]}</td>
                        <td>{$row["year"]}</td>
                        <td>{$row["discipline"]}</td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>





    <div>
        <div class="buttons">
            <button id="add_person">Pridaj športovca</button>
            <div>
                <form id="add_person_form" action="php/addPerson.php" method="POST">
                    Name:       <input type="text" name="name" required><br>
                    Surname:    <input type="text" name="surname" required><br>
                    Birth:  <input type="date" name="birth_day" required><input type="text" name="birth_place" placeholder="city" required><input type="text" name="birth_country" placeholder="country" required><br>
                    Death:  <input type="date" name="death_day"><input type="text" name="death_place" placeholder="city"><input type="text" name="death_country" placeholder="country"><br>
                    <input type="submit">
                </form>
            </div>

            <button id="add_placement">Pridaj umiestnenie športovca</button>
            <form id="add_placement_form" action="php/addPlacement.php" method="POST">
                Športovec: <select name="person">
                    <?php
                    foreach($allSportsmen as $row){
                        echo "<option value='{$row["id"]}'>{$row["name"]} {$row["surname"]}</option>";
                    }
                    ?>
                </select><br>
                OH: <select name="oh">
                    <?php
                    foreach($allGames as $row){
                        echo "<option value='{$row["id"]}'>{$row["type"]} {$row["year"]} {$row["country"]}-{$row["city"]}</option>";
                    }
                    ?>
                </select><br>
                <input type="number" name="placement" min="1" placeholder="umiestnenie" required>
                <input type="text" name="discipline" placeholder="disciplina">
                <input type="submit">

                </form>
        </div>
    </div>

    <div>
        <h2>
            Počet zlatých medajlí
        </h2>
        <div class="container">
            <table>
                <tr>
                    <th>Meno</th>
                    <th>Pocet</th>
                    <th>Edit</th>
                </tr>
                <?php
                foreach($numOfGoldMedals as $row){
                    echo "<tr>
                    <td><a href='php/person.php?id=".$row["person_id"]."'>{$row["name"]} {$row["surname"]}</a></td>
                    <td>{$row["pocet"]}</td>
                    <td>
                        <a href='php/edit.php?id=".$row["person_id"]."'><button>Edit</button></a>
                        <a href='php/delete.php?id=".$row["person_id"]."'><button>Delete</button></a>
                    </td>
                </tr>";
                }
                ?>
            </table>
        </div>
    </div>


<script src="js/script.js"></script>

</body>
</html>

