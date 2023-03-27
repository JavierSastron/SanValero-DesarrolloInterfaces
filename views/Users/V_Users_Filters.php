<script src=js/users.js></script>
<?php

?>
<form id="formSearch" name="formSearch">
    <br>
    <label for="fTexto">Introduce un Nombre: </label></br>
    <input type="text" id="fTexto" name="fTexto" class="form-control"
            placeholder="Escribe aquí" value=""/>
    <br>
    <label for="fActivo">Actico/No Activo</label></br>
    <select id="fActivo" name="fActivo" class="form-control">
        <option value="">Todos</option>
        <option value="S" selected>Activo</option>
        <option value="N">No activo</option>
    </select>
    <br>
    <button type="button" class="btn btn-outline-dark" onclick="search()">
            Buscar Usuarios</button>
    <?php
        if (isset($_SESSION['permissions'][3])) {
                foreach ($_SESSION['permissions'][3] as $permission) {
                        if ($permission == 'crear') {
                                ?>
                                <button type="button" class="btn btn-outline-dark" onclick="getView('Users', 'userFormView')">
                                Nuevo Usuario</button>
                                <?php
                        }
                }
        }
    ?>
    
</form>
<br>
<div id="capaSearchResult" class="container-fluid"></div>