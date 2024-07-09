<?php
// Inicia sesion para manipular variables de sesion
session_start();

// Elimina las variables de sesion que estan restringidas
session_unset();

// Mata la sesion actual, eliminando al mismo tiempo los datos de sesion almacenados
session_destroy();

// Redirige al login
header("Location: login.php");

// Finaliza el script para que no se sigan ejecutando instrucciones
exit();
?>