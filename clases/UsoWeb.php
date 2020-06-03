<?php

class UsoWeb {

    private $id;
    private $ip;
    private $urlSolicitada;
    private $fechaHora;
    private $idUsuario;
    private $userAgent;
    private $urlReferencia;

    public function __construct($datos = []) {
        if (is_array($datos)) {
            foreach ($datos as $clave => $valor) {
                switch ($clave) {
                    case 'id_uso_web':
                        $this->id = (int) $valor;
                        break;
                    case 'id_usuario':
                        $this->idUsuario = (int) $valor;
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

    function getIp() {
        return $this->ip;
    }

    function getUrlSolicitada() {
        return $this->urlSolicitada;
    }

    function getFechaHora() {
        return $this->fechaHora;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getUserAgent() {
        return $this->userAgent;
    }

    function getUrlReferencia() {
        return $this->urlReferencia;
    }

    // SETTERS
    function setIp($ip) {
        $this->ip = $ip;
        return $this;
    }

    function setUrlSolicitada($urlSolicitada) {
        $this->urlSolicitada = $urlSolicitada;
        return $this;
    }

    function setFechaHora($fechaHora) {
        $this->fechaHora = $fechaHora;
        return $this;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    function setUserAgent($userAgent) {
        $this->userAgent = $userAgent;
        return $this;
    }

    function setUrlReferencia($urlReferencia) {
        $this->urlReferencia = $urlReferencia;
        return $this;
    }

    // MÉTODOS
    public function guardar($db) {
        $ip = $db->real_escape_string($this->ip);
        $this->urlSolicitada = $db->real_escape_string($this->urlSolicitada);
        if (!empty($this->fechaHora)) {
            $fecha = $db->real_escape_string($this->fechaHora);
            $fechaSql = date('Y-m-d', strtotime($fecha));
        }
        $idUsuario = $db->real_escape_string($this->idUsuario);
        $id = $db->real_escape_string($this->id);
        $userAgent = $db->real_escape_string($this->userAgent);
        $urlReferencia = $db->real_escape_string($this->urlReferencia);

        $consulta = (empty($this->id) ? "INSERT INTO" : "UPDATE" ) .
                " usoweb SET ip = '$ip',url_solicitada = '$this->urlSolicitada'" .
                (empty($this->fecha) ? "" : ",fecha = '$fechaSql'" ) . ",user_agent = '$userAgent'" .
                (empty($this->idUsuario) ? "" : ",id_usuario = '$idUsuario'" ) . ",url_referencia = '$urlReferencia'" .
                (empty($this->id) ? "" : " WHERE id_uso_web = $id" );

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

    public static function obtenerVisitasPaginasEntreFechas($db, $fechaIni, $fechaFin) {
        $result = $db->query("SELECT COUNT(url_solicitada) AS numVisitas, SUBSTRING_INDEX(url_solicitada,'?',1) AS pagina "
                . "FROM usoweb WHERE fecha_hora BETWEEN '$fechaIni' AND '$fechaFin' GROUP BY pagina");
        $paginas = [];

        if ($result) {
            while ($paginaVisitada = mysqli_fetch_assoc($result)) {
                $infoVisitas = new stdClass();
                
                $infoVisitas->pagina = $paginaVisitada['pagina'];
                $infoVisitas->numVisitas = $paginaVisitada['numVisitas'];
                
                array_push($paginas, $infoVisitas);
            }
            return $paginas;
        } else {
            return false;
        }
    }
    
    public static function obtenerUsoNavegadores($db) {
        $result = $db->query("SELECT COUNT(user_agent) AS numUso, user_agent AS navegador FROM usoweb GROUP BY user_agent");
        $navegadores = [];

        if ($result) {
            while ($unNavegador = mysqli_fetch_assoc($result)) {
                $infoNavegadores = new stdClass();
                $traduccionNavegador = new WhichBrowser\Parser($unNavegador['navegador']);
                
                $infoNavegadores->navegador = $traduccionNavegador->browser->toString();
                $infoNavegadores->numUso = $unNavegador['numUso'];
                
                array_push($navegadores, $infoNavegadores);
            }
            return $navegadores;
        } else {
            return false;
        }
    }
}
