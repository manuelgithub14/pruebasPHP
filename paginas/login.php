<?php
$titulo = 'Mi Login';
$script = '/js/login.js';
$mensaje = '';

if (isset($_SESSION['id_usuario'])) {
    header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['correo']) && !empty($_POST['password'])) {
        $correo = $_POST['correo'];

        $user = Usuario::obtenerUsuarioPorCorreo($db, $correo);
        
        if (!is_bool($user) && password_verify($_POST['password'], $user->getPassword()) && $user->getActivado()) {
            $user->login($user->getId());
        } else {
            $mensaje = 'Error, datos incorrectos';
        }
    }
}else if(!empty ($_GET['id'])){
    $result = Usuario::activarCuenta($db, $_GET['id']);
    if($result){
        $mensaje = 'Cuenta activada';
    }else{
        $mensaje = 'Error al activar la cuenta';
    }
}
?>

<?php if (!empty($_GET['id']) ): ?>
    <p>Gracias por registrarse. Ya puedes iniciar sesión</p>
<?php endif; ?>
<h1>Logueate</h1>
<span>o <a href="signup">Registrate</a></span>

<?php if (!empty($mensaje)): ?>
    <p><?= $mensaje ?></p>
<?php endif; ?>

<div class="secundario">
    <form method="post" id="formLogin" >
        <span id="errores"></span>
        <div class="camposForm">
            <label>Correo: <input type="text" name="correo" autofocus="true"/></label>
            <label>Contraseña: <input type="password" name="password"/></label>
        </div>
        <input type="button" id="btnSubmitLogin" value="Entrar"/>
    </form>
</div>

