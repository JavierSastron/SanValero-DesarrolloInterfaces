<?php

class View {
    static public function render($viewRoute, $data=array()) {
        //Require equivale al codigo que hay dentro del archivo especificado en viewRoute
        //Al hacer esto también se incluirá en el require la variable data (Mal explicado).
        require_once($viewRoute);
    }
}

?>