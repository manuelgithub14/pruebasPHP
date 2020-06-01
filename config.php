<?php
require 'vendor/autoload.php';

// SERVIDOR CORREO (GMAIL) -> smtp.gmail.com
// SMTP SECURE -> tls
// PUERTO -> 587
// SERVIDOR CORREO (OUTLOOK) -> smtp.office365.com
// SMTP SECURE -> STARTTLS
// PUERTO -> 587

define('MAIL_HOST', getenv('SERVIDOR_CORREO') ?: 'smtp.gmail.com');
define('MAIL_CHARSET', getenv('CHARSET_CORREO') ?: 'UTF-8');
define('SMTP_SECURE', getenv('SMTP_SEGURO') ?: 'tls');
define('USUARIO_CORREO', getenv('USUARIO_CORREO') ?: 'cuentapruebas757@gmail.com');
define('PASSWORD_CORREO', getenv('PASSWORD_CORREO') ?: '3ntrarPruebas');

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