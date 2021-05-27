<?php

//require_once "classes/Person.php";
//require_once "classes/Placement.php";
require_once "php/database/Database.php";

class PersonController
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getAllFirstPlacements(){
        $stmt = $this->conn->prepare(" 
        SELECT 
               person_id, 
               name, 
               surname, 
               year, 
               city, 
               country, 
               type, 
               discipline 
        FROM umiestnenia
        LEFT JOIN oh ON umiestnenia.oh_id = oh.id
        LEFT JOIN osoby ON umiestnenia.person_id = osoby.id
        WHERE placing = 1
        ORDER BY year ASC ;
       ");
        $stmt->execute();

        //$result = $stmt->fetchAll(PDO::FETCH_CLASS, "Game");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getNumOfGoldMedals(){
        $stmt = $this->conn->prepare(" 
        SELECT 
               name, 
               surname, 
               person_id,
               SUM(placing = 1) AS pocet
        FROM umiestnenia
        LEFT JOIN osoby ON umiestnenia.person_id = osoby.id
        WHERE placing = 1
        GROUP BY person_id
        ORDER BY pocet DESC
        LIMIT 10
       ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSportsmen(){
        $stmt = $this->conn->prepare(" 
        SELECT  
               id,
               name,
               surname
        FROM osoby
        ORDER BY surname ASC
       ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllGames(){
        $stmt = $this->conn->prepare(" 
        SELECT  * FROM oh
        ORDER BY year ASC
       ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPeople()
    {
        $stmt = $this->conn->prepare("select osoby.*, sum(u.placing = 1) as gold_count from osoby join umiestnenia u on osoby.id = u.person_id group by osoby.id;");
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_CLASS, "Person");

        foreach ($people as $person) {

            $stmt = $this->conn->prepare("select umiestnenia.*, oh.city from umiestnenia join oh on umiestnenia.oh_id = oh.id where person_id = :personId; ");
            $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $placements = $stmt->fetchAll(PDO::FETCH_CLASS, "Placement");
            $person->setPlacements($placements);
        }

        return $people;
    }

    public function getPerson(int $id)
    {
        var_dump($id);
        $stmt = $this->conn->prepare("select osoby.*, sum(u.placing = 1) as gold_count from osoby left OUTER join umiestnenia u on osoby.id = u.person_id where osoby.id = :personId;");
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Person");
        $person = $stmt->fetch();
//
//        $stmt = $this->conn->prepare("select umiestnenia.*, oh.city from umiestnenia join oh on umiestnenia.oh_id = oh.id where person_id = :personId; ");
//        $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
//        $stmt->execute();
//        $placements = $stmt->fetchAll(PDO::FETCH_CLASS, "Placement");
//        $person->setPlacements($placements);

        return $person;
    }

    public function insertPerson(Person $person)
    {
        $stmt = $this->conn->prepare("Insert into osoby (name, surname, birth_day, birth_place, birth_country) values (:name, :surname, '1.1.1992', 'Trnava', 'Slovensko')");
        $name = $person->getName();
        $surname = $person->getSurname();
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function updatePerson(Person $person)
    {
        $stmt = $this->conn->prepare("Update osoby set name=:name, surname=:surname where id = :personId");
        $name = $person->getName();
        $surname = $person->getSurname();
        $id = $person->getId();
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}