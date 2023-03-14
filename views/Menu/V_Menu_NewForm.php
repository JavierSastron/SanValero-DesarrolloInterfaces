<?php
$texto = '';
$ambito = '';
$url = '';
$id_Opcion = '';
$id_Padre = '';
$orden = '';

$menu = array();
extract($data);

if (isset($menu[0])) {
    extract($menu[0]);
}

?>

<form id="f-newMenu" class="f-newMenu border col-sm-8">
    <input id="id_Opcion" class="d-none" value="<?php echo $id_Opcion?>"></input>
    <div class="form-group">
        <label for="i-menuName" class="col-sm-11 col-form-label">Nombre:</label>
        <div class="col-sm-11">
            <input type="text" class="form-control" id="i-menuName" value="<?php echo $texto ?>">
        </div>
    </div>
    <div class="form-group col-sm-11">
        <label for="i-menuRol" class="col-sm-11 col-form-label">Ámbito:</label>
        <select class="custom-select " id="i-menuRol">
            <option value="publico">Público</option>
            <option value="admin" <?php if ( $ambito == 'admin' ) { echo 'selected'; }?>>Admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="i-menuFunction" class="col-sm-11 col-form-label">Función:</label>
        <div class="col-sm-11">
            <input type="text" class="form-control" id="i-menuFunction"
                   value="<?php echo $url?>">
        </div>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary col-sm-5" onclick="<?php
            if ($texto != '') {
                echo "editMenu($id_Padre, $orden)";
            } else {
                echo "newMenu($id_Padre, $orden)";
            }
        ?>">
            <?php
                if ( $texto != '' ) {
                    echo 'Editar menú';
                } else {
                    echo 'Añadir menú';
                }
            ?>
        </button>
    </div>

</form>