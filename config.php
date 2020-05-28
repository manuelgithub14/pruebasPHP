<?php
require 'vendor/autoload.php';

define('MAIL_HOST', getenv('SERVIDOR_CORREO') ?: 'smtp.gmail.com');
define('MAIL_CHARSET', getenv('CHARSET_CORREO') ?: 'UTF-8');
define('SMTP_SECURE', getenv('SMTP_SEGURO') ?: 'tls');
define('USUARIO_CORREO', getenv('USUARIO_CORREO') ?: 'unCorreo');
define('PASSWORD_CORREO', getenv('PASSWORD_CORREO') ?: 'unaContraseña');

define('SERVIDOR', getenv('SERVIDOR') ?: '127.0.0.1');
define('USUARIO', getenv('USUARIO') ?: 'root');
define('CLAVE', getenv('CLAVE') ?: '');
define('NOMBRE_DB', getenv('NOMBRE_DB') ?: 'db_phpproject1');

session_start();
$db = new mysqli(SERVIDOR, USUARIO, CLAVE, NOMBRE_DB);

if (!$db) {
    exit('Fallo al conectarse a la base de datos');
}

// CARGA AUTOMÁTICA DE LAS CLASES NECESARIAS
spl_autoload_register(function ($nombre_clase) {
    include '../clases/' . $nombre_clase . '.php';
});