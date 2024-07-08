<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once '../templates/header.php';
?>
<h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
<p>Esta es la pagina de inicio del sistema ABM de usuarios</p>

<?php
include_once '../templates/footer.php';
?>