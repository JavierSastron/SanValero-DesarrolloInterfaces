<?php

    function createRoleList($roleList) {
        $html = '<option value="">Roles...</option>';
        foreach ($roleList as $role) {
            $html .= '<option value="'.$role['rol'].'">'.$role['rol'].'</option>';
        }
        return $html;
    }
?>