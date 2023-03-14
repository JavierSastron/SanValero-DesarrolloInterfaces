<?php

    function printConfigMenu($menu, $permissions) {
        $T_NAME = 'texto';
        $T_POSITION = 'id_Padre';
        $T_ORDER = 'orden';
        $T_ID = 'id_Opcion';
        $submenu = 'suboption';
        global $html;
        //Meter botón que hace aparecer el div de abajo
        $html .= '<div id=menu-'.$menu[$T_POSITION].''.$menu[$T_ORDER].'>';
        if ($menu[$T_POSITION] == 0) {
            $html .= '
                      <a><img class="newMenuIcon" src="imagenes/addMenu.png" onclick="getFormMenu('.$menu[$T_POSITION].','.$menu[$T_ORDER].')"/></a>
                      <div id="menuForm-'.$menu[$T_POSITION].''.$menu[$T_ORDER].'" class="menuForm"></div>
                      <li  class="list-group-item">
                      <span id="menuText-'.$menu[$T_POSITION].''.$menu[$T_ORDER].'">'.$menu[$T_NAME].'</span>
                      <a><img class="editMenuIcon" src="imagenes/editar.png" onclick="getFormMenu('.$menu[$T_POSITION].','.$menu[$T_ORDER].', \'Editar\')"/></a>';
            foreach ($permissions as $permission) {
                if ($menu[$T_ID] == $permission[$T_ID]) {
                    $html .= ' <div id="permissionContainer-'.$permission['id_Permiso'].'">
                               <br>
                               <span id="permissionText-'.$permission['id_Permiso'].'">-> '.$permission['permiso'].'</span>
                               <a><img class="editMenuIcon" src="imagenes/editPermission.png" onclick="getEditPermissionForm('.$permission['id_Permiso'].')"/></a>
                               <a><img class="editMenuIcon" src="imagenes/deletePermission.png" onclick="deletePermission('.$permission['id_Permiso'].')"/></a>
                               <div id="permissionEdit-'.$permission['id_Permiso'].'" class="menuForm"></div></div>';
                }
            }
            $html .= '</li></div>';
            if ( !isset($menu[$submenu]) ) {
                $lastSubmenu = ''.$menu[$T_ID].'0';
                $html.=
                '<div id=menu-'.$lastSubmenu.'>
                    <a><img class="newMenuIcon menuC" src="imagenes/addMenu.png" onclick="getFormMenu('.$menu[$T_ID].', 0)"/></a>
                    <div id="menuForm-'.$lastSubmenu.'" class="menuForm menuC">
                    </div>
                </div>';
            }
        } else {
            $html .= '<a><img class="newMenuIcon menuC" src="imagenes/addMenu.png" onclick="getFormMenu('.$menu[$T_POSITION].', '.$menu[$T_ORDER].')"/></a>
                      <div id="menuForm-'.$menu[$T_POSITION].''.$menu[$T_ORDER].'" class="menuForm menuC"></div>
                      <li class="menuC list-group-item">
                        <span id="menuText-'.$menu[$T_POSITION].''.$menu[$T_ORDER].'">'.$menu[$T_NAME].'</span>
                        <a><img class="editMenuIcon" src="imagenes/editar.png" onclick="getFormMenu('.$menu[$T_POSITION].','.$menu[$T_ORDER].', \'Editar\')"/></a>';
            foreach ($permissions as $permission) {
                if ($menu[$T_ID] == $permission[$T_ID]) {
                    $html .= ' <div id="permissionContainer-'.$permission['id_Permiso'].'">
                               <br>
                               <span id="permissionText-'.$permission['id_Permiso'].'">-> '.$permission['permiso'].'</span>
                               <a><img class="editMenuIcon" src="imagenes/editPermission.png" onclick="getEditPermissionForm('.$permission['id_Permiso'].')"/></a>
                               <a><img class="editMenuIcon" src="imagenes/deletePermission.png" onclick="deletePermission('.$permission['id_Permiso'].')"/></a>
                               <div id="permissionEdit-'.$permission['id_Permiso'].'" class="menuForm"></div></div>';
                }
            }
            $html .= '</li>
                      </div>';
        }

        echo $html;
        $html = '';

        if (isset($menu[$submenu])) {
            foreach ($menu[$submenu] as $child) {
                printConfigMenu($child, $permissions);
            }
            //boton abajo
            $lastSubmenu = ''.$menu[$T_ID].'0';
            echo '
                <div id=menu-'.$lastSubmenu.'>
                    <a><img class="newMenuIcon menuC" src="imagenes/addMenu.png" onclick="getFormMenu('.$menu[$T_ID].', 0)"/></a><br>
                    <div id="menuForm-'.$lastSubmenu.'" class="menuForm menuC">
                    </div>
                </div>';
        }
    }

?>
