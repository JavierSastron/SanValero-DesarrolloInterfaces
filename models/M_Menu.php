<?php
require_once 'models/Model.php';
require_once 'models/DAO.php';

class M_Menu extends Model {
    private $DAO;

    public function __construct() {
        parent::__construct();
        $this->DAO = new DAO();
    }

    /**
     * Obtener lista menú ordenada
     */
    public function getMenu() {
        $SQL = "SELECT * FROM menus
                 ORDER BY id_Padre, orden";
        
        $menu = $this->DAO->consult($SQL);
        $rightMenu = [];
        foreach($menu as $option) {
            if ($option['id_Padre'] == 0) {
                $rightMenu[$option['id_Opcion']] = $option;
            } else {
                $rightMenu[$option['id_Padre']]['suboption'][$option['id_Opcion']] = $option;
            }
        }
        $completeData = [];
        $completeData[0] = $rightMenu;
        $SQL = "SELECT * FROM permisos ORDER BY id_Opcion, num_Permiso";
        $permissions = $this->DAO->consult($SQL);
        $completeData[1] = $permissions;
        return $completeData;
    }

    public function getMenuByPosition($id_Padre, $orden) {
        $SQL = "SELECT * FROM menus WHERE id_Padre=$id_Padre AND orden=$orden";
        return $this->DAO->consult($SQL);
    }

    public function getMenuFormByPosition($id_Padre, $orden) {
        $SQL = "SELECT id_Opcion, id_Padre, orden FROM menus WHERE id_Padre=$id_Padre AND orden=$orden";
        return $this->DAO->consult($SQL);
    }

    public function editMenuInDB($parameters) {
        $id_Padre = '';
        $orden = '';
        $name = '';
        $ambito = '';
        $url = '';
        extract($parameters);
        $SQL = 'UPDATE menus SET texto="'.$name.'", ambito="'.$ambito.'", url="'.$url.'" WHERE id_Padre='.$id_Padre.' AND orden='.$orden.'';
        $this->DAO->update($SQL);
    }

    public function newMenuInDB($parameters) {
        $name = '';
        $ambito = '';
        $url = '';
        $id_Padre = '';
        $orden = '';
        extract($parameters);
        if ($orden == 0) {
            $SQL = "SELECT orden FROM menus WHERE id_Padre = $id_Padre ORDER BY orden DESC LIMIT 1";
            $tempMenu = $this->DAO->consult($SQL);
            if ($tempMenu != null) {
                $orden = $tempMenu[0]['orden'] + 1;
            }
        }
        $SQL = "UPDATE menus SET orden = orden+1 WHERE orden >= $orden AND id_Padre = $id_Padre";
        $this->DAO->update($SQL);
        $SQL = "INSERT INTO menus (texto, url, id_Padre, orden, ambito)
                 VALUES ('$name', '$url', $id_Padre, $orden, '$ambito')";
        
        $newIdGenerated = $this->DAO->insert($SQL);
        $SQL = "INSERT INTO permisos (id_Opcion, num_Permiso, permiso)
                    VALUES ($newIdGenerated, 1, 'consultar'),
                           ($newIdGenerated, 2, 'editar'),
                           ($newIdGenerated, 3, 'crear'),
                           ($newIdGenerated, 4, 'modificar'),
                           ($newIdGenerated, 5, 'cambiarEstado')";
        $this->DAO->insert($SQL);
        $SQL = "SELECT * FROM menus WHERE id_Opcion=$newIdGenerated";
        $completeData = [];
        $completeData[0] = $this->DAO->consult($SQL);
        $SQL = "SELECT * FROM permisos WHERE id_Opcion=$newIdGenerated";
        $completeData[1] = $this->DAO->consult($SQL);
        return $completeData;
    }

    public function editPermissionOnDB($parameters) {
        $permissionId = '';
        $newName = '';
        extract($parameters);
        $SQL = 'UPDATE permisos SET permiso = "'.$newName.'" WHERE id_Permiso = '.$permissionId.'';
        $this->DAO->update($SQL);
    }
    
    public function deletePermissionOnDB($parameters) {
        $permissionId = '';
        extract($parameters);
        $SQL = 'DELETE FROM permisos WHERE id_Permiso='.$permissionId.'';
        $this->DAO->update($SQL);
    }
}
