<?php
    require_once 'views/Menu/V_Menu_PrintMenu.php';
    foreach ($data[0] as $menu) {
        printConfigMenu($menu, $data);
    }
?>