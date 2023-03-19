/**
 *  Opciones relacionadas con Menus
 */

function searchMenu() {
    let roleId = document.getElementById('select-Roles').value
    let userId = document.getElementById('select-Users').value
    let parameters = '&controller=Menu&method=getConfigMenu'
        + '&roleId=' + roleId + '&userId=' + userId;
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#capaMenuResult').html(view);
        }
    })
}

function getFormMenu(id_Padre, orden, funcion) {
    let parameters = '&controller=Menu&method=getFormMenuView'
        + '&id_Padre=' + id_Padre + '&orden=' + orden + '&funcion=' + funcion
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('.menuForm').html('');
            $('#menuForm-' + id_Padre + orden).html(view);
        }
    })

}

function editMenu(id_Padre, orden) {
    let newName = document.getElementById('i-menuName').value
    let newAmbito = document.getElementById('i-menuRol').value
    let newUrl = document.getElementById('i-menuFunction').value
    let parameters = '&controller=Menu&method=editMenu&id_Padre=' + id_Padre
        + '&orden=' + orden + '&name=' + newName + '&ambito=' + newAmbito + '&url=' + newUrl
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#menuText-' + id_Padre + orden).html(newName)
            $('#menuForm-' + id_Padre + orden).html('');
        }
    })
}

function newMenu(id_Padre, orden) {
    let newName = document.getElementById('i-menuName').value
    let newAmbito = document.getElementById('i-menuRol').value
    let newUrl = document.getElementById('i-menuFunction').value
    let id_Opcion = document.getElementById('id_Opcion').value
    let parameters = '&controller=Menu&method=newMenu&id_Padre=' + id_Padre
        + '&orden=' + orden + '&name=' + newName + '&ambito=' + newAmbito
        + '&url=' + newUrl + '&id_Opcion=' + id_Opcion
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#menu-' + id_Padre + orden).before(view);
            $('#menuForm-' + id_Padre + orden).html('');
        }
    })
}

function deleteMenu(id_Padre, orden) {
    let parameters = '&controller=Menu&method=deleteMenu&id_Padre=' + id_Padre
        + '&orden=' + orden

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#menu-' + id_Padre + orden).remove();
        }
    })

}

/**
 *  Opciones relacionadas con Permisos
 */

function getEditPermissionForm(permissionId) {
    let parameters = '&controller=Menu&method=getPermissionForm'
        + '&permissionId=' + permissionId
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('.menuForm').html('');
            $('#permissionEdit-' + permissionId).html(view);
        }
    })
}

function editPermission(permissionId) {
    let newName = document.getElementById('i-permissionName').value
    let parameters = '&controller=Menu&method=editPermission'
        + '&newName=' + newName + '&permissionId=' + permissionId
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('.menuForm').html('');
            $('#permissionText-' + permissionId).html('-> ' + newName);
        }
    })
}

function deletePermission(permissionId) {
    let parameters = '&controller=Menu&method=deletePermission'
        + '&permissionId=' + permissionId

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#permissionContainer-' + permissionId).remove();
        }
    })
}

function newPermission(menuId) {
    let newPermissionName = document.getElementById('i-newPermissionName-' + menuId).value
    let parameters = '&controller=Menu&method=newPermission'
        + '&menuId=' + menuId + '&permissionName=' + newPermissionName

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#allPermissionsContainer-' + menuId).html(view);
        }
    })
}

/**
 *  Opciones relacionadas con Roles
 */

function addRole() {
    let roleName = document.getElementById('i-roleName').value
    if (roleName == "") {
        return
    }
    let parameters = '&controller=Menu&method=addRole'
        + '&roleName=' + roleName

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#select-Roles').html(view);
            $('#i-roleName').val("");
        }
    })

}

function editRole() {
    let roleId = document.getElementById('select-Roles').value
    if (roleId == "null") {
        return
    }
    let newRoleName = document.getElementById('i-roleName').value
    if (newRoleName == "") {
        return
    }
    let parameters = '&controller=Menu&method=editRole'
        + '&roleId=' + roleId + '&roleName=' + newRoleName

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#select-Roles').html(view);
            $('#i-roleName').val("");
        }
    })
}

function deleteRole() {
    let roleId = document.getElementById("select-Roles").value
    if (roleId == "") {
        return
    }
    let parameters = '&controller=Menu&method=deleteRole'
        + '&roleId=' + roleId

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {
            $('#select-Roles').html(view);
            $('#i-roleName').val("");
        }
    })
}

document.getElementById('select-Roles').addEventListener("change", function () {
    let roleName = $('#select-Roles option:selected').html();
    $('#i-roleName').val(roleName);
})

/**
 * rolesusuarios
 */

function linkRoleToUser() {
    if (document.getElementById('select-Users') == "") {
        return
    }
    if (document.getElementById('select-Roles') == "") {
        return
    }

    let roleId = document.getElementById('select-Roles').value
    let userId = document.getElementById('select-Users').value
    let parameters = '&controller=Menu&method=linkRoleToUser'
        + '&roleId=' + roleId + '&userId=' + userId

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {

        }
    })

}

/**
 * permisosrol
 */
function changePermissionRole(permissionId) {
    let isEnabled = 'false'
    if ($('#c-PermissionRole-' + permissionId).is(':checked')) {
        isEnabled = 'true'
    }
    let roleId = document.getElementById('select-Roles').value;
    let parameters = '&controller=Menu&method=changePermissionRole'
        + '&isEnabled=' + isEnabled + '&permissionId=' + permissionId
        + '&roleId='+roleId

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function (view) {

        }
    })
}