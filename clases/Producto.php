<?php

class Producto {
    private $id;
    private $titulo;
    private $descripcion;
    private $referencia;
    private $imagen;
    private $precio;
    private $stock;
    
    public function __construct($datos = []) {
        if (is_array($datos)) {
            foreach ($datos as $clave => $valor) {
                switch ($clave) {
                    case 'id_producto':
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

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getPrecio() {
        return $this->precio;
    }
    
    public function getStock() {
        return $this->stock;
    }
        
    // SETTERS
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
        return $this;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setReferencia($referencia) {
        $this->referencia = $referencia;
        return $this;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
        return $this;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
        return $this;
    }
    
    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }
            
    // MÉTODOS
    public function guardar($db) {
        $titulo = $db->real_escape_string($this->titulo);
        $descripcion = $db->real_escape_string($this->descripcion);
        $referencia = $db->real_escape_string($this->referencia);
        $imagen = $db->real_escape_string($this->imagen);
        $precio = $db->real_escape_string($this->precio);
        $id = $db->real_escape_string($this->id);
        $stock = $db->real_escape_string($this->stock);

        $consulta = (empty($this->id) ? "INSERT INTO" : "UPDATE" ) .
                " productos SET titulo = '$titulo',descripcion = '$descripcion'" . 
                ",imagen = '$imagen',referencia = '$referencia',precio = '$precio',stock = '$stock'" .
                (empty($this->id) ? "" : " WHERE id_producto = $id" );

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
    
    public static function obtenerProductoPorTitulo($db, $titulo) {
        $tituloSql = $db->real_escape_string($titulo);

        $result = $db->query("SELECT * 
            FROM productos
            WHERE titulo = '$tituloSql'
        ");

        $existentes = $result->num_rows;
        $datosProducto = $result->fetch_assoc();

        if ($existentes > 0) {
            return new Articulo($datosProducto);
        }
        return false;
    }
    
    public static function obtenerProductoPorId($db, $id) {
        $idSql = $db->real_escape_string($id);

        $result = $db->query("SELECT * 
            FROM productos
            WHERE id_producto = '$idSql'
        ");

        $existentes = $result->num_rows;
        $datosProducto = $result->fetch_assoc();

        if ($existentes > 0) {
            return new Producto($datosProducto);
        }
        return false;
    }

    public static function obtenerProductos($db) {
        $result = $db->query("SELECT * FROM productos");
        $productos = [];

        if ($result) {
            while ($producto = mysqli_fetch_assoc($result)) {
                $datos = [
                    'id' => $producto['id_producto'],
                    'titulo' => $producto['titulo'],
                    'descripcion' => $producto['descripcion'],
                    'referencia' => $producto['referencia'],
                    'imagen' => $producto['imagen'],
                    'precio' => $producto['precio'],
                    'stock' => $producto['stock']
                ];
                array_push($productos, new Producto($datos));
            }
            return $productos;
        } else {
            return false;
        }
    }
    
    public static function obtenerProductosPaginados($db, $empieza, $por_pagina) {
        $empiezaSql = $db->real_escape_string($empieza);
        $por_paginaSql = $db->real_escape_string($por_pagina);
        $result = $db->query("SELECT * FROM productos LIMIT $por_paginaSql OFFSET $empiezaSql");
        $productos = [];

        if ($result) {
            while ($producto = mysqli_fetch_assoc($result)) {
                $datos = [
                    'id' => $producto['id_producto'],
                    'titulo' => $producto['titulo'],
                    'descripcion' => $producto['descripcion'],
                    'referencia' => $producto['referencia'],
                    'imagen' => $producto['imagen'],
                    'precio' => $producto['precio'],
                    'stock' => $producto['stock']
                ];
                array_push($productos, new Producto($datos));
            }
            return $productos;
        } else {
            return false;
        }
    }
}
