<?php
    $permissionId = '';
    extract($data);
?>

<form id="f_editPermission" class="border col-sm-8">
    <div class="form-group">
        <input type="text" class="form-control"
            id="i-permissionName" placeholder="Nuevo nombre"/>
        <button type="button" class="btn btn-primary col-sm-5"
            onclick="editPermission(<?php echo $permissionId;?>)">
            Editar Nombre
        </button>
    </div>

</form>