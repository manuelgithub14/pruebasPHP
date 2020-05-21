<?php
$titulo = 'Editar perfil';
$script = '/js/editarPerfil.js';
$cssPersonalizado = '';
$mensaje = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!empty($_POST['edad']) /*&& $user->getCorreo() === $_POST['correo']*/ && $user->getDni() === $_POST['dni']) {
        $user->setEdad($_POST['edad']);
        if ($user->guardar($db)) {
            $mensaje = 'Datos actualizados';
        } else {
            $mensaje = 'Error al actualizar los datos';
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
                    <input type="text" class="input" id="correo" name="correo" value="<?= htmlentities($user->getCorreo()) ?>" disabled="true"/>
                    <p class="help" id="infoCorreo"></p>
                </div>
                <div class="field">
                    <label class="label">D.N.I.</label>
                    <input type="text" class="input" id="dni" name="dni" value="<?= htmlentities($user->getDni()) ?>" disabled="true"/>
                    <p class="help" id="infoDni"></p>
                </div>
                <div class="field">
                    <label class="label">Edad</label>
                    <input type="text" class="input" id="edad" name="edad" value="<?= htmlentities($user->getEdad()) ?>"/>
                    <p class="help" id="infoEdad"></p>
                </div>
                <input type="submit" class="button is-danger" id="btnEditarUsuario" value="Actualizar"/>
            </form>
        </div>

        <?php if (!empty($mensaje)): ?>
            <p><?= htmlentities($mensaje) ?></p>
        <?php endif; ?>
    </section>
</main>