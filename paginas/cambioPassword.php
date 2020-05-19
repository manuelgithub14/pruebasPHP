<?php
$titulo = 'Cambiar password';
$script = '/js/cambioPassword.js';
$cssPersonalizado = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['passAntiguo']) && !empty($_POST['passNuevo']) && !empty($_POST['passRepNuevo'])) {
        $result = Usuario::cambiarContraseña($db, $_POST['passAntiguo'], $_POST['passNuevo'], $_POST['passRepNuevo']);
    }
}
if (!empty($result)) {
    ($result) ? $mensaje = 'Contraseña cambiada.' : $mensaje = 'Las contraseñas no coinciden.';
}
?>

<h1>Cambiar contraseña</h1>
<div class="secundario">
    <form method="post" id="formCambioPassword">
        <span id="errores"></span>
        <div class="camposForm">
            <label>Contraseña antigua: <input type="password" name="passAntiguo" autofocus="true" id="passActual"/></label>
            <label>Contraseña nueva: <input type="password" name="passNuevo" id="passNuevo"/></label>
            <label>Repita contraseña nueva: <input type="password" name="passRepNuevo" id="passNuevoRep"/></label>
        </div>
        <input type="button" id="btnCambiarPass" value="Cambiar"/>
    </form>
</div>

<?php if (!empty($result)): ?>
    <p><?= $mensaje ?></p>
<?php endif; ?>