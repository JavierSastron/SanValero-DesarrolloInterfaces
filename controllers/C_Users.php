<?php
require_once 'controllers/Controller.php';
require_once 'views/View.php';
require_once 'models/M_Users.php';
class C_Users extends Controller {
    private $model;

    public function __construct() {
        parent::__construct(); //ejecutar constructor "padre"
        $this->model= new M_Users();

    }

    public function userFilterView($parameters) {
        $filterRoute = 'views/Users/V_Users_Filters.php';
        View::render($filterRoute);
    }

    public function userFormView($parameters) {
        $bonus = null;
        extract($parameters);
        $filterRoute = 'views/Users/V_Users_Form.php';
        if ($bonus == null) {
            View::render($filterRoute);
        } else {
            $usuario = $this->model->searchUser($bonus);
            View::render($filterRoute, $usuario[0]);
        }
    }

    public function executeThenReturn($parameters) {
        //Comprobar repetición
        

        //CAMBIAR SISTEMA PARA ID USARIO EN LUGAR DE ACTION
            if($parameters["id_Usuario"] == '') {
                $this->model->insert($parameters);
            } else {
                $this->model->update($parameters);
            }
            
            $filterRoute = 'views/Users/V_Users_Filters.php';
            View::render($filterRoute);
    }

    public function search($filter) {
        //echo json_encode($filter);
        $listRoute = 'views/Users/V_Users_List.php';
        //buscar usuarios filtrados
        $users=$this->model->searchUsers($filter);
        //mostrar listado
        View::render($listRoute, $users);
    }

    public function validateUser($user, $password) {
        return $this->model->checkUser(addslashes($user), $password);
    }

    public function changeStatus($parameters) {
        $this->model->changeStatus($parameters);
    }

    /**
     * Comprobar Login existe o no
     */
    public function checkLogin($parameters) {
        $login = '';
        $id_Usuario = '';
        extract($parameters);
        $alreadyExist = $this->model->existLogin($login, $id_Usuario);
        if($alreadyExist) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

}

?>