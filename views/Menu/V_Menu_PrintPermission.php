<?php
function printPermission($menu, $data)
{
    $permissions = $data[1];
    $html = '<div id="allPermissionsContainer-' . $menu['id_Opcion'] . '">';
    foreach ($permissions as $permission) {
        if ($menu['id_Opcion'] == $permission['id_Opcion']) {
            $html .= ' <div id="permissionContainer-' . $permission['id_Permiso'] . '">
                           <br>
                           <span id="permissionText-' . $permission['id_Permiso'] . '">-> ' . $permission['permiso'] . '</span>';
            if (!isset($data[2]) && !isset($data[3])) {
                $html .= '<a><img class="editMenuIcon" src="imagenes/editPermission.png"
                                   onclick="getEditPermissionForm(' . $permission['id_Permiso'] . ')"/></a>
                           <a><img class="editMenuIcon" src="imagenes/deletePermission.png"
                                   onclick="deletePermission(' . $permission['id_Permiso'] . ')"/></a>
                           <div id="permissionEdit-' . $permission['id_Permiso'] . '" class="menuForm"></div>';
            }
            if (isset($data[2])) {
                $checked = '';
                foreach ($data[2] as $permissionRol) {
                    if ($permissionRol['id_Permiso'] == $permission['id_Permiso']) {
                        $checked = 'checked';
                    }
                }
                $html .= '<input type="checkbox" id="c-PermissionRole-'.$permission['id_Permiso'].'"class="ml-3"
                                onclick="changePermissionRole('.$permission['id_Permiso'].')"
                                '.$checked.'>';
            }
            if (isset($data[3])) {
                $checked = '';
                $roleRelated = '';
                foreach ($data[3] as $userPermission) {
                    if ($userPermission['id_Permiso'] == $permission['id_Permiso']) {
                        $checked = 'checked';
                        $roleRelated = $userPermission['rol'];
                    }

                }
                if ($roleRelated != '') {
                    $html .= '<a><img class="editMenuIcon mr-3" src="imagenes/checkboxOn.png"/>'.$roleRelated.'</a>';
                } else {
                    $html .= '<input type="checkbox" id="c-PermissionRole-'.$permission['id_Permiso'].'"class="ml-3"
                                onclick="changeUserPermission('.$permission['id_Permiso'].')"
                                '.$checked.'>';
                }
                
            }

            $html .= '</div>';
        }
    }
    $html .= '</div>';
    return $html;
}
?>