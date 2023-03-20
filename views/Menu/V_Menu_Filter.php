<script src=js/menu.js></script>
<?php
    require_once 'views/Menu/V_Menu_RoleList.php';
    require_once 'views/Menu/V_Menu_UserList.php';
?>
<form id="menuSearch" name="menuSearch">
    <br>
    <div>
        <h5 class="mb-4">Mantenimiento Menu</h5>

        <div id="container-menuOptions" class="col-lg-8">
            <div class="row">
                <div class="col-lg-3">
                    <p class="mb-0 pl-3">USUARIOS</p>
                    <select id="select-Users" class="custom-select col-lg-12 mb-2">
                        <?php
                            createUserList($data[0]);
                        ?>
                    </select>
                </div>
                <div class="col-lg-1 d-flex align-items-end pb-2 justify-content-around">
                    <a><img id="linkIcon" class="iconSize" src="imagenes/enlazarRolUsuario.png"
                            onclick="linkRoleToUser()"/></a>
                </div>
                <div class="col-lg-3">
                    <p class="mb-0 pl-3">ROLES</p>
                    <select id="select-Roles" class="custom-select col-lg-12 mb-2">
                        <?php
                            createRoleList($data[1]);
                        ?>
                    </select>
                </div>
                <div class="col-lg-1 d-flex align-items-end pb-2 justify-content-around">
                    
                    <a><img class="iconSize" src="imagenes/deletePermission.png" onclick="deleteRole()"></a>
                </div>

                <div class="col-lg-3 d-flex align-items-end pb-2">
                    <div>
                        <input type="text" id="i-roleName" class="form-control mr-3" placeholder="Rol">
                    </div>
                </div>
                <div class="col-lg-1 d-flex align-items-end pb-2">
                    <a><img class="iconSize" src="imagenes/addMenu.png" onclick="addRole()"></a>
                    <a><img class="iconSize" src="imagenes/editar.png" onclick="editRole()"></a>
                </div>
            </div>

        </div>
    </div>
    <div id="capaUserRoles" class="container-fluid"></div>

    <button type="button" class="btn btn-outline-dark mt-3 ml-3" onclick="searchMenu()">
        Buscar</button>
</form>

<br>
<div id="capaMenuResult" class="container-fluid"></div>