<?php
require_once '../config/database.php';

$database = new Database();
$databaseConnection = $database -> getConnection();

if ($databaseConnection) {
    echo "Conexion exitosa con la base de datos";
} else {
    echo "Error al conectarse a la base de datos.";
}
?>