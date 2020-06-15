<?php
$titulo = 'Carrito';
$script = '';
$cssPersonalizado = '';
$mensaje = '';
$exiteCarrito = false;
$compraOk = true;

if (isset($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
    if(count($carrito) > 0){
        $exiteCarrito = true;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        foreach ($carrito as $key => $productoCarrito) {
            $productoCarrito->setStock($productoCarrito->getStock() - 1);
            
            if (!$productoCarrito->guardar($db)) {
                $compraOk = false;
                break;
            }else{
                unset($_SESSION['carrito'][$key]);
            }
        }
        
        if($compraOk){
            $mensaje = 'Compra realizada con &eacute;xito';
            $_SESSION['carrito'] = [];
        }else{
            $mensaje = 'Error al realizar la compra';
        }
    }
} else {
    $mensaje = 'El carrito est&aacute; vac&iacute;o';
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <?php if ($exiteCarrito): ?>
            <h1>Productos en el carrito</h1>
            <?php foreach ($carrito as $producto): ?>
                <div class="secundario bloqueDetallesProducto">
                    <div>
                        <p class="field"><label class="label">T&iacute;tulo</label><?= htmlentities($producto->getTitulo()) ?></p>
                        <p class="field"><label class="label">Referencia</label><?= htmlentities($producto->getReferencia()) ?></p>
                        <p class="field"><label class="label">Descripci&oacute;n</label><?= htmlentities($producto->getDescripcion()) ?></p>
                        <p class="field"><label class="label">Precio</label><?= number_format(htmlentities($producto->getPrecio()), 2) ?> €</p>
                    </div>
                    <img class="fotoDetalleProducto" src="/<?= htmlentities($producto->getImagen()) ?>"/>
                </div>
            <?php endforeach; ?>
            <form method="POST">
                <input type="submit" id="btnComprar" class="button is-danger" value="Realizar compra">
                <a href="/productos" class="button is-info">Volver a productos</a>
            </form>
        <?php else:?>
            <h1>El carrito est&aacute; vac&iacute;o</h1>
            <form>
                <a href="/productos" class="button is-info btnInfo">Volver a productos</a>
            </form>
        <?php endif; ?>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>