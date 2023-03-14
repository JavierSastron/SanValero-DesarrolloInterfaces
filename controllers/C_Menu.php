<?php
require_once 'controllers/Controller.php';
require_once 'views/View.php';
require_once 'models/M_Menu.php';
class C_Menu extends Controller {
    private $model;

    public function __construct() {
        parent::__construct(); //ejecutar constructor "padre"
        $this->model= new M_Menu();
    }

    /**
     * Cargar vistas menu
     */
    public function getMenuView() {
        $route = 'views/Menu/V_Menu.php';
        $menu = $this->model->getMenu();
        View::render($route, $menu);
    }
    public function getConfigMenu() {
        $route = 'views/Menu/V_Menu_Config.php';
        $data = $this->model->getMenu();
        View::render($route, $data);
    }
    public function menuFilterView() {
        $route = 'views/Menu/V_Menu_Filter.php';
        View::render($route);
    }
    public function getFormMenuView($parameters) {
        $route = 'views/Menu/V_Menu_NewForm.php';
        if ($parameters['funcion'] == 'Editar') {
            $parameters['menu'] = $this->model->getMenuByPosition($parameters['id_Padre'], $parameters['orden']);
        } else {
            $parameters['menu'] = $this->model->getMenuFormByPosition($parameters['id_Padre'], $parameters['orden']);
        }
        View::render($route, $parameters);
    }

    public function editMenu($parameters) {
        $this->model->editMenuInDB($parameters);
    }

    public function newMenu($parameters) {
        $route = 'views/Menu/V_Menu_PrintOnlyOneMenu.php';
        $newMenu = $this->model->newMenuInDB($parameters);
        View::render($route, $newMenu);
    }

    public function getPermissionForm($parameters) {
        $route = 'views/Menu/V_Menu_EditPermission.php';
        View::render($route, $parameters);
    }

    public function editPermission($parameters) {
        $this->model->editPermissionOnDB($parameters);
    }

    public function deletePermission($parameters) {
        $this->model->deletePermissionOnDB($parameters);
    }

}

?>