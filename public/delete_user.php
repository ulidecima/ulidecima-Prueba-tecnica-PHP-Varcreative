<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

include_once '../templates/header.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false) {
    echo "<script>showAlert('El ID del usuario no es valido.');</script>"; 
    echo "<script>window.location.href = 'list_users.php';</script>";
    exit();
}

if ($userManager -> deleteUser($id)) {
    echo "
        <script>
        showAlert('Usuario eliminado correctamente');
        window.location.href = 'list_users.php';
        </script>
    ";
    exit();
} else {
    echo "<script>showAlert('Error al eliminar el usuario');</script>";
}

?>