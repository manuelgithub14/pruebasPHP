<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Correo {

    private $mensajero;
    private $nombreMensajero;
    private $destinatario;
    private $asunto;
    private $mensaje;
    private $archivoAdjunto;

    public function __construct($datos = []) {
        if (is_array($datos)) {
            foreach ($datos as $clave => $valor) {
                switch ($clave) {
                    default:
                        $this->$clave = $valor;
                }
            }
        }
    }

    // GETTERS
    function getMensajero() {
        return $this->mensajero;
    }
    
    function getNombreMensajero() {
        return $this->nombreMensajero;
    }

    function getDestinatario() {
        return $this->destinatario;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getArchivoAdjunto() {
        return $this->archivoAdjunto;
    }

    // SETTERS
    function setMensajero($mensajero) {
        $this->mensajero = $mensajero;
        return $this;
    }

    function setNombreMensajero($nombreMensajero) {
        $this->nombreMensajero = $nombreMensajero;
        return $this;
    }

    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
        return $this;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
        return $this;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
        return $this;
    }

    function setArchivoAdjunto($archivoAdjunto) {
        $this->archivoAdjunto = $archivoAdjunto;
        return $this;
    }

    // FUNCIONES
    public function enviar() {
        date_default_timezone_set('Etc/UTC');

        $mail = new PHPMailer;
        $mail->isSMTP();
        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = MAIL_HOST;
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->CharSet = MAIL_CHARSET;
        $mail->Username = USUARIO_CORREO;
        $mail->Password = PASSWORD_CORREO;
        $mail->setFrom($this->mensajero, $this->nombreMensajero);
        $mail->addAddress($this->destinatario);
        $mail->Subject = $this->asunto;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->msgHTML($this->mensaje);
        $mail->AltBody = strip_tags($this->mensaje);
        $mail->addAttachment($this->archivoAdjunto);

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

}
