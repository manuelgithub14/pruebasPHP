<?php

class Comentario {
    private $id;
    private $idUsuario;
    private $idArticulo;
    private $fecha;
    private $texto;
    private $respuesta;
    
    public function __construct($datos = []) {
        if (is_array($datos)) {
            foreach ($datos as $clave => $valor) {
                switch ($clave) {
                    case 'id_comentario':
                        $this->id = (int) $valor;
                        break;
                    default:
                        $this->$clave = $valor;
                }
            }
        }
    }
    
    // GETTERS
    function getId() {
        return $this->id;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getIdArticulo() {
        return $this->idArticulo;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getTexto() {
        return $this->texto;
    }
    
    function getRespuesta() {
        return $this->respuesta;
    }

    // SETTERS
    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    function setIdArticulo($idArticulo) {
        $this->idArticulo = $idArticulo;
        return $this;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
        return $this;
    }

    function setTexto($texto) {
        $this->texto = $texto;
        return $this;
    }
    
    function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
        return $this;
    }

        // FUNCIONES
    public function guardar($db) {
        $idUsuario = $db->real_escape_string($this->idUsuario);
        $idArticulo = $db->real_escape_string($this->idArticulo);
        if (!empty($this->fecha)) {
            $fecha = $db->real_escape_string($this->fecha);
            $fechaSql = date('Y-m-d', strtotime($fecha));
        }
        if(!empty($this->respuesta)){
            $respuesta = $db->real_escape_string($this->respuesta);
        }
        $texto = $db->real_escape_string($this->texto);
        $id = $db->real_escape_string($this->id);

        $consulta = (empty($this->id) ? "INSERT INTO" : "UPDATE" ) .
                " comentarios SET id_articulo = '$idArticulo',texto = '$texto'" . 
                (empty($this->fecha) ? "" : ",fecha = '$fechaSql'" ) . ",id_usuario = '$idUsuario'" .
                (empty($this->respuesta) ? "" : ",respuesta = '$respuesta'" ) .
                (empty($this->id) ? "" : " WHERE id_articulo = $id" );

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
    
    public static function obtenerComentariosPorIdArticulo($db, $idArticulo) {
        $idArticuloSql = $db->real_escape_string($idArticulo);
        
        $result = $db->query("SELECT * FROM comentarios WHERE id_articulo = '$idArticuloSql' AND respuesta IS NULL");
        $comentarios = [];

        if ($result) {
            while ($comentario = mysqli_fetch_assoc($result)) {
                $datos = [
                    'id' => $comentario['id_comentario'],
                    'idUsuario' => $comentario['id_usuario'],
                    'idArticulo' => $comentario['id_articulo'],
                    'fecha' => $comentario['fecha'],
                    'texto' => $comentario['texto']
                ];
                array_push($comentarios, new Comentario($datos));
            }
            return $comentarios;
        } else {
            return false;
        }
    }
    
    public static function obtenerRespuestasPorIdComentario($db, $idComentario) {
        $idComentarioSql = $db->real_escape_string($idComentario);
        
        $result = $db->query("SELECT * FROM comentarios WHERE respuesta = '$idComentarioSql'");
        $respuestas = [];

        if ($result) {
            while ($comentario = mysqli_fetch_assoc($result)) {
                $datos = [
                    'id' => $comentario['id_comentario'],
                    'idUsuario' => $comentario['id_usuario'],
                    'idArticulo' => $comentario['id_articulo'],
                    'fecha' => $comentario['fecha'],
                    'texto' => $comentario['texto'],
                    'respuesta' => $comentario['respuesta']
                ];
                array_push($respuestas, new Comentario($datos));
            }
            return $respuestas;
        } else {
            return false;
        }
    }
}
