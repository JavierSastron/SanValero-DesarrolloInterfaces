<?php

define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
//40-v&MQlPD221$)J
define('DB_NAME', '2si');
//id20494666_2si

class DAO {
    private $conexion;
    private $error;

    public function __construct() {
        $this->conexion = new mysqli(HOST, USER, PASS, DB_NAME);
        if($this->conexion->connect_errno) {
            //Ha ocurrido un error
            //die para la ejecución
            die('Error de conexion: '.$this->conexion->connect_errno);
        }
        //$this->error = '';
    }

    public function consult($SQL) {
        //Sentencia + datos recogidos
        $res = $this->conexion->query($SQL, MYSQLI_USE_RESULT);
        //Si la consulta no devuelve nada el array lo daria vacio
        $rows = array();
        if($this->conexion->connect_errno) {
            //Ha ocurrido un error
            //die para la ejecución
            die('Error al consultar: '.$this->conexion->connect_errno);
        } else {
            //reg es el dato que te devuelve para recorrer el bucle.
            //funcion te da el siguiente (Equivale a while (next))
            while($reg = $res->fetch_assoc()) {
                $rows[] = $reg;
            }
        }
        return $rows;
    }

    public function insert($SQL) {
        $this->conexion->query($SQL, MYSQLI_USE_RESULT);
        if($this->conexion->connect_errno) {
            die('Error consultando a BD: '.$SQL);
            return '';
        } else {
            return $this->conexion->insert_id;
        }
    }

    public function update($SQL) {
        $this->conexion->query($SQL, MYSQLI_USE_RESULT);
        if($this->conexion->connect_errno) {
            die('Error consultando a BD: '.$SQL);
            return '';
        } else {
            return $this->conexion->affected_rows;
        }
    }

}


?>