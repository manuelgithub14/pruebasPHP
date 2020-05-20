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
    ($result) ? $mensaje = 'Contrase&ntilde;a cambiada.' : $mensaje = 'Las contrase&ntilde;as no coinciden.';
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<h1>Cambiar contrase&ntilde;a</h1>
<div class="secundario">
    <form method="post" id="formCambioPassword">
        <span id="errores"></span>
        <div class="camposForm">
            <label>Contrase&ntilde;a antigua: <input type="password" name="passAntiguo" autofocus="true" id="passActual"/></label>
            <label>Contrase&ntilde;a nueva: <input type="password" name="passNuevo" id="passNuevo"/></label>
            <label>Repita contrase&ntilde;a nueva: <input type="password" name="passRepNuevo" id="passNuevoRep"/></label>
        </div>
        <input type="submit" id="btnCambiarPass" value="Cambiar"/>
    </form>
</div>

<?php if (!empty($result)): ?>
<p><?= htmlentities($mensaje) ?></p>
<?php endif; ?>