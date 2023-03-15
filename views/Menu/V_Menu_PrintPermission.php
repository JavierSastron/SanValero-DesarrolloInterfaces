<?php
    function printPermission($menu, $permissions) {
        $html = '<div id="allPermissionsContainer-'.$menu['id_Opcion'].'">';
        foreach ($permissions as $permission) {
            if ($menu['id_Opcion'] == $permission['id_Opcion']) {
                $html .= ' <div id="permissionContainer-'.$permission['id_Permiso'].'">
                           <br>
                           <span id="permissionText-'.$permission['id_Permiso'].'">-> '.$permission['permiso'].'</span>
                           <a><img class="editMenuIcon" src="imagenes/editPermission.png" onclick="getEditPermissionForm('.$permission['id_Permiso'].')"/></a>
                           <a><img class="editMenuIcon" src="imagenes/deletePermission.png" onclick="deletePermission('.$permission['id_Permiso'].')"/></a>
                           <div id="permissionEdit-'.$permission['id_Permiso'].'" class="menuForm"></div></div>';
            }
        }
        $html .= '</div>';
        return $html;
    }
    a
?>