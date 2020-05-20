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
        $pagina = $_GET['pagina'];
    } else {
        $pagina = 1;
    }

    $paginaInicio = ($pagina - 1) * $por_pagina;
    $total_paginas = ceil($total_registros / $por_pagina);
    $articulos_paginados = Articulo::obtenerArticulosPaginados($db, $paginaInicio, $por_pagina);
} else {
    $mensaje = 'Error al obtener los art&iacute;culos.';
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<h1>ARTICULOS</h1>
<div class="bloqueArticulos">
    <?php if ($articulos_paginados): ?>
        <?php foreach ($articulos_paginados as $articulo): ?>
            <div class="articulo">
                <p>T&iacute;tulo: <a href="detallesArticulo?idArticulo=<?= $articulo->getId() ?>"><?= htmlentities($articulo->getTitulo()) ?></a></p>
                <p>Texto: <?= htmlentities($articulo->getTexto()) ?></p>
                <p>Fecha: <?= htmlentities($articulo->getFecha()) ?></p>
                <img class="fotoArticulo" src="<?= htmlentities($articulo->getImagen()) ?>"/>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div>
    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
        <a href='articulos?pagina=<?= $i ?>' ><?= $i ?></a>
    <?php endfor; ?>
</div>

<?php if (!empty($articulos)): ?>
    <p><?= htmlentities($mensaje) ?></p>
<?php else: ?>
    <p>Todav&iacute;a no hay art&iacute;culos.</p>
<?php endif; ?>