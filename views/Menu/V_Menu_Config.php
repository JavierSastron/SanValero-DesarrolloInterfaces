<?php
    require_once 'views/Menu/V_Menu_PrintMenu.php';
    $html = '';

    $html .= '<div id=MenuConfig class="col-lg-8 col-md-8 col-sm-10">
              <ul class="list-group">';
    foreach ($data[0] as $menu) {
        printConfigMenu($menu, $data);
    }
    if (!isset($data[2])) {
        echo '
        <div id=menu-00>
                <a><img class="newMenuIcon" src="imagenes/addMenu.png" onclick="getFormMenu(0, 0)"/></a>
                <div id="menuForm-00" class="menuForm"></div>
            </div>
        </ul></div>';
    }

?>
<link rel="stylesheet" href="css/menu.css">
