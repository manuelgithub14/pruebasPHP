<?php
$titulo = 'Producto';
$script = '';
$cssPersonalizado = '';
$mensaje = '';
$idProducto = '';

if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = [];
}

if (!empty($path[1])) {
    $idProducto = $path[1];
    $producto = Producto::obtenerProductoPorId($db, $idProducto);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($producto->getStock() > 0) {
        $_SESSION['carrito'][] = $producto;
        $mensaje = 'Producto a&ntilde;adido al carrito';
    } else {
        $mensaje = 'Lo sentimos no hay stock de este producto';
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <div class="secundario bloqueDetallesProducto">
            <div>
                <p class="field"><label class="label">T&iacute;tulo</label><?= htmlentities($producto->getTitulo()) ?></p>
                <p class="field"><label class="label">Referencia</label><?= htmlentities($producto->getReferencia()) ?></p>
                <p class="field"><label class="label">Descripci&oacute;n</label><?= htmlentities($producto->getDescripcion()) ?></p>
                <p class="field"><label class="label">Precio</label><?= number_format(htmlentities($producto->getPrecio()), 2) ?> €</p>
                <p class="field"><label class="label">Stock</label><?= htmlentities($producto->getStock()) ?> unidades</p>
            </div>
            <img class="fotoDetalleProducto" src="/<?= htmlentities($producto->getImagen()) ?>"/>

        </div>
        <form method="POST">
            <input type="submit" id="btnAñadirCarrito" class="button is-danger" value="A&ntilde;adir al carrito">
            <a href="/carrito" class="button is-info btnInfo">Ver carrito</a>
        </form>
        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>