<?php
$titulo = 'Recuperar contrase&ntilde;a';
$script = '/js/recuperarPassword.js';
$cssPersonalizado = '';
$mensaje = '';
$permisoRecuperar = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['correo'])) {
        if (!empty($_GET['email']) && !empty($_GET['token'])) {
            $user = Usuario::obtenerUsuarioPorCorreo($db, $_GET['email']);
            
            if ($user->getToken() === $_GET['token']) {
                if (!empty($_POST['passNuevo']) && !empty($_POST['passRepNuevo'])) {
                    $result = Usuario::restablecerContraseña($db, $_GET['email'], $_POST['passNuevo'], $_POST['passRepNuevo']);

                    if (!empty($result)) {
                        ($result) ? $mensaje = 'Contrase&ntilde;a cambiada.' : $mensaje = 'Las contrase&ntilde;as no coinciden.';
                    }
                }
            } else {
                $mensaje = 'Error, enlace incorrecto';
            }
        }
    } else {
        $user = Usuario::obtenerUsuarioPorCorreo($db, $_POST['correo']);

        $datos = [
            'mensajero' => 'manueljesusmb@gmail.com',
            'nombreMensajero' => 'Manuel J',
            'destinatario' => $user->getCorreo(),
            'asunto' => 'Recuperar contraseña',
            'mensaje' => '<a href="http://localhost/recuperarPassword?email=' . $user->getCorreo() . '&token=' . $user->getToken() . '">Pincha aquí para recuperar tu contraseña</a>',
            'archivoAdjunto' => 'recursos/imagen.png',
        ];
        $correo = new Correo($datos);
        if ($correo->enviar()) {
            $mensaje = 'Mensaje enviado!';
        } else {
            $mensaje = 'Error al enviar el mensaje';
        }
    }
}

if (!empty($_GET['email']) && !empty($_GET['token'])) {
    $user = Usuario::obtenerUsuarioPorCorreo($db, $_GET['email']);
    if ($user->getToken() === $_GET['token']) {
        $permisoRecuperar = true;
    } else {
        $permisoRecuperar = false;
        $mensaje = 'Error, enlace incorrecto';
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<h1>Recuperar contrase&ntilde;a</h1>
<?php if ($permisoRecuperar): ?>
    <div class="secundario">
        <form method="post" id="formRecuperarPass">
            <h1>Cambiar contrase&ntilde;a</h1>
            <span id="errores"></span>
            <div class="camposForm">
                <label>Contrase&ntilde;a nueva: <input type="password" name="passNuevo" id="passNuevo"/></label>
                <label>Repita contrase&ntilde;a nueva: <input type="password" name="passRepNuevo" id="passNuevoRep"/></label>
            </div>
            <input type="submit" id="btnRecuperarPass" value="Cambiar contraseña"/>
        </form>
    </div>
<?php else: ?>
    <div class="secundario">
        <h2>Introduce tu correo</h2>
        <form method="post" id="formCorreo">
            <span id="errores"></span>
            <div class="camposForm">
                <label>Correo: <input type="text" name="correo" id="correo"/></label>
            </div>
            <input type="submit" id="btnRecuperarCorreo" value="Enviar"/>
        </form>
    </div>
<?php endif; ?>

<?php if (!empty($mensaje)): ?>
<p><?= htmlentities($mensaje) ?></p>
<?php endif; ?>