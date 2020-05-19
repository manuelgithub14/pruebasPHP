<?php
$titulo = 'Registrate';
$script = '/js/signup.js';
$cssPersonalizado = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['correo']) && !empty($_POST['password']) && !empty($_POST['dni']) && !empty($_POST['edad']) && is_numeric($_POST['edad'])) {
        $nuevoCorreo = $_POST['correo'];
        $nuevoPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nuevoDni = $_POST['dni'];
        $nuevaEdad = $_POST['edad'];

        $user = Usuario::obtenerUsuarioPorCorreo($db, $nuevoCorreo);

        if (is_bool($user)) {
            $datos = [
                'correo' => $nuevoCorreo,
                'password' => $nuevoPassword,
                'dni' => $nuevoDni,
                'edad' => $nuevaEdad,
                'tipo' => null,
                'token' => bin2hex(random_bytes(10))
            ];
            $nuevoUser = new Usuario($datos);
            $nuevoUser->guardar($db);

            $datosCorreo = [
                'mensajero' => 'manueljesusmb@gmail.com',
                'nombreMensajero' => 'Manuel J',
                'destinatario' => $nuevoUser->getCorreo(),
                'asunto' => 'Confirmar registro',
                'mensaje' => '<a href="http://localhost/login?id=' . $nuevoUser->getId() . '&token=' . $nuevoUser->getToken() . '">Pincha aquí para activar tu cuenta</a>',
                'archivoAdjunto' => 'recursos/imagen.png',
            ];
            $correo = new Correo($datosCorreo);
            if ($correo->enviar()) {
                $mensaje = 'Mensaje enviado!';
            } else {
                $mensaje = 'Error al enviar el mensaje';
            }

            header('Location: /login');
            exit();
        } else {
            $mensaje = 'Ya estás registrado';
        }
    }
}
?>

<h1>Registrate</h1>
<span>o <a href="login">Logueate</a></span>

<div class="secundario">
    <form method="post" id="formSignup">
        <span id="errores"></span>
        <div class="camposForm">
            <label>Correo: <input type="text" name="correo"/></label>
            <label>Contraseña: <input type="password" name="password"/></label>
            <label>D.N.I.: <input type="text" name="dni"/></label>
            <label>Edad: <input type="text" name="edad"/></label>
        </div>
        <input type="button" id="btnGuardar" value="Guardar"/>
    </form>
</div>


<?php if (!empty($mensaje)): ?>
    <p><?= $mensaje ?></p>
<?php endif; ?>