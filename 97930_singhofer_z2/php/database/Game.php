<?php


class Game
{
    private $name;
    private $surname;
    private $year;
    private $city;
    private $country;
    private $type;
    private $discipline;

    public function getRow(){
        return "<tr>
                    <td>$this->name</td>
                    <td>$this->surname</td>
                    <td>$this->year</td>
                    <td>$this->city</td>
                    <td>$this->country</td>
                    <td>$this->type</td>
                    <td>$this->discipline</td>
                </tr>";
    }
/*
    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->na ." ". $this->type." ".$this->year . "<br>";
    }
*/

}