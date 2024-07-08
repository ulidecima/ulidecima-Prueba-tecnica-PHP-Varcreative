<?php
require_once 'User.php';

class UserManager {
    private $dataBase;
    private $user;

    public function __construct($dataBase) {
        $this -> dataBase = $dataBase;
        $this -> user = new User($dataBase);
    }

    public function createUser($name, $email) {
        $this -> user -> name = $name;
        $this -> user -> email = $email;

        return $this -> user -> create();
    }

    public function listUsers() {
        return $this -> user -> readAll();
    }

    public function getUser($id) {
        $this -> user -> id = $id;
        $this -> user -> readOne();

        return $this -> user;
    }
    

    public function updateUser($id, $name, $email) {
        $this -> user -> id = $id;
        $this -> user -> name = $name;
        $this -> user -> email = $email;

        return $this -> user -> update();
    }

    public function deleteUser($id) {
        $this -> user -> id = $id;

        return $this -> user -> delete();
    }
}
?>