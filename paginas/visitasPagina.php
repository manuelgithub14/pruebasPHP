<?php
$titulo = 'Visitas por p&aacute;ginas';
$script = '/js/visitasPagina.js';
$cssPersonalizado = '';
$mensaje = '';
$verGrafica = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $arrayPaginas = [];
    $fechas = new stdClass();

    if (!empty($_POST['fechaIni']) && !empty($_POST['fechaFin'])) {
        $fechas->inicio = $_POST['fechaIni'];
        $fechas->final = $_POST['fechaFin'];
        $arrayPaginas = UsoWeb::obtenerVisitasPaginasEntreFechas($db, $fechas->inicio, $fechas->final . ' 23:59:59');
        $verGrafica = true;
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <h1>Visitas de p&aacute;ginas</h1>
        <div class="secundario">
            <form method="post" id="formFechaVisitas">
                <div class="field">
                    <label class="label">Fecha inicio</label>
                    <input type="date" class="input" id="fechaIni" name="fechaIni" value=""/>
                    <p class="help" id="infoFechaInicio"></p>
                </div>
                <div class="field">
                    <label class="label">Fecha final</label>
                    <input type="date" class="input" id="fechaFin" name="fechaFin" value=""/>
                    <p class="help" id="infoFechaFin"></p>
                </div>
                <input type="submit" class="button is-danger" value="Generar"/>
            </form>

            <?php if ($verGrafica): ?>
                <canvas id="canvasGrafica" width="200" height="200"></canvas>
            <?php endif; ?>
        </div>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>


    </section>
</main>

<script type="application/json" id="datosPaginas">
<?= json_encode($arrayPaginas) ?>
</script>
<script type="application/json" id="datosFechas">
    <?= json_encode($fechas) ?>
</script>