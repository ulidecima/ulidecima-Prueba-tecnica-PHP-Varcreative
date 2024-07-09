<?php
class User {
    private $connection;
    private $tableName = "users";

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($dataBase) {
        $this -> connection = $dataBase;
    }

    public function create() {
        // Verifica que el mail ingresado no exista en la base de datos
        if (!$this -> isEmailUnique()) {
            return false;
        }

        $query = "INSERT INTO " . $this -> tableName .
        " SET name=:name, email=:email, password=:password";
        $stmt = $this -> connection -> prepare($query);

        // Se sanitizan los datos de entrada
        $this -> name = htmlspecialchars(strip_tags($this -> name));
        $this -> email = htmlspecialchars(strip_tags($this -> email));
        $this -> password = password_hash(htmlspecialchars(strip_tags($this -> password)), PASSWORD_BCRYPT);

        $stmt -> bindParam(':name', $this -> name);
        $stmt -> bindParam(':email', $this -> email);
        $stmt -> bindParam(':password', $this -> password);

        if ($stmt -> execute()) {
            return true;
        }

        return false;
    }

    public function readAll() {
        $query = "SELECT id, name, email FROM " . $this -> tableName;
        $stmt = $this -> connection -> prepare($query);

        $stmt -> execute();

        return $stmt;
    }

    public function readOne() {
        $query = "SELECT name, email FROM " . $this -> tableName . " WHERE id=:id";
        $stmt = $this -> connection -> prepare($query);

        $stmt -> bindParam(':id', $this -> id);
        $stmt -> execute();
        
        // se obtiene la primera fila que devuelve la consulta y se indica que la fila obtenida debe ser un array asociativo
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        $this -> name = $row['name'];
        $this -> email = $row['email'];
    }

    public function update() {
        // Verifica que el mail ingresado no exista en la base de datos
        if(!$this -> isEmailUnique()) {
            return false;
        }

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

    /**
     * authenticate($email, $password) se encarga de autenticar al usuario comprobando su email y contraseña
     * @param mixed $email
     * @param mixed $password
     * @return bool
     */
    public function authenticate($email, $password) {
        $query = "SELECT id, name, email, password FROM " . 
        $this -> tableName . " WHERE email=:email LIMIT 0,1";
        $stmt = $this -> connection -> prepare($query);

        $stmt -> bindParam(':email', $email);
        $stmt -> execute();

        $row = $stmt -> fetch(PDO::FETCH_ASSOC);

        // se usa password_verify para verificar la contraseña sin hash contra la contraseña con hash
        if ($row && password_verify($password, $row['password'])) {
            $this -> id = $row['id'];
            $this -> name = $row['name'];
            $this -> email = $row['email'];

            return true;
        }

        return false;
    }

    /**
     * isEmailUnique: verifica si el mail ingresado actualmente existe en la base de datos
     * @return bool
     */
    private function isEmailUnique() {
        $query = "SELECR id FROM " . $this -> tableName . " WHERE email=:email LIMIT 1";
        $stmt = $this -> connection -> prepare($query);
        $stmt -> bindParam(':email', $this -> email);
        $stmt -> execute();

        return $stmt -> rowCount() === 0;
    }

    public function getId() {
        return $this -> id;
    }

    public function getName() {
        return $this -> name;
    }

    public function getEmail() {
        return $this -> email;
    }
}
?>