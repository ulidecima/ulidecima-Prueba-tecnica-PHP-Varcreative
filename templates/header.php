<!DOCTYPE html>
<html>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
        <title>ABM Usuarios</title>
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-wrapper">
                    <?php
                    echo '
                        <a href="#!" class="brand-logo left">ABM Usuarios</a>
                    ';
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION['user_id'])) {
                        echo '
                            <ul id="nav-mobile" class="right">
                                <li><a href="index.php">Inicio</a></li>
                                <li><a href="create_user.php">Crear Usuario</a></li>
                                <li><a href="list_users.php">Listar Usuarios</a></li>
                                <li><a href="logout.php">Logout (' . $_SESSION['user_name'] .')</a></li>
                            </ul>
                        ';
                    } else {
                        echo '
                            <ul id="nav-mobile" class="right">
                                <li><a href="login.php">Login</a></li>
                                <li><a href="register.php">Registrarse</a></li>
                            </ul>
                        ';
                    }
                    ?>
                </div>
            </nav>
        </header>
        <div class="container center">
