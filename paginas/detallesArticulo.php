<?php
$titulo = 'Articulo';
$script = '';
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
<div class="bloqueDetallesArticulo">
    <div>
        <p><label class="tituloTexto">Titulo: </label><?= $articulo->getTitulo() ?></p>
        <p><label class="tituloTexto">Fecha: </label><?= $articulo->getFecha() ?></p>
        <p><label class="tituloTexto">Texto: </label><?= $articulo->getTexto() ?></p>
    </div>
    <img class="fotoArticulo" src="<?= $articulo->getImagen() ?>"/>
</div>

<!-- COMENTARIOS Y RESPUESTAS-->
<div class="bloqueComentarios">
    <?php if (count($comentarios) > 0): ?>
        <?php foreach ($comentarios as $comentario): ?>

            <!-- OBTENER USUARIO DE ESTE COMENTARIO-->
            <?php $usuario = Usuario::obtenerUsuarioPorID($db, $comentario->getIdUsuario()) ?>
            <div class="comentar" >
                <form id="formRespuestaComentario" method="POST">
                    <label class="titulos">COMENTARIO</label>
                    <p class="textoComentarios">
                        <label class="tituloTexto"><?= $usuario->getCorreo() ?></label>
                        <label><?= $comentario->getTexto() ?></label>
                    </p>

                    <!-- OBTENER RESPUESTAS A ESTE COMENTARIO-->
                    <label class="titulos">RESPUESTAS</label>
                    <?php $respuestas = Comentario::obtenerRespuestasPorIdComentario($db, $comentario->getId()) ?>
                    <?php foreach ($respuestas as $respuesta): ?>

                        <!-- OBTENER USUARIO DE ESTA RESPUESTA -->
                        <?php $usuarioResponde = Usuario::obtenerUsuarioPorID($db, $respuesta->getIdUsuario()) ?>
                        <p class="textoComentarios">
                            <label class="tituloTexto"><?= $usuarioResponde->getCorreo() ?></label>
                            <label><?= $respuesta->getTexto() ?></label>
                        </p>

                        <!-- OBTENER RESPUESTAS DE ESTA RESPUESTA -->
                        <?php $respuestasRespondidas = Comentario::obtenerRespuestasPorIdComentario($db, $respuesta->getId()) ?>
                        <?php foreach ($respuestasRespondidas as $respuestaRes): ?>

                            <!-- OBTENER USUARIO DE ESTA RESPUESTA -->
                            <?php $usuarioRespondeRes = Usuario::obtenerUsuarioPorID($db, $respuestaRes->getIdUsuario()) ?>
                            <p class="textoComentarios">
                                <label class="tituloTexto"><?= $usuarioRespondeRes->getCorreo() ?></label>
                                <label><?= $respuestaRes->getTexto() ?></label>
                            </p>

                        <?php endforeach; ?>

                        <!-- PERMITIR RESPONDER A QUIEN NO HIZO LA RESPUESTA -->
                        <?php if ($_SESSION['id_usuario'] !== $respuesta->getIdUsuario()): ?>
                            <input type="hidden" name="idRespuesta" value="<?= $respuesta->getId() ?>"/>
                            <textarea name="textoRespuestaRes" rows="4" cols="60" maxlength="255"></textarea>
                            <input type="submit" value="Responder" id="btnResponderRespuesta"/>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <!-- PERMITIR RESPONDER A QUIEN NO HIZO EL COMENTARIO -->
                    <?php if ($_SESSION['id_usuario'] !== $comentario->getIdUsuario()): ?>
                        <input type="hidden" name="idComentario" value="<?= $comentario->getId() ?>"/>
                        <textarea name="textoRespuesta" rows="4" cols="60" maxlength="255"></textarea>
                        <input type="submit" value="Responder" id="btnResponderComentario"/>
                    <?php endif; ?>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- ZONA PARA COMENTAR-->
    <div class="comentar">
        <label class="titulos">AÑADE UN COMENTARIO</label>
        <form id="formComentario" method="POST" >
            <textarea name="textoComentario" rows="4" cols="60" maxlength="255"></textarea>
            <div>
                <input type="submit" value="Comentar"/>
            </div>
        </form>
    </div>
</div>

<?php if (!empty($comentarios)): ?>
    <p><?= $mensaje ?></p>
<?php else: ?>
    <p>Todavía no hay comentarios.</p>
<?php endif; ?>