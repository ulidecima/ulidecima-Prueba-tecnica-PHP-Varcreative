<?php
include_once '../config/database.php';
include_once '../classes/UserManager.php';

$dataBase = new Database();
$dataBaseConnection = $dataBase -> getConnection();

$userManager = new UserManager($dataBaseConnection);

if ($_POST) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if ($userManager -> updateUser($id, $name, $email)) {
        echo "<div>Usuario actualizado correctamente</div>";
    } else {
        echo "<div>Error al actualizar el usuario</div>";
    }
} else {
    $user = new stdClass();
    $id = $_GET['id'];
    $user = $userManager -> getUser($id);
}

include_once '../templates/header.php';
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