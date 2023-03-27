<?php session_start(); //Mantener sesión (Siempre lo primero)
    require_once 'controllers/C_Users.php';
    $user='';
    $password='';
    extract($_POST); //Convierte en variables el contenido del POST
    $msj='';
    $cUser = new C_Users;
    $isUser = $cUser->validateUser($user, $password);

    if ($user != '' && $password != '') {
        if ($isUser) {
            $_SESSION['user']=$user;
            $_SESSION['permissions'] = $cUser->getUserPermission($user, $password);
            header('Location: index.php');
        } else {
            $msj='Datos erroneos.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2SI - Login</title>
    <script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/login.js"></script>
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <form id="formLogin" name="formLogin" action="#" method="POST"
             class="border p-5 extremoCentro">

            <div class="row">
                <div class="col-lg-12">
                    <b class="display-4">Bienvenido</b>
                </div>
            </div>
            <span id='msj' name='msj' style='color: red;'><?php echo $msj;?></span>
            <br>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                    <label for="user">Usuario:</label><br>
                    <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" value="" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12 col-md-12">
                    <label for="password">Contraseña:</label>
                    <input type="text" id="password" name="password" class="form-control" placeholder="Contraseña" value="">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 align-items-center d-flex justify-content-center">
                    <button type="button" onclick="save()" class="btn btn-success">Iniciar Sesion</button>
                    <!-- Al estar vacio no se vera nada pero cuando le pongamos texto se "creara" un mensaje al lado, al quitarlo se irá -->
                    <span id="msj" style="color: Blue;"></span>
                </div>
            </div>

        </form>
    </div>
</body>
</html>