<link rel="stylesheet" href="css/userList.css">

<?php
    //Variable data y viewRoute viene del archivo View.php

    //echo json_encode($data);
    $html = '
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">mail</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
        ';

    foreach ($data as $key => $user) {
        $html.='<tr>
                    <th scope="row">'.$user["id_Usuario"].'</th>
                    <td>'.$user["nombre"].'</td>
                    <td>'.$user["apellido_1"].'</td>
                    <td>'.$user["mail"].'</td>
                    <td><img src="imagenes/editar.png" class="functionIcon"
                            onclick="getView(\'Users\', \'userFormView\', \'bonus='.$user["id_Usuario"].'\' );"></td>
        ';
        if ($user["activo"] == "S") {
        $html.='<td><img src="imagenes/activo.png" class="functionIcon"
                            onclick="changeStatus(\'estado='.$user["activo"].'&id_Usuario='.$user["id_Usuario"].'\');"></td>';
        } else {
        $html.='<td><img src="imagenes/noactivo.png" class="functionIcon"
                            onclick="changeStatus(\'estado='.$user["activo"].'&id_Usuario='.$user["id_Usuario"].'\');"></td>';
        }
    }

    $html.='</tbody>
        </table>';
    echo $html;
?>
