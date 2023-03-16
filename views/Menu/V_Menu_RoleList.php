<?php

    function createRoleList($roleList) {
        $html = '<option value="null">Roles...</option>';
        foreach ($roleList as $role) {
            $html .= '<option value="'.$role['id_Rol'].'">'.$role['rol'].'</option>';
        }
        echo $html;
    }
?>