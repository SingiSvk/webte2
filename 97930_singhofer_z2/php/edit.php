<?php

require_once "controllers/PersonController.php";

$personController = new PersonController();
if(isset($_POST['name'])) {
    if(isset($_POST['id'])) {
        $stmt = $personController->getConn()->prepare("UPDATE osoby SET name = '".$_POST["name"]."', surname = '".$_POST["surname"]."' WHERE id = '".$_POST["id"]."'");
        $stmt->execute();
    }
}
if(isset($_GET["id"])){
    $person = $personController->getPerson($_GET["id"]);
    $id=$_GET["id"];

}else{
    $id = $_POST["id"];
    $person = $personController->getPerson($_POST["id"]);
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit person</title>
</head>
<body>
    <form method="post" action="edit.php<?php echo isset($person) ? ('?id='.$id.'') : '' ?>")>

        <input type="hidden" name="id" value="<?php echo $id ?>">

        <label for="name">Name</label>
        <input type="text" name="name" id="name"  value="<?php echo $person[0]["name"]  ?>">

        <label for="surname">Surname</label>
        <input type="text" name="surname" id="surname"  value="<?php echo $person[0]["surname"]  ?>">

        <input type="submit">
    </form>
    <div>
        <a href="http://147.175.98.139/zadanie2/"><button>späť</button></a>
    </div>
</body>
</html>


