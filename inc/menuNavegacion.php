<?php
if (isset($_SESSION['id_usuario'])) {
    $usuarioNav = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}
?>

<nav class="navbar is-danger is-spaced">
    <ul class="navbar-start">
        <a class="navbar-item" href="/"><img src="recursos/logo.png" class="logo"/></a>
        <li class="navbar-item"><a href = "articulos?pagina=1">Art&iacute;culos</a></li>
        <?php if (!empty($usuarioNav) && $usuarioNav->getActivado()): ?>
            <?php if ($usuarioNav->getTipo() === 'admin'): ?>
                <li class="navbar-item"><a href = "nuevoArticulo">Crear Art&iacute;culos</a></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
    <div class="navbar-end">
        <?php if (!empty($usuarioNav) && $usuarioNav->getActivado()): ?>
            Bienvenido 
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link"><?= htmlentities($usuarioNav->getCorreo()) ?></a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="cambioPassword">Cambiar contrase&ntilde;a</a>
                    <a class="navbar-item" href="editarPerfil">Editar perfil</a>
                </div>
            </div>
            <a href="logout" class="button is-info">Salir</a>
        <?php else : ?>
            <a href="login">Loguearse</a><label>&nbsp; o &nbsp;</label>
            <a href="signup"> Registrarse</a>
        <?php endif; ?>
    </div>
</nav>
