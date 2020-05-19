<?php

class Articulo {

    private $id;
    private $titulo;
    private $texto;
    private $fecha;
    private $imagen;

    public function __construct($datos = []) {
        if (is_array($datos)) {
            foreach ($datos as $clave => $valor) {
                switch ($clave) {
                    case 'id_articulo':
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

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getImagen() {
        return $this->imagen;
    }

    // SETTERS
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    // MÉTODOS
    public function guardar($db) {
        $titulo = $db->real_escape_string($this->titulo);
        $texto = $db->real_escape_string($this->texto);
        if (!empty($this->fecha)) {
            $fecha = $db->real_escape_string($this->fecha);
            $fechaSql = date('Y-m-d', strtotime($fecha));
        }
        $imagen = $db->real_escape_string($this->imagen);
        $id = $db->real_escape_string($this->id);

        $consulta = (empty($this->id) ? "INSERT INTO" : "UPDATE" ) .
                " articulos SET titulo = '$titulo',texto = '$texto'" . 
                (empty($this->fecha) ? "" : ",fecha = '$fechaSql'" ) . ",imagen = '$imagen'" .
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

    public static function obtenerArticuloPorTitulo($db, $titulo) {
        $tituloSql = $db->real_escape_string($titulo);

        $result = $db->query("SELECT * 
            FROM articulos
            WHERE titulo = '$tituloSql'
        ");

        $existentes = $result->num_rows;
        $datosArticulo = $result->fetch_assoc();

        if ($existentes > 0) {
            return new Articulo($datosArticulo);
        }
        return false;
    }
    
    public static function obtenerArticuloPorId($db, $id) {
        $idSql = $db->real_escape_string($id);

        $result = $db->query("SELECT * 
            FROM articulos
            WHERE id_articulo = '$idSql'
        ");

        $existentes = $result->num_rows;
        $datosArticulo = $result->fetch_assoc();

        if ($existentes > 0) {
            return new Articulo($datosArticulo);
        }
        return false;
    }

    public static function obtenerArticulos($db) {
        $result = $db->query("SELECT * FROM articulos");
        $articulos = [];

        if ($result) {
            while ($articulo = mysqli_fetch_assoc($result)) {
                $datos = [
                    'id' => $articulo['id_articulo'],
                    'titulo' => $articulo['titulo'],
                    'texto' => $articulo['texto'],
                    'fecha' => $articulo['fecha'],
                    'imagen' => $articulo['imagen'],
                ];
                array_push($articulos, new Articulo($datos));
            }
            return $articulos;
        } else {
            return false;
        }
    }
    
    public static function obtenerArticulosPaginados($db, $empieza, $por_pagina) {
        $empiezaSql = $db->real_escape_string($empieza);
        $por_paginaSql = $db->real_escape_string($por_pagina);
        $result = $db->query("SELECT * FROM articulos LIMIT $por_paginaSql OFFSET $empiezaSql");
        $articulos = [];

        if ($result) {
            while ($articulo = mysqli_fetch_assoc($result)) {
                $datos = [
                    'id' => $articulo['id_articulo'],
                    'titulo' => $articulo['titulo'],
                    'texto' => $articulo['texto'],
                    'fecha' => $articulo['fecha'],
                    'imagen' => $articulo['imagen'],
                ];
                array_push($articulos, new Articulo($datos));
            }
            return $articulos;
        } else {
            return false;
        }
    }

}
