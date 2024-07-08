<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userManager -> createUser($name, $email, $password)) {
        echo "<div>Usuario creado exitosamente</div>";
    } else {
        echo "<div>Error al crear el usuario</div>";
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once '../templates/header.php';
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