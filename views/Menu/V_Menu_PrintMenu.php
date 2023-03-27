<?php
require_once 'views/Menu/V_Menu_PrintPermission.php';

function printConfigMenu($menu, $data)
{
    $T_NAME = 'texto';
    $T_POSITION = 'id_Padre';
    $T_ORDER = 'orden';
    $T_ID = 'id_Opcion';
    $submenu = 'suboption';
    global $html;
    $html .= '<div id=menu-' . $menu[$T_POSITION] . '' . $menu[$T_ORDER] . '>';
    $classChild = '';

    // Añadir la clase CSS que diferencia a los hijos
    if ($menu[$T_POSITION] != 0) {
        $classChild = ' menuC';
    }

    // Interactuar con el menú
    if (!isset($data[2]) && !isset($data[3]) && isset($_SESSION['permissions'][$menu[$T_ID]])) {
        foreach ($_SESSION['permissions'][$menu[$T_ID]] as $permission) {
            if ($permission == 'crear') {
                $html .= '
                    <a><img class="newMenuIcon' . $classChild . '" src="imagenes/addMenu.png"
                        onclick="getFormMenu(' . $menu[$T_POSITION] . ',' . $menu[$T_ORDER] . ')"/></a>
                    <div id="menuForm-' . $menu[$T_POSITION] . '' . $menu[$T_ORDER] . '"
                        class="menuForm' . $classChild . '"></div>';
            }
        }   
    }

    $html .= '<li class="list-group-item' . $classChild . '">
        <span id="menuText-' . $menu[$T_POSITION] . '' . $menu[$T_ORDER] . '">' . $menu[$T_NAME] . '</span>';
    
    // Interaccciones con el menú
    if (!isset($data[2]) && !isset($data[3]) && isset($_SESSION['permissions'][$menu[$T_ID]])) {
        foreach ($_SESSION['permissions'][$menu[$T_ID]] as $permission) {
            if ($permission == 'editar') {
                $html .='<a><img class="editMenuIcon" src="imagenes/editar.png"
                        onclick="getFormMenu(' . $menu[$T_POSITION] . ',' . $menu[$T_ORDER] . ', \'Editar\')"/></a>';
            }
            if ($permission == 'cambiarEstado') {
                $html.= '<a><img class="editMenuIcon" src="imagenes/deletePermission.png"
                        onclick="deleteMenu(' . $menu[$T_POSITION] . ',' . $menu[$T_ORDER] . ')"/></a>';
            }
        }
    }
    
    $html .= printPermission($menu, $data);
    // Añadir permisos
    if (!isset($data[2]) && !isset($data[3])) {
        $html .= '  <br>
        <div newPermissionCont-' . $menu[$T_ID] . '>
            <form id="f_newPermission class="border col-sm-5">
                <div class="form-group">
                    <input type="text" class="form-control col-sm-2"
                        id="i-newPermissionName-' . $menu[$T_ID] . '"
                        placeholder="Nombre Permiso"/>
                    <button type="button" class="btn btn-primary col-sm-2"
                        onclick="newPermission(' . $menu[$T_ID] . ')">
                        Añadir Permiso
                    </button>
                </div>
            </form>
        </div>';
    }
    
    $html .= '</li></div>';

    // Si es padre y no tiene hijos crea el botón de añadir hijo
    if (!isset($data[2]) && !isset($data[3])) {
        if (!isset($menu[$submenu]) && $menu[$T_POSITION] == 0) {
            $lastSubmenu = '' . $menu[$T_ID] . '0';
            $html .=
                '<div id=menu-' . $lastSubmenu . '>
                        <a><img class="newMenuIcon menuC" src="imagenes/addMenu.png"
                                onclick="getFormMenu(' . $menu[$T_ID] . ', 0)"/></a>
                        <div id="menuForm-' . $lastSubmenu . '" class="menuForm menuC">
                        </div>
                    </div>';
        }
    }
    

    echo $html;
    $html = '';

    //Si tiene hijos imprimelos. Al final crea el botón de añadir hijo
    if (isset($menu[$submenu])) {
        foreach ($menu[$submenu] as $child) {
            printConfigMenu($child, $data);
        }

        $lastSubmenu = '' . $menu[$T_ID] . '0';
        if (!isset($data[2]) && !isset($data[3])) {
            echo '
            <div id=menu-' . $lastSubmenu . '>
                <a><img class="newMenuIcon menuC" src="imagenes/addMenu.png"
                        onclick="getFormMenu(' . $menu[$T_ID] . ', 0)"/></a><br>
                <div id="menuForm-' . $lastSubmenu . '" class="menuForm menuC">
                </div>
            </div>';
        }
    }
}

?>