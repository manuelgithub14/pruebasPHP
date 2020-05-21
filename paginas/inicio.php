<?php
$titulo = 'Mi Inicio';
$script = '';
$cssPersonalizado = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php if (!empty($user)): ?>
        <?php include '../inc/menuAside.php'; ?>
        <section>
            <p>Este es tu id: <?= $user->getId() ?></p>
        </section>
    <?php else: ?>
        <section>
            <h1>BIENVENIDO</h1>
            <img id="imgBienvenida" src="/recursos/welcome.jpg">
        </section>
    <?php endif; ?>
</main>
