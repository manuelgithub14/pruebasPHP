<?php
$titulo = 'Mi Inicio';
$script = '';
$cssPersonalizado = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<?php if (!empty($user)): ?>
    <p>Este es tu id: <?= $user->getId() ?></p>
    <a href="cambioPassword">Cambiar contrase&ntilde;a</a>
<?php else: ?>
    <h1>BIENVENIDO</h1>
    <img id="imgBienvenida" src="/recursos/welcome.jpg">
    <a href="recuperarPassword">Recuperar contrase&ntilde;a</a>
<?php endif; ?>