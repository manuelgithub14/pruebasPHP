<?php
$titulo = 'Mi Login';
$script = '/js/login.js';
$cssPersonalizado = '';
$mensaje = '';

if (isset($_SESSION['id_usuario'])) {
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['correo']) && !empty($_POST['password'])) {
        $correo = $_POST['correo'];

        $user = Usuario::obtenerUsuarioPorCorreo($db, $correo);

        if (!is_bool($user) && password_verify($_POST['password'], $user->getPassword())) {
            if ($user->getActivado()) {
                $user->login($db, $user->getId());
            } else {
                $mensaje = 'Error, tienes que activar tu cuenta';
            }
        } else {
            $mensaje = 'Error, datos incorrectos';
        }
    }
} else if (!empty($_GET['id']) && !empty($_GET['token'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_GET['id']);

    if ($user->getToken() === $_GET['token']) {
        $result = Usuario::activarCuenta($db, $_GET['id']);
        if ($result) {
            $mensaje = 'Cuenta activada';
        } else {
            $mensaje = 'Error al activar la cuenta';
        }
    } else {
        $mensaje = 'Error, enlace incorrecto';
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <section>
        <?php if (!empty($_GET['id']) && !empty($_GET['token'])): ?>
            <p class="mensaje">Gracias por activar tu cuenta. Ya puedes iniciar sesi&oacute;n</p>
        <?php elseif (!empty($_GET['faltaActivar'])) : ?>
            <p class="mensaje">Gracias por registrarse. Te enviamos un e-mail para activar tu cuenta</p>
        <?php endif; ?>
        <h1>Logueate</h1>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>

        <div class="secundario">
            <form method="post" id="formLogin" >
                <div class="field">
                    <label class="label">Correo</label>
                    <input type="text" class="input" name="correo" autofocus="true"/>
                    <p class="help" id="infoCorreo"></p>
                </div>
                <div class="field">
                    <label class="label">Contrase&ntilde;a</label>
                    <input type="password" class="input" name="password"/>
                    <p class="help" id="infoPassword"></p>
                </div>

                <input type="submit" class="button is-danger" id="btnSubmitLogin" value="Entrar"/>
            </form>
        </div>
        <h2><a href="recuperarPassword">Recuperar contrase&ntilde;a</a></h2>
    </section>
</main>
