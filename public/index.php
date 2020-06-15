<?php
require '../config.php';

$get_path = $_GET['path'] ?? '';
$path = explode('/', trim($get_path, '/'));
$pagina = $path[0] ?? '';

ob_start();

switch ($pagina) {
    case 'login':
        require '../paginas/login.php';
        break;
    case 'signup':
        require '../paginas/signup.php';
        break;
    case 'logout':
        require '../paginas/logout.php';
        break;
    case 'cambioPassword':
        require '../paginas/cambioPassword.php';
        break;
    case 'recuperarPassword':
        require '../paginas/recuperarPassword.php';
        break;
    case 'editarPerfil':
        require '../paginas/editarPerfil.php';
        break;
    case 'nuevoArticulo':
        require '../paginas/nuevoArticulo.php';
        break;
    case 'articulos':
        require '../paginas/articulos.php';
        break;
    case 'detallesArticulo':
        require '../paginas/detallesArticulo.php';
        break;
    case 'visitasPagina':
        require '../paginas/visitasPagina.php';
        break;
    case 'usoNavegadores':
        require '../paginas/usoNavegadores.php';
        break;
    case 'nuevoProducto':
        require '../paginas/nuevoProducto.php';
        break;
    case 'productos':
        require '../paginas/productos.php';
        break;
    case 'detallesProducto':
        require '../paginas/detallesProducto.php';
        break;
    case '':
        require '../paginas/inicio.php';
        break;
    default:
        require '../paginas/404.php';
        break; 
}

$datos = [
    'ip' => $_SERVER['REMOTE_ADDR'],
    'urlSolicitada' => $_SERVER['REQUEST_URI'],
    'idUsuario' => isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : '',
    'userAgent' => $_SERVER['HTTP_USER_AGENT'],
    'urlReferencia' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''
];
$usoWeb = new UsoWeb($datos);
$usoWeb->guardar($db);

$body = ob_get_clean();

require '../template.php';
?>
