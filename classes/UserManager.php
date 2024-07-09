<?php
require_once 'User.php';

class UserManager {
    private $dataBase;
    private $user;

    public function __construct($dataBase) {
        $this -> dataBase = $dataBase;
        $this -> user = new User($dataBase);
    }

    public function createUser($name, $email, $password) {
        $this -> user -> setName($name);
        $this -> user -> setEmail($email);
        $this -> user -> setPassword($password);

        return $this -> user -> create();
    }

    public function listUsers() {
        return $this -> user -> readAll();
    }

    public function getUserById($id) {
        $this -> user -> setId($id);
        $this -> user -> readOne();

        return $this -> user;
    }
    
    public function updateUser($id, $name, $email) {
        $this -> user -> setId($id);
        $this -> user -> setName($name);
        $this -> user -> setEmail($email);

        if ($this -> user -> update()) {
            return true;
        }

        return false;
    }

    public function deleteUser($id) {
        $this -> user -> setId($id);

        return $this -> user -> delete();
    }

    public function authenticateUser($email, $password) {
        return $this -> user -> authenticate($email, $password);
    }

    public function getUser() {
        return $this -> user;
    }
}
?>