<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

include_once '../templates/header.php';

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);

if ($_POST) {
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
<form action="update_user.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user -> id ?? ''; ?>">
    <label for="name">Nombre:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $user -> name ?? ''; ?>" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo $user -> email ?? ''; ?>" required><br><br>
    <input type="submit" value="Actualizar">
</form>

<?php
include_once '../templates/footer.php';
?>