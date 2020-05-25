<?php
$titulo = 'Creaci&oacute;n de art&iacute;culos';
$script = '/js/nuevosArticulos.js';
$cssPersonalizado = '';
$mensaje = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}

if ($user->getTipo() === 'admin') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['titulo']) && !empty($_POST['texto']) && !empty($_FILES['imagen'])) {
            if ($_FILES['imagen']['size'] <= 30000) {
                $nuevoTitulo = $_POST['titulo'];
                $nuevoTexto = strip_tags($_POST['texto']);
                $nuevaFecha = $_POST['fecha'];
                $dir_subida = 'recursos/';
                $dirNuevaImagen = $dir_subida . basename($_FILES['imagen']['name']);

                $articulo = Articulo::obtenerArticuloPorTitulo($db, $nuevoTitulo);

                if (is_bool($articulo)) {
                    $datos = [
                        'titulo' => $nuevoTitulo,
                        'texto' => $nuevoTexto,
                        'fecha' => $nuevaFecha,
                        'imagen' => $dirNuevaImagen
                    ];
                    $nuevoArticulo = new Articulo($datos);
                    if ($nuevoArticulo->guardar($db) && move_uploaded_file($_FILES['imagen']['tmp_name'], $dirNuevaImagen)) {
                        $mensaje = 'Art&iacute;culo creado.';
                    } else {
                        $mensaje = 'Error al guardar el art&iacute;culo.';
                    }
                } else {
                    $mensaje = 'Este art&iacute;culo ya esta creado.';
                }
            } else {
                $mensaje = 'Archivo demasidado grande.';
            }
        }
    }
} else {
    header('Location: /');
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <h1>Crear art&iacute;culos</h1>
        <div class="secundario">
            <form enctype="multipart/form-data" method="post" id="formArticulos">
                <div>
                    <div class="field">
                        <label class="label">T&iacute;tulo</label>
                        <input type="text" class="input" name="titulo"/>
                        <p class="help" id="infoTitulo"></p>
                    </div>
                    <div class="field">
                        <label class="label">Texto</label>
                        <textarea id="editor" class="textarea" name="texto" rows="4" cols="22"></textarea>
                        <p class="help" id="infoTexto"></p>
                    </div>
                    <div class="field">
                        <label class="label">Fecha</label>
                        <input type="date" class="input" name="fecha" placeholder="dd-mm-aaaa"/>
                    </div>
                    <div class="field">
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
                        <label class="label">Imagen</label>
                        <input type="file" class="input" name="imagen"/>
                        <p class="help" id="infoImagen"></p>
                    </div>
                </div>
                <input type="submit" class="button is-danger" id="btnCrearArticulo" value="Crear art&iacute;culo"/>
            </form>
        </div>
        <?php if (!empty($mensaje)): ?>
        <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>