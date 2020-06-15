<?php
$titulo = 'Productos';
$script = '';
$cssPersonalizado = '';
$mensaje = '';
$productos = Producto::obtenerProductos($db);
$por_pagina = 2;

if (!is_bool($productos)) {
    $total_registros = count($productos);

    if (isset($path[1])) {
        $pagina = (int) $path[1];
    } else {
        $pagina = 1;
    }

    $paginaInicio = ($pagina - 1) * $por_pagina;
    $total_paginas = ceil($total_registros / $por_pagina);
    $productosPaginados = Producto::obtenerProductosPaginados($db, $paginaInicio, $por_pagina);
} else {
    $mensaje = 'Error al obtener los productos.';
}

if (isset($_SESSION['id_usuario'])) {
    $logueado = true;
} else {
    $logueado = false;
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php if ($logueado): ?>
        <?php include '../inc/menuAside.php'; ?>
    <?php endif; ?>
    <section>
        <h1>Productos</h1>
        <div class="bloqueProductos">
            <?php if ($productosPaginados): ?>
                <?php foreach ($productosPaginados as $producto): ?>
                    <div class="producto">
                        <p>T&iacute;tulo: 
                            <?php if ($logueado): ?>
                                <a href="/detallesProducto/<?= $producto->getId() ?>"><?= htmlentities($producto->getTitulo()) ?></a>
                            <?php else : ?>
                                <?= htmlentities($producto->getTitulo()) ?>
                            <?php endif; ?>
                        </p>
                        <img class="fotoProducto" src="/<?= htmlentities($producto->getImagen()) ?>"/>
                        <p>Precio: <?= number_format(htmlentities($producto->getPrecio()), 2) ?> €</p>
                        <p>Stock: <?= htmlentities($producto->getStock()) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="paginador">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <?php if ($pagina === $i): ?>
                    <a class="pagination-link is-current"><?= $i ?></a>
                <?php else: ?>
                    <a class="pagination-link" href='/productos/<?= $i ?>' ><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <?php if (!empty($productos)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php else: ?>
            <p class="mensaje">Todav&iacute;a no hay productos.</p>
        <?php endif; ?>
    </section>
</main>