<?php session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="manifest" href="manifest.json">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#FFF">
    <title>Primera Evaluación</title>
    <script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/app.js"></script>
</head>
<!--
    APLICACIÓN DEL CURSO
    Patron: MVC
        -Separar visualización ejecucion y  mas

    Patrón: Visualización en una sola página
        -Facilita la instalación en todos los dispositivos
-->
<body>
    <!-- Contiene toda la página -->
    <div id="capaPagina" class="container-fluid">
        <div id="capaEncabezado" class="container-fluid">
            <div class="row">

                <div class="col-lg-2 col-md-2  d-none d-md-block">
                    <img src="imagenes/Logo.png" style="height: 5em;">
                </div>

                <div class="col-lg-8 col-md-8 col-sm-10 d-sx-block cabecera" style="text-align: center;">
                    <h1>Javier Sastrón Artigas</h1>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 d-none d-sm-block text-right cabecera">
                    <?php
                        if(isset($_SESSION['user'])) { //Logged
                            echo '<a href="logout.php" title="Cerrar Sesion">';
                            echo '<b>'.$_SESSION['user'].'</b>';
                            echo '<img src="imagenes/Logout2.png" style="height: 3em;">';
                            echo '</a>';
                        } else {
                            echo '<a href="login.php" title="Iniciar Sesion">';
                            echo '<img src="imagenes/NoLogeado.png" style="height: 3em;">';
                            echo '</a>';
                        }
                    ?>
                </div>

            </div>
        </div>

        <div id="capaMenu" class="container-fluid" style="background-color: orange;">
            <?php
                require_once 'controllers/C_Menu.php';
                $C_Menu = new C_Menu();
                $parameters = [];
                $C_Menu->getMenuView($parameters);
            ?>

            <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Menú</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class=navbar-nav>

                 Pedir datos -> id 0 -->
                <?php /*
                    $C_Menu;
                    $C_Menu = new C_Menu();
                    $menu = $C_Menu->getMenu();
                    //echo $menu;
                    foreach($menu as $row) { 
                        $menuDropdown = $C_Menu->getMenu();
                        /* COMO SABER SI NO HA DEVUELTO NADA */
                        //if (count($menuDropdown) == 0 && ($conectado == $row['permisos'] || $row['permisos'] = 'publico')) {
                ?>
                        <!--<li class="nav-item">
                        <a class="nav-link" href="#"><?php //echo $row["nombre"] ?></a>
                        </li>


                <?php   //} else if (($conectado == $row['permisos'] || $row['permisos'] == 'publico')){
                ?> 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" 
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php //echo $row["nombre"] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                 FOREACH DROPDOWN -->
                <?php
                            //foreach ($menuDropdown as $drop) {
                ?>
                            <!--<a class="dropdown-item"
                            onclick="getView('<?php // echo $drop['controlador'] ?>', '<?php //echo $drop['metodo'] ?>');" href="#">
                            <?php //echo $drop["nombre"] ?>
                            </a>-->
                <?php
                            //}
                ?>
                            <!--</div>
                        </li>-->
                <?php   //}
                ?>
                <?php
                    //}
                ?>
                    <!--</ul>
                </div>
            </nav> -->

            <!--<?php //if(isset($_SESSION['user'])){ ?>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Menú</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" onclick="getView('Users', 'userFilterView');" href="#">Listar Usuarios<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Añadir</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mantenimiento
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" onclick="getView('Users', 'userFilterView');" href="#">Usuarios</a>
                        <a class="dropdown-item" href="#">***</a>
                        <a class="dropdown-item" href="#">***</a>
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>

            <?php //}else{ //Si no logea?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Opciones</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mantenimiento
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" onclick="getView('Users', 'userFilterView');" href="#">Usuarios</a>
                        <a class="dropdown-item" href="#">***</a>
                        <a class="dropdown-item" href="#">***</a>
                        </div>
                    </li>
                    </ul>
                </div>
            </nav>
            <?php //} //fin else?>-->


        </div>

        <div id="capaContenido" class="container-fluid">
        </div>

    </div>
    <script src="pwa.js" async></script>
</body>
</html>