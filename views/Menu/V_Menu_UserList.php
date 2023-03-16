<?php

    function createUserList($userList) {
        $html = '<option value="">Usuarios...</option>';
        foreach ($userList as $user) {
            $html .= '<option value="'.$user['login'].'">'.$user['login'].'</option>';
        }
        return $html;
    }
?>