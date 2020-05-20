<?php
$titulo = 'Editar perfil';
$script = '/js/editarPerfil.js';
$cssPersonalizado = '';
$mensaje = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['edad'])){
        $user->setEdad($_POST['edad']);
        if($user->guardar($db)){
            $mensaje = 'Datos actualizados';
        }else{
            $mensaje = 'Error al actualizar los datos';
        }
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<div class="secundario">
    <form method="post" id="formEditarUsuario">
        <span id="errores"></span>
        <div class="camposForm">
            <label>Correo: <input type="text" id="correo" name="correo" value="<?= htmlentities($user->getCorreo()) ?>" disabled="true"/></label>
            <label>D.N.I.: <input type="text" id="dni" name="dni" value="<?= htmlentities($user->getDni()) ?>" disabled="true"/></label>
            <label>Edad: <input type="text" id="edad" name="edad" value="<?= htmlentities($user->getEdad()) ?>"/></label>
        </div>
        <input type="submit" id="btnEditarUsuario" value="Actualizar"/>
    </form>
</div>

<?php if (!empty($mensaje)): ?>
<p><?= htmlentities($mensaje) ?></p>
<?php endif; ?>