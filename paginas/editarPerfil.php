<?php
$titulo = 'Editar perfil';
$script = '';
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

<div class="secundario">
    <form method="post" id="formEditarUsuario">
        <span id="errores"></span>
        <div class="camposForm">
            <label>Correo: <input type="text" name="correo" value="<?= $user->getCorreo() ?>" disabled="true"/></label>
            <label>D.N.I.: <input type="text" name="dni" value="<?= $user->getDni() ?>" disabled="true"/></label>
            <label>Edad: <input type="text" name="edad" value="<?= $user->getEdad() ?>"/></label>
        </div>
        <input type="submit" id="btnEditarUsuario" value="Actualizar"/>
    </form>
</div>

<?php if (!empty($mensaje)): ?>
    <p><?= $mensaje ?></p>
<?php endif; ?>