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
        $userId = 'null';
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
        if (($roleId == 'null' && $userId == 'null') ||($roleId != 'null' && $userId != 'null')) {
            //todo
            $SQL = "";
        } elseif ($roleId != 'null') {
            $SQL = "SELECT * FROM permisosrol WHERE id_Rol = $roleId";
            $completeData[2] = $this->DAO->consult($SQL);
        } elseif ($userId != '') {
            $SQL = "SELECT * FROM permisosusuario WHERE id_Usuario = $userId";
            $completeData[4] = $this->DAO->consult($SQL);
            $SQL = "SELECT DISTINCT permisos.id_Permiso, roles.rol
                    FROM usuarios
                    JOIN rolesusuarios ON usuarios.id_Usuario = rolesusuarios.id_Usuario
                    JOIN permisosrol ON rolesusuarios.id_Rol = permisosrol.id_Rol
                    JOIN permisos ON permisosrol.id_Permiso = permisos.id_Permiso
                    JOIN roles ON permisosrol.id_Rol = roles.id_Rol
                    WHERE usuarios.id_Usuario = $userId";
            $permByRole = $this->DAO->consult($SQL);
            $SQL = "SELECT id_Permiso FROM permisosusuario WHERE id_Usuario = $userId";
            $userPerms = $this->DAO->consult($SQL);
            $allPerms = [];
            foreach ($userPerms as $userPerm) {
                $allPerms[$userPerm['id_Permiso']] = [
                    'id_Permiso' => $userPerm['id_Permiso'],
                    'rol' => '',
                ];
            }

            foreach ($permByRole as $perm) {
                $allPerms[$perm['id_Permiso']] = [
                    'id_Permiso' => $perm['id_Permiso'],
                    'rol' => $perm['rol'],
                ];
            }
            $completeData[3] = $allPerms;
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

    public function unlinkRoleToUserInDB($parameters) {
        $roleId = "";
        $userId = "";
        extract($parameters);

        $SQL = "DELETE FROM rolesusuarios WHERE id_Rol = $roleId AND id_Usuario = $userId";
        $this->DAO->update($SQL);
    }

    public function getUserRoles($parameters) {
        $userId = '';
        extract($parameters);
        $SQL = "SELECT ro.id_Rol, r.rol
                FROM rolesusuarios ro
                JOIN roles r ON ro.id_Rol = r.id_Rol
                WHERE ro.id_Usuario = $userId";
        return $this->DAO->consult($SQL);
    }

    public function isRoleSet($parameters) {
        $userId = '';
        $roleId = '';
        extract($parameters);
        $SQL = "SELECT * FROM rolesusuarios
                WHERE id_Rol = $roleId AND id_Usuario = $userId";
        $userRole = $this->DAO->consult($SQL);
        if (count($userRole) != 0) {
            return 'true';
        } else {
            return 'false';
        }
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

    public function changeUserPermissionOnDB($parameters) {
        $isEnabled = '';
        $permissionId = '';
        $userId = '';
        extract($parameters);
        if ($isEnabled == 'true') {
            $SQL = "INSERT INTO permisosusuario (id_Permiso, id_Usuario) VALUES ($permissionId, $userId)";
            $this->DAO->insert($SQL);
        } else {
            $SQL = "DELETE FROM permisosusuario WHERE id_Permiso = $permissionId AND id_Usuario = $userId";
            $this->DAO->update($SQL);
        }
    }
}
