<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);
$stmt = $userManager -> listUsers();
$numRows = $stmt -> rowCount();

include_once '../templates/header.php';
?>

<h2>Lista de Usuarios</h2>
<?php

if ($numRows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombre</th>";
    echo "<th>Email</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

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
    echo "<div>No se encontraron usuarios.</div>";
}

include_once '../templates/footer.php';
?>