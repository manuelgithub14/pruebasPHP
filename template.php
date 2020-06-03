<?php ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $titulo ?></title>
        <script src="/js/ckeditor5-build-classic/ckeditor.js" type="text/javascript"></script>
        <script src="/js/ckeditor5-build-classic/translations/es.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" type="text/javascript"></script>
        <?php if ($script): ?>
            <script src="<?= $script ?>"></script>
        <?php endif; ?>
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/bulma.min.css">
        <link rel="stylesheet" href="/css/estiloPrincipal.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
        <?php if ($cssPersonalizado): ?>
            <link rel="stylesheet" href="<?= $cssPersonalizado ?>">
        <?php endif; ?>
    </head>
    <body>
        <header>
            <address></address>
        </header>
        <div class="principal">
            <?= $body ?>
        </div>
        <footer class="navbar is-danger">
            <p>Aplicaci&oacute;n con PHP</p>
        </footer>
    </body>
</html>