<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once '../templates/header.php';

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);
$stmt = $userManager -> listUsers();
$numRows = $stmt -> rowCount();
?>

<h2>Lista de Usuarios</h2>
<div class="container left-align">
<?php

if ($numRows > 0) {
    echo '<table class="highlight">';
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombre</th>";
    echo "<th>Email</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";

    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$email}</td>";
        echo "<td>";
        echo "<a href='update_user.php?id={$id}'>Editar</a>";
        echo " | ";
        echo "<a href='delete_user.php?id={$id}'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "
            <div class='container center'>
                <p>No se encontraron usuarios.</p>
            </div>
        ";
}
echo "</div>";
include_once '../templates/footer.php';
?>