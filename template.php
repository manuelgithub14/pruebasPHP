<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <script src="/js/ckeditor5-build-classic/ckeditor.js" type="text/javascript"></script>
    <script src="/js/ckeditor5-build-classic/translations/es.js" type="text/javascript"></script>
    <?php if($script): ?>
        <script src="<?= $script ?>"></script>
    <?php endif;?>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="stylesheet" href="/css/estilos.css">
</head>
<body>
    <header>
        <a href="/">Principal</a>
        <address></address>
    </header>
    <div class="principal">
        <?= $body ?>
    </div>
    <div class="pie">
        
    </div>
</body>
</html>