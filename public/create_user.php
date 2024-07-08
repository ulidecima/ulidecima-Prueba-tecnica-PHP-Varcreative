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
<form action="create_user.php" method="post">
    <label for="name">Nombre:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Crear">
</form>

<?php
include_once '../templates/footer.php';
?>