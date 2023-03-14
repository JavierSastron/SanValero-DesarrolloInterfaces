<script src=js/users.js></script>
<?php
 $id_Usuario = "";
 $nombre = "";
 $apellido_1 = "";
 $apellido_2 = "";
 $sexo = "";
 $mail = "";
 $movil = "";
 $login = "";
 $pass = "";
 $activo = "";
 extract($data);
 $msg = 'Nuevo Usuario';
 if ($id_Usuario != "") {
    $msg = 'Editar Usuario';
 }

/* Quiero meter aquí una comprobación.
   Si viene un dato (Id) llamará al M_Users
   con esto incluiré los datos actuales en el form */
?>

<form id="formUser" name="formUser" action="#" method="POST">

    <br>
    <div class="row">
        <div class="col-12">
            <b><?php echo $msg;?></b>
        </div>
    </div>
    <span id='msj' name='msj' style='color: red;'></span>
    <span id='repeatedUser' name='repeatedUser' style='color: red;'></span>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <label for="fNombre">Nombre:</label><br>
            <input type="text" id="fNombre" name="fNombre" class="form-control"
             placeholder="Usuario" value="<?php if ($nombre != "") echo $nombre; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <label for="fApellido_1">1ºApellido:</label><br>
            <input type="text" id="fApellido_1" name="fApellido_1" class="form-control"
             placeholder="1ºApellido" value="<?php if ($apellido_1 != "") echo $apellido_1; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <label for="fApellido_2">2ºApellido:</label><br>
            <input type="text" id="fApellido_2" name="fApellido_2" class="form-control"
             placeholder="2ºApellido" value="<?php if ($apellido_2 != "") echo $apellido_2; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <label for="fSexo">Sexo</label></br>
            <select id="fSexo" name="fSexo" class="form-control">
                <option value="" selected>-</option>
                <option value="H" <?php if ($sexo == "H") echo 'selected'; ?>>Hombre</option>
                <option value="M" <?php if ($sexo == "M") echo 'selected'; ?>>Mujer</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <label for="fMail">Mail:</label><br>
            <input type="text" id="fMail" name="fMail" class="form-control"
            placeholder="e-mail" value="<?php if ($mail != "") echo $mail; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <label for="fMovil">Móvil:</label><br>
            <input type="text" id="fMovil" name="fMovil" class="form-control"
             placeholder="phone" value="<?php if ($movil != "") echo $movil; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <label for="fLogin">Nombre de usuario:</label><br>
            <input type="text" id="fLogin" name="fLogin" class="form-control"
             placeholder="Nombre de Usuario" value="<?php if ($login != "") echo $login; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12">
            <label for="fPass">Contraseña:</label>
            <input type="text" id="fPass" name="fPass" class="form-control"
            placeholder="Contraseña" value="<?php if ($pass != "") echo $pass; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-12 col-md-12">
            <label for="fActivo">Activo / No activo</label><br>
            <select id="fActivo" name="fActivo" class="form-control">
                <option value="S" selected>Activo</option>
                <option value="N" <?php if ($activo == "N") echo "selected"; ?>>No activo</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 align-items-center d-flex justify-content-center">
            <button type="button"
                    onclick="validateUser('<?php echo 'id_Usuario='.$id_Usuario ?>')"
                    class="btn btn-success">Confirmar</button>
            <span id="msj" style="color: Blue;"></span>
        </div>
    </div>
    <br>
</form>
