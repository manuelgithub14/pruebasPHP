<?php

class Usuario {

    private $id;
    private $correo;
    private $password;
    private $dni;
    private $edad;
    private $tipo;
    private $activado;
    private $token;

    public function __construct($datos = []) {
        if (is_array($datos)) {
            foreach ($datos as $clave => $valor) {
                switch ($clave) {
                    case 'id_usuario':
                        $this->id = (int) $valor;
                        break;
                    default:
                        $this->$clave = $valor;
                }
            }
        }
    }

    // GETTERS
    public function getId() {
        return $this->id;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getTipo() {
        return $this->tipo;
    }
    
    public function getActivado() {
        return $this->activado;
    }

    public function getToken() {
        return $this->token;
    }

    //SETTERS
    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    // MÉTODOS
    public function guardar($db) {
        $correo = $db->real_escape_string($this->correo);
        $password = $db->real_escape_string($this->password);
        $dni = $db->real_escape_string($this->dni);
        $edad = $db->real_escape_string($this->edad);
        $id = $db->real_escape_string($this->id);
        $token = $db->real_escape_string($this->token);

        $consulta = (empty($this->id) ? "INSERT INTO" : "UPDATE" ) .
                " usuarios SET correo = '$correo',password = '$password',dni = '$dni',edad = '$edad',token = '$token'" .
                (empty($this->id) ? "" : " WHERE id_usuario = $id" );

        $resultado = $db->query($consulta);

        if ($resultado) {
            if (empty($this->id)) {
                $this->id = $db->insert_id;
            }
            return true;
        } else {
            return false;
        }
    }

    public function login($id) {
        $_SESSION['id_usuario'] = $id;
        header('Location: /');
        exit();
    }

    public static function cambiarContraseña($db, $passAntiguo, $passNuevo, $passNuevoRep) {
        if (isset($_SESSION['id_usuario'])) {
            $result = $db->query("SELECT password FROM usuarios WHERE id_usuario = '" . $_SESSION['id_usuario'] . "'");
            $passActual = $result->fetch_assoc();

            if (password_verify($passAntiguo, $passActual['password'])) {
                if ($passNuevo === $passNuevoRep) {
                    $passNuevoCifrado = password_hash($passNuevo, PASSWORD_DEFAULT);
                    $result = $db->query("UPDATE usuarios SET password = '$passNuevoCifrado' WHERE id_usuario = '" . $_SESSION['id_usuario'] . "'");
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public static function restablecerContraseña($db, $correo, $passNuevo, $passNuevoRep) {
        if ($passNuevo === $passNuevoRep) {
            $passNuevoCifrado = password_hash($passNuevo, PASSWORD_DEFAULT);
            $result = $db->query("UPDATE usuarios SET password = '$passNuevoCifrado' WHERE correo = '" . $correo . "'");
            return true;
        } else {
            return false;
        }
    }

    public static function obtenerUsuarioPorCorreo($db, $correo) {
        $correoSql = $db->real_escape_string($correo);

        $result = $db->query("SELECT * 
            FROM usuarios
            WHERE correo = '$correoSql'
        ");

        $existentes = $result->num_rows;
        $datosUser = $result->fetch_assoc();

        if ($existentes > 0) {
            return new Usuario($datosUser);
        }
        return false;
    }

    public static function obtenerUsuarioPorID($db, $id) {
        $result = $db->query("SELECT * 
            FROM usuarios
            WHERE id_usuario = '$id'
        ");

        $user = null;

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        }
        return $user;
    }
    
    public static function activarCuenta($db, $id) {
        $result = $db->query("UPDATE usuarios SET activado = 1 WHERE id_usuario = '" . $id . "'");
        if($result){
            return true;
        }else{
            return false;
        }
    }

}
