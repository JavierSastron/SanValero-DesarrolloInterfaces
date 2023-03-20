<?php
    $html = '<div>
            <h5>Lista de Roles:</h5>';

    foreach ($data as $role) {
        $html .= '<p> -> '.$role['rol'].'</p>';
    }

    $html .= '</div>';
    echo $html;
?>