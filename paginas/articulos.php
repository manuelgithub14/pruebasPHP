<?php
$titulo = 'Articulos';
$script = '';
$mensaje = '';
$articulos = Articulo::obtenerArticulos($db);

if (!empty($articulos)) {
    ($articulos) ? $mensaje = '' : $mensaje = 'Error al obtener los articulos.';
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<h1>ARTICULOS</h1>
<div class="bloqueArticulos">
    <?php if ($articulos): ?>
        <?php foreach ($articulos as $articulo): ?>
            <div class="articulo">
                <p>Titulo: <?= $articulo['titulo'] ?></p>
                <p>Texto: <?= $articulo['texto'] ?></p>
                <p>Fecha: <?= $articulo['fecha'] ?></p>
                <img class="fotoArticulo" src="<?= $articulo['imagen'] ?>"/>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php if (!empty($articulos)): ?>
    <p><?= $mensaje ?></p>
<?php else: ?>
    <p>Todavía no hay articulos.</p>
<?php endif; ?>