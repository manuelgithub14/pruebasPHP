<?php
$titulo = 'Producto';
$script = '';
$cssPersonalizado = '';
$mensaje = '';
$idProducto = '';

if (!empty($path[1])) {
    $idProducto = $path[1];
    $producto = Producto::obtenerProductoPorId($db, $idProducto);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($producto->getStock() > 0) {
        $producto->setStock($producto->getStock() - 1);
        if ($producto->guardar($db)) {
            $mensaje = 'Compra realizada con &eacute;xito';
        } else {
            $mensaje = 'Error al realizar la compra';
        }
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
                <p class="field"><label class="label">Precio</label><?= htmlentities($producto->getPrecio()) ?> €</p>
                <p class="field"><label class="label">Stock</label><?= htmlentities($producto->getStock()) ?> unidades</p>
            </div>
            <img class="fotoDetalleProducto" src="/<?= htmlentities($producto->getImagen()) ?>"/>

        </div>
        <form method="POST">
            <input type="submit" id="btnComprar" class="button is-danger" value="Comprar producto">
        </form>
        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>