<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);

$id = $_GET['id'];

if ($userManager -> deleteUser($id)) {
    echo "<div>Usuario eliminado correctamente</div>";
} else {
    echo "<div>Error al eliminar el usuario</div>";
}

echo '<a href="list_users.php">Volver a la lista de usuarios</a>';
?>