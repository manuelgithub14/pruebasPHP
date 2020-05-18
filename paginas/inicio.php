<?php
$titulo = 'Mi Inicio';
$script = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}
?>

<?php if (!empty($user)): ?>
    <?php include '../inc/menuNavegacion.php'; ?>
<p>Este es tu id: <?= $user->getId() ?></p>
    <a href="cambioPassword">Cambiar contraseña</a>
<?php else: ?>
    <h1>BIENVENIDO</h1>
    <a href="login">Logueate</a> o 
    <a href="signup">Registrate</a>
    <img id="imgBienvenida" src="/recursos/welcome.jpg">
    <a href="recuperarPassword">Recuperar contraseña</a>
<?php endif; ?>