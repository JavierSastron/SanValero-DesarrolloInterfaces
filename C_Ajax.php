<?php session_start();

$getPost=array_merge($_POST, $_GET, $_FILES);

if (isset($getPost['controller'])){
    $controller=$getPost['controller'];
    $method=$getPost['method'];
    $controllerName='C_'.$controller;
    if(file_exists('./controllers/'.$controllerName.'.php')){
        require_once './controllers/'.$controllerName.'.php';

        //Creo constructor del objeto solicitado
        $controllerObject= new $controllerName();
        if (!method_exists($controllerObject, $method)) {
            echo 'NO HAY NADA QUE EJECUTAR';
        } else {
            //Ejecuto el metodo solicitado
            $controllerObject->$method($getPost);
        }

    } else {
        echo 'NO ENCONTRADO';
    }

} else {
    echo 'NO SE HA PODIDO REALIZAR';
}


?>