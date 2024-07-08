<!DOCTYPE html>
<html>
    <head>
        <title>ABM Usuarios</title>
    </head>
    <body>
        <header>
            <h1>ABM Usuarios</h1>
            <nav>
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="index.php">Inicio</a>';
                    echo ' | ';
                    echo '<a href="create_user.php">Crear Usuario</a>';
                    echo ' | ';
                    echo '<a href="list_users.php">Listar Usuarios</a>';
                    echo ' | ';
                    echo '<a href="logout.php">Logout (' . $_SESSION['user_name'] .')</a>';
                } else {
                    echo '<a href="login.php">Login</a>';
                    echo ' | ';
                    echo '<a href="register.php">Registrarse</a>';
                }
                ?>
            </nav>
        </header>
