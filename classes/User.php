<?php
class User {
    private $connection;
    private $tableName = "users";

    public $id;
    public $name;
    public $email;

    public function __construct($dataBase) {
        $this -> connection = $dataBase;
    }

    public function create() {
        $query = "INSERT INTO " . $this -> tableName .
        " SET name=:name, email=:email";
        $stmt = $this -> connection -> prepare($query);

        $this -> name = htmlspecialchars(strip_tags($this -> name));
        $this -> email = htmlspecialchars(strip_tags($this -> email));

        $stmt -> bindParam(":name", $this -> name);
        $stmt -> bindParam(":email", $this -> email);

        if ($stmt -> execute()) {
            return true;
        }

        return false;
    }

    public function readAll() {
        $query = "SELECT id, name, email FROM " . $this -> tableName/* . " WHERE id = ? LIMIT 0,1"*/;
        $stmt = $this -> connection -> prepare($query);

        $stmt -> execute();

        return $stmt;
    }

    public function readOne() {
        $query = "SELECT name, email FROM " . $this -> tableName . " WHERE id=:id";
        $stmt = $this -> connection -> prepare($query);

        $stmt -> bindParam(':id', $this -> id);
        $stmt -> execute();

        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $this -> name = $row['name'];
        $this -> email = $row['email'];
    }

    public function update() {
        $query = "UPDATE " . $this -> tableName . " SET name=:name, email=:email WHERE id=:id";
        $stmt = $this -> connection -> prepare($query);

        $this -> name = htmlspecialchars(strip_tags($this -> name));
        $this -> email = htmlspecialchars(strip_tags($this -> email));
        $this -> id = htmlspecialchars(strip_tags($this -> id));

        $stmt -> bindParam(':name', $this -> name);
        $stmt -> bindParam(':email', $this -> email);
        $stmt -> bindParam(':id', $this -> id);

        if ($stmt -> execute()) {
            return true;
        }
        
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this -> tableName . " WHERE id=:id";
        $stmt = $this -> connection -> prepare($query);

        $this -> id = htmlspecialchars(strip_tags($this -> id));

        $stmt -> bindParam(':id', $this -> id);

        if ($stmt -> execute()) {
            return true;
        }

        return false;
    }
}
?>