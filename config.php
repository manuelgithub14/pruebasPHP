<?php
require 'vendor/autoload.php';

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_CHARSET', 'UTF-8');
define('SMTP_SECURE', 'tls');
define('USUARIO_CORREO', 'unCorreo');
define('PASSWORD_CORREO', 'unaContraseña');

session_start();
$db = new mysqli('127.0.0.1', 'root', '', 'db_phpproject1');

if (!$db) {
    exit('Fallo al conectarse a la base de datos');
}

// CARGA AUTOMÁTICA DE LAS CLASES NECESARIAS
spl_autoload_register(function ($nombre_clase) {
    include '../clases/' . $nombre_clase . '.php';
});