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
    public function getMenu($parameters) {
        $roleId = 'null';
        extract($parameters);
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
        $completeData[1] = $this->DAO->consult($SQL);
        if ($roleId != 'null') {
            $SQL = "SELECT * FROM permisosrol WHERE id_Rol = $roleId";
            $completeData[2] = $this->DAO->consult($SQL);
        }
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

    public function addPermissionsOnDB($parameters) {
        $menuId = '';
        $permissionName = '';
        extract($parameters);
        $SQL = "SELECT num_Permiso FROM permisos WHERE id_Opcion=$menuId ORDER BY num_Permiso DESC LIMIT 1";
        $tempNum = $this->DAO->consult($SQL);
        $nextNum = $tempNum[0]['num_Permiso'] + 1;
        $SQL = 'INSERT INTO permisos (id_Opcion, num_Permiso, permiso)
                    VALUES('.$menuId.', '.$nextNum.', "'.$permissionName.'")';
        $this->DAO->insert($SQL);
        $completeData = [];
        $SQL = "SELECT * FROM menus WHERE id_Opcion = $menuId";
        $completeData[0] = $this->DAO->consult($SQL);
        $SQL = "SELECT * FROM permisos WHERE id_Opcion = $menuId";
        $completeData[1] = $this->DAO->consult($SQL);
        return $completeData;
    }

    /**
     * Return required info to print 'V_Menu_Filter.php'
     */
    public function getFilterInfo() {
        $completeData = [];
        $SQL = "SELECT * FROM usuarios";
        $completeData[0] = $this->DAO->consult($SQL);
        $SQL = "SELECT * FROM roles";
        $completeData[1] = $this->DAO->consult($SQL);
        return $completeData;
    }

    public function addRoleOnDB($parameters) {
        $roleName = "";
        extract($parameters);
        $SQL = 'INSERT INTO roles (rol) VALUES ("'.$roleName.'")';
        $this->DAO->insert($SQL);
        $SQL = "SELECT * FROM roles";
        return $this->DAO->consult($SQL);
    }

    public function editRoleOnDB($parameters) {
        $roleId = '';
        $roleName = '';
        extract($parameters);
        echo $roleId;
        echo $roleName;
        $SQL = 'UPDATE roles SET rol="'.$roleName.'" WHERE id_Rol='.$roleId.'';
        $this->DAO->update($SQL);
        $SQL = "SELECT * FROM roles";
        return $this->DAO->consult($SQL);
    }

    public function deleteRoleOnDB($parameters) {
        $roleId = "";
        extract($parameters);
        $SQL = "DELETE FROM roles WHERE id_Rol = $roleId";
        $this->DAO->update($SQL);
        $SQL = "SELECT * FROM roles";
        return $this->DAO->consult($SQL);
    }

    public function linkRoleToUserInDB($parameters) {
        $roleId = "";
        $userId = "";
        extract($parameters);

        $SQL = "INSERT INTO rolesusuarios (id_Rol, id_Usuario) VALUES ($roleId, $userId)";
        $this->DAO->insert($SQL);
    }

    public function changePermissionRoleOnDB($parameters) {
        $isEnabled = '';
        $permissionId = '';
        $roleId = '';
        extract($parameters);
        if ($isEnabled == 'true') {
            $SQL = "INSERT INTO permisosrol (id_Permiso, id_Rol) VALUES ($permissionId, $roleId)";
            $this->DAO->insert($SQL);
        } else {
            $SQL = "DELETE FROM permisosrol WHERE id_Permiso = $permissionId AND id_Rol = $roleId";
            $this->DAO->update($SQL);
        }
    }
}
