<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

$database = new Database();
$databaseConnection = $database -> getConnection();

$userManager = new UserManager($databaseConnection);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once '../templates/header.php';

if ($_POST) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($userManager -> authenticateUser($email, $password)) {
        $user = $userManager -> getUser();
        $_SESSION['user_id'] = $user -> getId();
        $_SESSION['user_name'] = $user -> getName();
        $_SESSION['user_email'] = $user -> getEmail();
        header("Location: index.php");
        exit();
    } else {
        echo "<script>showAlert('Correo electronico o contraseña incorrectos.');</script>";
    }
}
?>

<h2>Login</h2>
<div class="container left-align">
    <form action="login.php" method="post">
        <div class="input-field">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
        </div>
        <div class="input-field">
            <label for="password">Contraseña</label><br>
            <input type="password" id="password" name="password" required><br><br>
        </div>
        <div class="input-field">
            <input type="submit" class="btn waves-effect waves-light" value="Login">
        </div>
    </form>
</div>

<?php
include_once '../templates/footer.php';
?>