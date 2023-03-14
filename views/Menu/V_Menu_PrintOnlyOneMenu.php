<?php
    require_once 'views/Menu/V_Menu_PrintMenu.php';
    foreach ($data as $menu) {
        printConfigMenu($menu);
    }
?>