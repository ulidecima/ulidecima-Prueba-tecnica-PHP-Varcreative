<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

include_once '../templates/header.php';

$database = new Database();
$databaseConnection = $database -> getConnection();

$userManager = new UserManager($databaseConnection);

if ($_POST) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if($userManager -> createUser($name, $email, $password)) {
        echo "<script>showAlert('Usuario registrado correctamente');</script>";
    } else {
        echo "<script>showAlert('Error al registrar el usuario');</script>";
    }
}
?>

<h2>Registro</h2>
<div class="container left-align">
    <form action="register.php" method="post">
        <div class="input-field">
            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name" required><br>
        </div>
        <div class="input-field">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
        </div>
        <div class="input-field">
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required><br><br>
        </div>
        <div class="input-field">
        <input type="submit" class="btn waves-effect waves-light" value="Registrarse">
        </div>
    </form>
</div>

<?php
include_once '../templates/footer.php';
?>
