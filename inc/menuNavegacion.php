<?php
if (isset($_SESSION['id_usuario'])) {
    $usuarioNav = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}
?>

<nav class="navbar is-danger is-spaced" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/"><img src="/recursos/logo.png" class="logo"/></a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="barraNavegacion">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div id="barraNavegacion" class="navbar-menu">
        <ul class="navbar-start">
            <li class="navbar-item"><a href="/articulos/1">Art&iacute;culos</a></li>
            <li class="navbar-item"><a href="/productos/1">Productos</a></li>
            <?php if (!empty($usuarioNav) && $usuarioNav->getActivado()): ?>
                <?php if ($usuarioNav->getTipo() === 'admin'): ?>
                    <li class="navbar-item"><a href = "/nuevoArticulo">Crear Art&iacute;culos</a></li>
                    <li class="navbar-item"><a href = "/nuevoProducto">Crear Productos</a></li>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <li><a class="navbar-link">Estad&iacute;sticas</a></li>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="/visitasPagina">Visitas por p&aacute;gina</a>
                            <a class="navbar-item" href="/usoNavegadores">Uso navegadores</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <div class="navbar-end">
            <?php if (!empty($usuarioNav) && $usuarioNav->getActivado()): ?>
                <a class="navbar-item">Bienvenido</a> 
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link"><?= htmlentities($usuarioNav->getCorreo()) ?></a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="/cambioPassword">Cambiar contrase&ntilde;a</a>
                        <a class="navbar-item" href="/editarPerfil">Editar perfil</a>
                    </div>
                </div>
                <a href="/logout" class="button is-info">Salir</a>
            <?php else : ?>
                <a href="/login">Loguearse</a><label>&nbsp; o &nbsp;</label>
                <a href="/signup"> Registrarse</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
