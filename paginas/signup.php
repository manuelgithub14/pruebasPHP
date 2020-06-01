<?php
$titulo = 'Registrarse';
$script = '/js/signup.js';
$cssPersonalizado = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['correo']) && !empty($_POST['password']) && !empty($_POST['dni']) && !empty($_POST['fecha'])) {
        $nuevoCorreo = $_POST['correo'];
        $nuevoPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nuevoDni = $_POST['dni'];
        $nuevaFecha = $_POST['fecha'];

        $user = Usuario::obtenerUsuarioPorCorreo($db, $nuevoCorreo);

        if (is_bool($user)) {
            $datos = [
                'correo' => $nuevoCorreo,
                'password' => $nuevoPassword,
                'dni' => $nuevoDni,
                'fechaNacimiento' => $nuevaFecha,
                'tipo' => null,
                'token' => bin2hex(random_bytes(10))
            ];
            $nuevoUser = new Usuario($datos);
            $nuevoUser->guardar($db);
            
            (SERVIDOR == '127.0.0.1') ? $rutaServidor = 'http://' : $rutaServidor = 'https://';

            $datosCorreo = [
                'mensajero' => 'cuentapruebas757@gmail.com',
                'nombreMensajero' => 'Manuel J',
                'destinatario' => $nuevoUser->getCorreo(),
                'asunto' => 'Confirmar registro',
                'mensaje' => '<a href="' . $rutaServidor . SERVIDOR . '/login?id=' . 
                    $nuevoUser->getId() . '&token=' . $nuevoUser->getToken() . '">Pincha aquí para activar tu cuenta</a>',
                'archivoAdjunto' => 'recursos/imagen.png',
            ];
            $correo = new Correo($datosCorreo);
            if ($correo->enviar()) {
                $mensaje = 'Mensaje enviado!';
            } else {
                $mensaje = 'Error al enviar el mensaje';
            }

            header('Location: /login?faltaActivar=1');
            exit();
        } else {
            $mensaje = 'Ya est&aacute;s registrado';
        }
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<h1>Registrarse</h1>

<div class="secundario">
    <form method="post" id="formSignup">
        <div class="field">
            <label class="label">Correo</label>
            <input type="text" class="input" name="correo"/>
            <p class="help" id="infoCorreo"></p>
        </div>
        <div class="field">
            <label class="label">Contrase&ntilde;a</label>
            <input type="password" class="input" name="password"/>
            <p class="help" id="infoPassword"></p>
        </div>
        <div class="field">
            <label class="label">D.N.I.</label>
            <input type="text" class="input" name="dni"/>
            <p class="help" id="infoDni"></p>
        </div>
        <div class="field">
            <label class="label">Fecha nacimiento</label>
            <input type="date" class="input" name="fecha"/>
            <p class="help" id="infoFecha"></p>
        </div>
        <input type="submit" class="button is-danger" id="btnGuardar" value="Guardar"/>
    </form>
</div>

<?php if (!empty($mensaje)): ?>
    <p class="mensaje"><?= $mensaje ?></p>
<?php endif; ?>