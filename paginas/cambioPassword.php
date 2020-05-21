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
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <h1>Cambiar contrase&ntilde;a</h1>
        <div class="secundario">
            <form method="post" id="formCambioPassword">
                <div class="field">
                    <label class="label">Contrase&ntilde;a antigua</label>
                    <input type="password" class="input" name="passAntiguo" autofocus="true" id="passActual"/>
                    <p class="help" id="infoPassAntiguo"></p>
                </div>
                <div class="field">
                    <label class="label">Contrase&ntilde;a nueva</label>
                    <input type="password" class="input" name="passNuevo" id="passNuevo"/>
                    <p class="help" id="infoPassNuevo"></p>
                </div>
                <div class="field">
                    <label class="label">Repita contrase&ntilde;a nueva</label>
                    <input type="password" class="input" name="passRepNuevo" id="passNuevoRep"/>
                    <p class="help" id="infoPassNuevoRep"></p>
                </div>
                <input type="submit" class="button is-danger" id="btnCambiarPass" value="Cambiar"/>
            </form>
        </div>

        <?php if (!empty($result)): ?>
            <p><?= htmlentities($mensaje) ?></p>
        <?php endif; ?>
    </section>
</main>