<?php
    require_once 'views/Menu/V_Menu_PrintPermission.php';
    $html = '';
    $html .= printPermission($data[0][0], $data[1]);
    echo $html;
?>