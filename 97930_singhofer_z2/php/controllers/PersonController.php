<?php

require_once __DIR__."/../database/Database.php";

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

    public function getPerson(int $id)
    {
        $stmt = $this->conn->prepare(" 
        SELECT  
               *
        FROM osoby
        JOIN umiestnenia ON osoby.id = umiestnenia.person_id
        WHERE osoby.id = ".$id."
       ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return PDO
     */
    public function getConn(): PDO
    {
        return $this->conn;
    }



}