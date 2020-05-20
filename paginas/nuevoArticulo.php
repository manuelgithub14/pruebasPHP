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
<div class="secundario">
    <form enctype="multipart/form-data" method="post" id="formArticulos">
        <h1>Crear articulos</h1>
        <span id="errores"></span>
        <div class="camposForm">
            <label>T&iacute;tulo: <input type="text" name="titulo"/></label>
            <label>Texto: <textarea id="editor" name="texto" rows="4" cols="22"></textarea></label>
            <label>Fecha: <input type="date" name="fecha" placeholder="dd-mm-aaaa"/></label>
            <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
            <label>Imagen: <input type="file" name="imagen"/></label>
        </div>
        <input type="submit" id="btnCrearArticulo" value="Crear art&iacute;culo"/>
    </form>
</div>
<?php if (!empty($mensaje)): ?>
    <p><?= htmlentities($mensaje) ?></p>
<?php endif; ?>