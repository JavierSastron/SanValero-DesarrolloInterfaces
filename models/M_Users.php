<?php
require_once 'models/Model.php';
require_once 'models/DAO.php';

class M_Users extends Model {
    private $DAO;

    public function __construct() {
        parent::__construct();
        $this->DAO = new DAO();
    }

    public function searchUser($idUsuario) {
        $SQL = "SELECT * FROM usuarios WHERE ";
        $SQL .= "id_Usuario = ".$idUsuario;
        $user = $this->DAO->consult($SQL);
        return $user;
        //Fusionar con searchUsers
        //No mostrar Id
    }

    public function searchUsers($filter) {
        $fTexto = '';
        $fActivo = '';
        extract($filter);
        $users=array();

        $SQL = "SELECT * FROM usuarios WHERE 1=1 ";

        if($fActivo != '') {
            $SQL.=" AND activo='$fActivo' ";
        }
        if($fTexto != '') {
            $aTexto = explode(' ', $fTexto);
            $SQL.= " AND ( 1=2 ";
            foreach($aTexto as $word) {
                $SQL.=" OR nombre LIKE '%$word%'";
                $SQL.=" OR apellido_1 LIKE '%$word%'";
                $SQL.=" OR apellido_2 LIKE '%$word%'";
                $SQL.=" OR mail LIKE '%$word%' ";
            }
            $SQL.= " ) ";
        }
        $users = $this->DAO->consult($SQL);
        return $users;
    }

    public function insert($filter) {
        $fNombre = '';
        $fApellido_1 = '';
        $fApellido_2 = '';
        $fSexo = '';
        $fMail = '';
        $fMovil = '';
        $fLogin = '';
        $fPass = '';
        $fActivo = '';
        extract($filter);
        
        $SQL = "INSERT INTO usuarios (nombre, apellido_1, apellido_2, sexo, fecha_Alta, mail, movil, login, pass, activo)
                    VALUES ('$fNombre', '$fApellido_1', '$fApellido_2', '$fSexo', NULL,'$fMail', '$fMovil', '$fLogin', MD5('$fPass'), '$fActivo')";

        $this->DAO->insert($SQL);
    }

    public function update($filter) {
        $id_Usuario = '';
        $fNombre = '';
        $fApellido_1 = '';
        $fApellido_2 = '';
        $fSexo = '';
        $fMail = '';
        $fMovil = '';
        $fLogin = '';
        $fPass = '';
        $fActivo = '';
        extract($filter);

        $SQL = "UPDATE usuarios SET nombre='$fNombre', apellido_1='$fApellido_1', apellido_2='$fApellido_2',
                sexo='$fSexo', mail='$fMail', movil='$fMovil', login='$fLogin', pass='$fPass', activo='$fActivo'
                WHERE id_Usuario='$id_Usuario'";
        $this->DAO->update($SQL);
    }
    

    public function checkUser($user, $password) {
        $SQL = "SELECT * FROM usuarios WHERE login='$user'
         AND pass=MD5('$password')";
        $realUser = $this->DAO->consult($SQL);
        if(empty($realUser)) {
            return false;
        } else {
            return true;
        }
    }

    /* Change Status cambia el estado entre 'Activo' y 'No Activo' */
    public function changeStatus($parameters) {
        $estado='';
        $id_Usuario='';
        extract($parameters);
        $newEstado = $estado;

        if ($estado == 'S') {
            $newEstado = 'N';
        } else if($estado == 'N') {
            $newEstado = 'S';
        }

        $SQL = "UPDATE usuarios SET activo='$newEstado' WHERE id_Usuario='$id_Usuario'";
        $this->DAO->update($SQL);

    }

    /**
     * Función que devuelve true/false comprobando si existe ya ese login
     * $login = login que se revisa en la DB.
     */
    public function existLogin($login, $id_Usuario) {
        $SQL = "SELECT login FROM usuarios WHERE login='$login'";
        $loginInDB = $this->DAO->consult($SQL);
        foreach ($loginInDB as $dato) {
            if ($dato['login'] != null && $dato['id_Usuario'] == $id_Usuario) {
                return true;
            }
        }
        return false;

    }

}

?>