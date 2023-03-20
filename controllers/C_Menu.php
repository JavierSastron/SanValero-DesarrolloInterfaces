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
    public function getMenuView($parameters) {
        $route = 'views/Menu/V_Menu.php';
        $menu = $this->model->getMenu($parameters);
        View::render($route, $menu);
    }
    public function getConfigMenu($parameters) {
        $route = 'views/Menu/V_Menu_Config.php';
        $data = $this->model->getMenu($parameters);
        View::render($route, $data);
    }
    public function menuFilterView($parameters) {
        $route = 'views/Menu/V_Menu_Filter.php';
        $data = $this->model->getFilterInfo($parameters);
        View::render($route, $data);
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

    public function newPermission($parameters) {
        $route = 'views/Menu/V_Menu_ReloadPermission.php';
        $data = $this->model->addPermissionsOnDB($parameters);
        View::render($route, $data);
    }

    public function addRole($parameters) {
        require_once 'views/Menu/V_Menu_RoleList.php';
        $roleList = $this->model->addRoleOnDB($parameters);
        createRoleList($roleList);
    }

    public function deleteRole($parameters) {
        require_once 'views/Menu/V_Menu_RoleList.php';
        $roleList = $this->model->deleteRoleOnDB($parameters);
        createRoleList($roleList);
    }

    public function editRole($parameters) {
        require_once 'views/Menu/V_Menu_RoleList.php';
        $roleList = $this->model->editRoleOnDB($parameters);
        createRoleList($roleList);
    }

    public function linkRoleToUser($parameters) {
        $this->model->linkRoleToUserInDB($parameters);
    }

    public function showUserRoles($parameters) {
        $route = 'views/Menu/V_Menu_UserRoles.php';
        $roleList = $this->model->getUserRoles($parameters);
        View::render($route, $roleList);
    }

    public function changeLinkIcon($parameters) {
        $route = 'views/Menu/V_Menu_ReturnValue.php';
        $isLinked = $this->model->isRoleSet($parameters);
        View::render($route, $isLinked);
    }

    public function changePermissionRole($parameters) {
        $this->model->changePermissionRoleOnDB($parameters);
    }

    public function changeUserPermission($parameters) {
        $this->model->changeUserPermissionOnDB($parameters);
    }
}

?>