<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Si no hay un usuario logeado, redirige al login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once '../templates/header.php';

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);

if ($_POST) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($userManager -> updateUser($id, $name, $email)) {
        echo "
            <script>
                showAlert('Usuario actualizado correctamente');
                window.location.href = 'list_users.php';
            </script>
        ";
        exit();
    } else {
        echo "<script>showAlert('Error al actualizar el usuario');</script>";
    }
} else {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $user = $userManager -> getUserById($id);
}
?>

<h2>Actualizar Usuario</h2>
<div class="container left-align">
    <form action="update_user.php" method="post">
        <input type="hidden" name="id" value="<?php echo $user -> id ?? ''; ?>">
        <div class="input-field">
            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $user -> name ?? ''; ?>" required><br>
        </div>
        <div class="input-field">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $user -> email ?? ''; ?>" required><br><br>
        </div>
        <div class="input-field">
            <input type="submit" class="btn waves-effect waves-light" value="Actualizar">
        </div>
    </form>
</div>
<?php
include_once '../templates/footer.php';
?>