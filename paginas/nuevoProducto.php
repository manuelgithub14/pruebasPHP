<?php
$titulo = 'Creaci&oacute;n de productos';
$script = '/js/nuevosProductos.js';
$cssPersonalizado = '';
$mensaje = '';

if (isset($_SESSION['id_usuario'])) {
    $user = Usuario::obtenerUsuarioPorID($db, $_SESSION['id_usuario']);
}

if ($user->getTipo() === 'admin') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['titulo']) && !empty($_POST['descripcion']) && !empty($_FILES['imagen']) && !empty($_POST['referencia'])
                && !empty($_POST['precio'] && !empty($_POST['stock']))) {

            if ($_FILES['imagen']['size'] <= 30000) {
                $nuevoTitulo = $_POST['titulo'];
                $nuevaDescripcion = strip_tags($_POST['descripcion']);
                $nuevaReferencia = $_POST['referencia'];
                $nuevoPrecio = $_POST['precio'];
                $nuevoStock = $_POST['stock'];
                $dir_subida = 'recursos/imgProductos/';
                $dirNuevaImagen = $dir_subida . basename($_FILES['imagen']['name']);

                $producto = Producto::obtenerProductoPorTitulo($db, $nuevoTitulo);

                if (is_bool($producto)) {
                    $datos = [
                        'titulo' => $nuevoTitulo,
                        'descripcion' => $nuevaDescripcion,
                        'referencia' => $nuevaReferencia,
                        'imagen' => $dirNuevaImagen,
                        'precio' => $nuevoPrecio,
                        'stock' => $nuevoStock
                    ];
                    $nuevoProducto = new Producto($datos);
                    if ($nuevoProducto->guardar($db) && move_uploaded_file($_FILES['imagen']['tmp_name'], $dirNuevaImagen)) {
                        $mensaje = 'Producto creado.';
                    } else {
                        $mensaje = 'Error al guardar el producto.';
                    }
                } else {
                    $mensaje = 'Este producto ya esta creado.';
                }
            } else {
                $mensaje = 'Imagen demasidado grande.';
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
        <h1>Crear productos</h1>
        <div class="secundario">
            <form enctype="multipart/form-data" method="post" id="formProductos">
                <div>
                    <div class="field">
                        <label class="label">T&iacute;tulo</label>
                        <input type="text" class="input" name="titulo"/>
                        <p class="help" id="infoTitulo"></p>
                    </div>
                    <div class="field">
                        <label class="label">Descripci&oacute;n</label>
                        <textarea id="editor" class="textarea" name="descripcion" rows="4" cols="22"></textarea>
                        <p class="help" id="infoDescripcion"></p>
                    </div>
                    <div class="field">
                        <label class="label">Referencia</label>
                        <input type="text" class="input" name="referencia" />
                        <p class="help" id="infoReferencia"></p>
                    </div>
                    <div class="field">
                        <label class="label">Precio</label>
                        <input type="text" class="input" name="precio" />
                        <p class="help" id="infoPrecio"></p>
                    </div>
                    <div class="field">
                        <label class="label">Stock</label>
                        <input type="text" class="input" name="stock" />
                        <p class="help" id="infoStock"></p>
                    </div>
                    <div class="field">
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
                        <label class="label">Imagen</label>
                        <input type="file" class="input" name="imagen"/>
                        <p class="help" id="infoImagen"></p>
                    </div>
                </div>
                <input type="submit" class="button is-danger" id="btnCrearProducto" value="Crear producto"/>
            </form>
        </div>
        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>