<?php

    function createUserList($userList) {
        $html = '<option value="">Usuarios...</option>';
        foreach ($userList as $user) {
            $html .= '<option value="'.$user['id_Usuario'].'">'.$user['login'].'</option>';
        }
        echo $html;
    }
?>