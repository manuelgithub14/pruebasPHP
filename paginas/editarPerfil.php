<?php
$titulo = 'Editar perfil';
$script = '/js/editarPerfil.js';
$cssPersonalizado = '';
$mensaje = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['fecha']) && !empty($_POST['correo']) && !empty($_POST['dni'])) {
        
        if ($user->getCorreo() === $_POST['correo'] && $user->getDni() === $_POST['dni']) {
            $user->setFechaNacimiento($_POST['fecha']);
            
            if ($user->guardar($db)) {
                $mensaje = 'Datos actualizados';
            } else {
                $mensaje = 'Error al actualizar los datos';
            }
        } else {
            $mensaje = 'No se puede cambiar el correo ni el DNI';
        }
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <h1>Editar perfil</h1>
        <div class="secundario">
            <form method="post" id="formEditarUsuario">
                <div class="field">
                    <label class="label">Correo</label>
                    <input type="text" class="input" id="correo" name="correo" value="<?= htmlentities($user->getCorreo()) ?>" readonly="true"/>
                    <p class="help" id="infoCorreo"></p>
                </div>
                <div class="field">
                    <label class="label">D.N.I.</label>
                    <input type="text" class="input" id="dni" name="dni" value="<?= htmlentities($user->getDni()) ?>" readonly="true"/>
                    <p class="help" id="infoDni"></p>
                </div>
                <div class="field">
                    <label class="label">Fecha nacimiento</label>
                    <input type="date" class="input" id="fecha" name="fecha" value="<?= htmlentities($user->getFechaNacimiento()) ?>"/>
                    <p class="help" id="infoFecha"></p>
                </div>
                <input type="submit" class="button is-danger" id="btnEditarUsuario" value="Actualizar"/>
            </form>
        </div>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>