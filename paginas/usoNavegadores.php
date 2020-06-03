<?php
$titulo = 'Uso navegadores';
$script = '/js/usoNavegadores.js';
$cssPersonalizado = '';
$mensaje = '';

$navegadores = UsoWeb::obtenerUsoNavegadores($db);
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <h1>Uso navegadores</h1>
        <div class="secundario">
            <canvas id="canvasGrafica" width="200" height="200"></canvas>
        </div>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
    </section>
</main>

<script type="application/json" id="datosNavegadores">
    <?= json_encode($navegadores)?>
</script>