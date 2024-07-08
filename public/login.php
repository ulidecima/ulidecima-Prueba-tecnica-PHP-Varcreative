<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

$database = new Database();
$databaseConnection = $database -> getConnection();

$userManager = new UserManager($databaseConnection);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "email recibido: " . $email . "<br>";
    echo "contraseña recibida: " . $password . "<br>";

    if ($userManager -> authenticateUser($email, $password)) {
        $user = $userManager -> getUser();
        $_SESSION['user_id'] = $user -> getId();
        $_SESSION['user_name'] = $user -> getName();
        $_SESSION['user_email'] = $user -> getEmail();
        header("Location: index.php");
    } else {
        echo "<div>Correo electronico o contraseña incorrectos.</div>";
    }
}

include_once '../templates/header.php';
?>

<h2>Login</h2>
<form action="login.php" method="post">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Contraseña</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>

<?php
include_once '../templates/footer.php';
?>