<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

$database = new Database();
$databaseConnection = $database -> getConnection();

$userManager = new UserManager($databaseConnection);

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($userManager -> createUser($name, $email, $password)) {
        echo "<div>Usuario registrado correctamente. <a href='login.php'>Iniciar sesion</a></div>";
    } else {
        echo "<div>Error al registrar el usuario.</div>";
    }
}

include_once '../templates/header.php';
?>

<h2>Registro</h2>
<form action="register.php" method="post">
    <label for="name">Nombre:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Registrarse">
</form>

<?php
include_once '../templates/footer.php';
?>
