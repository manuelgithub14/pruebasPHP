<?php
$titulo = 'Recuperar contrase&ntilde;a';
$script = '/js/recuperarPassword.js';
$cssPersonalizado = '';
$mensaje = '';
$permisoRecuperar = '';
$parametroEmail = '';
$parametroToken = '';

if (!empty($path[1]) && !empty($path[2])) {
    $parametroEmail = $path[1];
    $parametroToken = $path[2];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['correo'])) {

        if (!empty($parametroEmail) && !empty($parametroToken)) {
            $user = Usuario::obtenerUsuarioPorCorreo($db, $parametroEmail);

            if ($user->getToken() === $parametroToken) {
                if (!empty($_POST['passNuevo']) && !empty($_POST['passRepNuevo'])) {
                    $result = Usuario::restablecerContraseña($db, $parametroEmail, $_POST['passNuevo'], $_POST['passRepNuevo']);

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

        if ($user) {
            (SERVIDOR == '127.0.0.1') ? $rutaServidor = 'http://localhost' : $rutaServidor = 'https://pruebasphp123.herokuapp.com';

            $datos = [
                'mensajero' => 'cuentapruebas757@gmail.com',
                'nombreMensajero' => 'Manuel J',
                'destinatario' => $user->getCorreo(),
                'asunto' => 'Recuperar contraseña',
                'mensaje' => '<a href="' . $rutaServidor . '/recuperarPassword/' . $user->getCorreo() . '/' . $user->getToken() . '">Pincha aquí para recuperar tu contraseña</a>',
                'archivoAdjunto' => 'recursos/imagen.png',
            ];
            $correo = new Correo($datos);
            if ($correo->enviar()) {
                $mensaje = 'Mensaje enviado!';
            } else {
                $mensaje = 'Error al enviar el mensaje';
            }
        } else {
            $mensaje = 'Este correo no existe';
        }
    }
}

if (!empty($parametroEmail) && !empty($parametroToken)) {
    $user = Usuario::obtenerUsuarioPorCorreo($db, $parametroEmail);
    if ($user->getToken() === $parametroToken) {
        $permisoRecuperar = true;
    } else {
        $permisoRecuperar = false;
        $mensaje = 'Error, enlace incorrecto';
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <section>
        <h1>Recuperar contrase&ntilde;a</h1>
        <?php if ($permisoRecuperar): ?>
            <div class="secundario">
                <form method="post" id="formRecuperarPass">
                    <h1>Cambiar contrase&ntilde;a</h1>
                    <div class="camposForm">
                        <div class="field">
                            <label class="label">Contrase&ntilde;a nueva</label>
                            <input type="password" class="input" name="passNuevo" id="passNuevo"/>
                            <p class="help" id="infoPasswordNuevo"></p>
                        </div>
                        <div class="field">
                            <label class="label">Repita contrase&ntilde;a nueva</label>
                            <input type="password" class="input" name="passRepNuevo" id="passNuevoRep"/>
                            <p class="help" id="infoPasswordNuevoRep"></p>
                        </div>
                    </div>
                    <input type="submit" class="button is-danger" id="btnRecuperarPass" value="Cambiar contraseña"/>
                </form>
            </div>
        <?php else: ?>
            <div class="secundario">
                <form method="post" id="formCorreo">
                    <div class="camposForm">
                        <div class="field">
                            <label class="label">Correo</label>
                            <input type="text" class="input" name="correo" id="correo"/>
                            <p class="help" id="infoCorreo"></p>
                        </div>
                    </div>
                    <input type="submit" class="button is-danger" id="btnRecuperarCorreo" value="Enviar"/>
                </form>
            </div>
        <?php endif; ?>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>