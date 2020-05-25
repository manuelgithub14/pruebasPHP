<?php
$titulo = 'Art&iacute;culo';
$script = '';
$cssPersonalizado = '';
$mensaje = '';
$articulos = Articulo::obtenerArticulos($db);
$por_pagina = 2;

if (!is_bool($articulos)) {
    $total_registros = count($articulos);

    if (isset($_GET['pagina'])) {
        $pagina = (int) $_GET['pagina'];
    } else {
        $pagina = 1;
    }

    $paginaInicio = ($pagina - 1) * $por_pagina;
    $total_paginas = ceil($total_registros / $por_pagina);
    $articulos_paginados = Articulo::obtenerArticulosPaginados($db, $paginaInicio, $por_pagina);
} else {
    $mensaje = 'Error al obtener los art&iacute;culos.';
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
        <h1>Art&iacute;culos</h1>
        <div class="bloqueArticulos">
            <?php if ($articulos_paginados): ?>
                <?php foreach ($articulos_paginados as $articulo): ?>
                    <div class="articulo">
                        <p>T&iacute;tulo: 
                            <?php if ($logueado): ?>
                                <a href="detallesArticulo?idArticulo=<?= $articulo->getId() ?>"><?= htmlentities($articulo->getTitulo()) ?></a>
                            <?php else : ?>
                                <?= htmlentities($articulo->getTitulo()) ?>
                            <?php endif; ?>
                        </p>
                        <p>Fecha: <?= htmlentities($articulo->getFecha()) ?></p>
                        <p>Texto: <?= htmlentities($articulo->getTexto()) ?></p>
                        <img class="fotoArticulo" src="<?= htmlentities($articulo->getImagen()) ?>"/>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="paginador">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <?php if ($pagina === $i): ?>
                    <a class="pagination-link is-current"><?= $i ?></a>
                <?php else: ?>
                    <a class="pagination-link" href='articulos?pagina=<?= $i ?>' ><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <?php if (!empty($articulos)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php else: ?>
            <p class="mensaje">Todav&iacute;a no hay art&iacute;culos.</p>
        <?php endif; ?>
    </section>
</main>