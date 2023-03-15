<script src=js/menu.js></script>
<?php

?>
<form id="menuSearch" name="menuSearch">
    <br>
    <div>
        <h5 class="mb-4">Mantenimiento Menu</h5>

        <div id="container-menuOptions" class="col-lg-8">
            <div class="row">

                <div class="col-lg-2">
                    <p class="mb-0 pl-3">USUARIOS</p>
                    <select class="custom-select col-lg-12 mb-2">
                        <option value="null">Usuarios...</option>
                    </select>
                </div>
                <div class="col-lg-1 d-flex align-items-bottom pb-2">
                    <a><img class="iconSize" src="imagenes/enlazarRolUsuario.png" /></a>
                </div>
                <div class="col-lg-2">
                    <p class="mb-0 pl-3">ROLES</p>
                    <select class="custom-select col-lg-12 mb-2">
                        <option value="null">Roles...</option>
                    </select>
                </div>
                <div class="col-lg-2 d-flex align-items-bottom pb-2 justify-content-around">
                    <a><img class="iconSize" src="imagenes/addMenu.png"></a>
                    <a><img class="iconSize" src="imagenes/editar.png"></a>
                    <a><img class="iconSize" src="imagenes/deletePermission.png"></a>
                </div>

                <div class="col-lg-2 d-flex align-items-bottom pb-2">
                    <div class="row">
                        <input type="text" class="form-control mr-3" placeholder="Rol">
                    </div>
                </div>
                <div class="col-lg-1 d-flex align-items-bottom pb-2">

                    <a><img class="iconSize" src="imagenes/aceptar.png"></a>
                </div>
            </div>

        </div>
    </div>

    <button type="button" class="btn btn-outline-dark mt-3 ml-3" onclick="searchMenu()">
        Buscar</button>
</form>
<br>
<div id="capaMenuResult" class="container-fluid"></div>