function searchMenu() {
    let parameters='&controller=Menu&method=getConfigMenu';

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('#capaMenuResult').html(view);
        }
    })
}

function getFormMenu(id_Padre, orden, funcion) {
    let parameters='&controller=Menu&method=getFormMenuView'
                    +'&id_Padre='+id_Padre+'&orden='+orden+'&funcion='+funcion
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('.menuForm').html('');
            $('#menuForm-'+id_Padre+orden).html(view);
        }
    })

}

//Check Parameters: To do
function editMenu(id_Padre, orden) {
    let newName = document.getElementById('i-menuName').value
    let newAmbito = document.getElementById('i-menuRol').value
    let newUrl = document.getElementById('i-menuFunction').value
    let id_Opcion = document.getElementById('id_Opcion').value
    let parameters = '&controller=Menu&method=editMenu&id_Padre='+id_Padre
                +'&orden='+orden+'&name='+newName+'&ambito='+newAmbito+'&url='+newUrl
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('#menuText-'+id_Padre+orden).html(newName)
            $('#menuForm-'+id_Padre+orden).html('');
        }
    })
}

//Check Parameters: To do
function newMenu(id_Padre, orden) {
    let newName = document.getElementById('i-menuName').value
    let newAmbito = document.getElementById('i-menuRol').value
    let newUrl = document.getElementById('i-menuFunction').value
    let id_Opcion = document.getElementById('id_Opcion').value
    let parameters = '&controller=Menu&method=newMenu&id_Padre='+id_Padre
                +'&orden='+orden+'&name='+newName+'&ambito='+newAmbito
                +'&url='+newUrl+'&id_Opcion='+id_Opcion
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('#menu-'+id_Padre+orden).before(view);
            $('#menuForm-'+id_Padre+orden).html('');
        }
    })
}

function getEditPermissionForm(permissionId) {
    let parameters = '&controller=Menu&method=getPermissionForm'
            +'&permissionId='+permissionId
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('.menuForm').html('');
            $('#permissionEdit-'+permissionId).html(view);
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
        success: function(view) {
            $('.menuForm').html('');
            $('#permissionText-'+permissionId).html('-> ' + newName);
        }
    })
}

function deletePermission(permisionId) {

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('#menu-'+id_Padre+orden).before(view);
            $('#menuForm-'+id_Padre+orden).html('');
        }
    })
}