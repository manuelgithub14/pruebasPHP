<?php
$titulo = 'Art&iacute;culo';
$script = '/js/detallesArticulo.js';
$cssPersonalizado = '/css/comentarios.css';
$mensaje = '';

if (!empty($_GET['idArticulo'])) {
    // OBTENER COMENTARIOS DE ESTE ARTICULO
    $articulo = Articulo::obtenerArticuloPorId($db, $_GET['idArticulo']);
    $comentarios = Comentario::obtenerComentariosPorIdArticulo($db, $articulo->getId());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // GUARDAR NUEVO COMENTARIO
    if (!empty($_POST['textoComentario'])) {
        $textoSql = $db->real_escape_string($_POST['textoComentario']);
        $idArticuloSql = $db->real_escape_string($_GET['idArticulo']);

        $datos = [
            'idUsuario' => $_SESSION['id_usuario'],
            'idArticulo' => $idArticuloSql,
            'texto' => $textoSql
        ];

        $nuevoComentario = new Comentario($datos);
        if ($nuevoComentario->guardar($db)) {
            header('Location: /detallesArticulo?idArticulo=' . $_GET['idArticulo']);
        } else {
            $mensaje = 'Error al comentar';
        }
    }
    // GUARDAR RESPUESTA, AL COMENTARIO O A OTRA RESPUESTA
    if (!empty($_POST['textoRespuesta']) && !empty($_POST['idComentario']) || !empty($_POST['textoRespuestaRes']) && !empty($_POST['idRespuesta'])) {
        $idArticuloSql = $db->real_escape_string($_GET['idArticulo']);

        if (!empty($_POST['textoRespuesta']) && !empty($_POST['idComentario'])) {
            $textoSql = $db->real_escape_string($_POST['textoRespuesta']);
            $idComentarioSql = $db->real_escape_string($_POST['idComentario']);
        } else {
            $textoSql = $db->real_escape_string($_POST['textoRespuestaRes']);
            $idComentarioSql = $db->real_escape_string($_POST['idRespuesta']);
        }

        $datos = [
            'idUsuario' => $_SESSION['id_usuario'],
            'idArticulo' => $idArticuloSql,
            'texto' => $textoSql,
            'respuesta' => $idComentarioSql
        ];

        $nuevoComentario = new Comentario($datos);
        if ($nuevoComentario->guardar($db)) {
            header('Location: /detallesArticulo?idArticulo=' . $_GET['idArticulo']);
        } else {
            $mensaje = 'Error al responder';
        }
    }
}
?>

<?php include '../inc/menuNavegacion.php'; ?>
<main>
    <?php include '../inc/menuAside.php'; ?>
    <section>
        <div class="bloqueDetallesArticulo">
            <div>
                <p class="field"><label class="label">T&iacute;tulo</label><?= htmlentities($articulo->getTitulo()) ?></p>
                <p class="field"><label class="label">Fecha</label><?= htmlentities($articulo->getFecha()) ?></p>
                <p class="field"><label class="label">Texto</label><?= htmlentities($articulo->getTexto()) ?></p>
            </div>
            <img class="fotoArticulo" src="<?= htmlentities($articulo->getImagen()) ?>"/>
        </div>

        <!-- COMENTARIOS Y RESPUESTAS-->
        <div class="bloqueComentarios">
            <?php if (count($comentarios) > 0): ?>
                <?php foreach ($comentarios as $comentario): ?>

                    <!-- OBTENER USUARIO DE ESTE COMENTARIO-->
                    <?php $usuario = Usuario::obtenerUsuarioPorID($db, $comentario->getIdUsuario()) ?>
                    <span id="errores"></span>
                    <div class="comentar" >
                        <form id="formRespuestaResp" method="POST">
                            <label class="label">COMENTARIO</label>
                            <p class="textoComentarios">
                                <label class="label"><?= htmlentities($usuario->getCorreo()) ?></label>
                                <label><?= htmlentities($comentario->getTexto()) ?></label>
                            </p>

                            <!-- OBTENER RESPUESTAS A ESTE COMENTARIO-->
                            <?php $respuestas = Comentario::obtenerRespuestasPorIdComentario($db, $comentario->getId()) ?>
                            
                            <?php if (!empty($respuestas)): ?>
                                <label class="label">RESPUESTAS</label>
                                <?php foreach ($respuestas as $respuesta): ?>

                                    <!-- OBTENER USUARIO DE ESTA RESPUESTA -->
                                    <?php $usuarioResponde = Usuario::obtenerUsuarioPorID($db, $respuesta->getIdUsuario()) ?>
                                    <p class="textoComentarios">
                                        <label class="label"><?= htmlentities($usuarioResponde->getCorreo()) ?></label>
                                        <label><?= htmlentities($respuesta->getTexto()) ?></label>
                                    </p>

                                    <!-- OBTENER RESPUESTAS DE ESTA RESPUESTA -->
                                    <?php $respuestasRespondidas = Comentario::obtenerRespuestasPorIdComentario($db, $respuesta->getId()) ?>
                                    <?php foreach ($respuestasRespondidas as $respuestaRes): ?>

                                        <!-- OBTENER USUARIO DE ESTA RESPUESTA -->
                                        <?php $usuarioRespondeRes = Usuario::obtenerUsuarioPorID($db, $respuestaRes->getIdUsuario()) ?>
                                        <p class="textoComentarios">
                                            <label class="label"><?= htmlentities($usuarioRespondeRes->getCorreo()) ?></label>
                                            <label><?= htmlentities($respuestaRes->getTexto()) ?></label>
                                        </p>

                                    <?php endforeach; ?>

                                    <!-- PERMITIR RESPONDER A QUIEN NO HIZO LA RESPUESTA -->
                                    <?php if ($_SESSION['id_usuario'] !== $respuesta->getIdUsuario()): ?>
                                        <input type="hidden" name="idRespuesta" value="<?= $respuesta->getId() ?>"/>
                                        <textarea name="textoRespuestaRes" class="textarea" rows="4" cols="60" maxlength="255" id="textRespuestaResp"></textarea>
                                        <p class="help" id="infoRespuestaResp"></p>
                                        <input type="submit" class="button is-danger" value="Responder" id="btnResponderRespuesta"/>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </form>

                        <!-- PERMITIR RESPONDER A QUIEN NO HIZO EL COMENTARIO -->
                        <?php if ($_SESSION['id_usuario'] !== $comentario->getIdUsuario()): ?>
                            <form id="formRespuestaComentario" method="POST">
                                <input type="hidden" name="idComentario" value="<?= $comentario->getId() ?>"/>
                                <textarea name="textoRespuesta" class="textarea" rows="4" cols="60" maxlength="255" id="textRespuesta"></textarea>
                                <p class="help" id="infoRespuesta"></p>
                                <input type="submit" class="button is-danger" value="Responder" id="btnResponderComentario"/>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- ZONA PARA COMENTAR-->
            <div class="comentar">
                <label class="label">A&Ntilde;ADE UN COMENTARIO</label>
                <form id="formComentario" method="POST" >
                    <textarea name="textoComentario" class="textarea" maxlength="255" id="textComentario"></textarea>
                    <p class="help" id="infoComentario"></p>
                    <div>
                        <input type="submit" class="button is-danger" value="Comentar"/>
                    </div>
                </form>
            </div>
        </div>

        <?php if (!empty($comentarios)): ?>
            <p><?= htmlentities($mensaje) ?></p>
        <?php else: ?>
            <p>Todav&iacute;a no hay comentarios.</p>
        <?php endif; ?>
    </section>
</main>