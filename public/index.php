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
    case 'nuevoArticulo':
        require '../paginas/nuevoArticulo.php';
        break;
    case 'articulos':
        require '../paginas/articulos.php';
        break;
    case '':
        require '../paginas/inicio.php';
        break;
    default:
        require '../paginas/404.php';
        break; 
}

$body = ob_get_clean();

require '../template.php';
?>
