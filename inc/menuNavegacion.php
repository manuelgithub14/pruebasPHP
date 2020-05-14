<?php
if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}
?>

<nav class="navbar is-danger is-spaced">
    <ul class="navbar-start">
        <li class="navbar-item"><a href = "">Apartado 1</a></li>
        <li class="navbar-item"><a href = "articulos">Articulos</a></li>
        <?php if (!empty($user)): ?>
            <?php if ($user['tipo'] === 'admin'): ?>
                <li class="navbar-item"><a href = "nuevoArticulo">Crear Articulos</a></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
    <div class="navbar-end">
        <span>Bienvenido <?= htmlentities($user['correo']) ?></span>
        <a href="logout" class="button is-info">Salir</a>
    </div>
</nav>
