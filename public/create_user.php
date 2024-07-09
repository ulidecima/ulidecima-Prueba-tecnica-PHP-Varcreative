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

if ($_POST) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($userManager -> createUser($name, $email, $password)) {
        echo "
            <script>
                showAlert('Usuario creado correctamente');
                window.location.href = 'list_users.php';
            </script>
        ";
        exit();
    } else {
        echo "<script>showAlert('Error al crear el usuario');</script>";
    }
}
?>

<h2>Crear Usuario</h2>
<div class="container left-align">
    <form action="create_user.php" method="post">
        <div class="input-field"> 
            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name" class="validate" required><br>
        </div>
        <div class="input-field">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" class="validate" required><br><br>
        </div>
        <div class="input-field">
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" class="validate" required><br><br>
        </div>
        <div class="input-field">
            <input type="submit" class="btn waves-effect waves-light" value="Crear">
        </div>
    </form>
</div>
<?php
include_once '../templates/footer.php';
?>