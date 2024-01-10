<?php

namespace controllers\roles;

use models\Check;
use models\roles\RoleModel;

class RolesController
{
    private $check;

    public function __construct()
    {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new Check($userRole);
    }

    public function index()
    {
        $this->check->requirePermission();
        $roleModel = new RoleModel();
        $roles = $roleModel->readAll();

        include 'app/views/roles/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        include 'app/views/roles/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['name'])
            && isset($_POST['description'])) {

            $roleModel = new RoleModel();
            $roleModel->create($_POST);

            $path = '/' . APP_BASE_PATH . 'roles';
            header("Location: $path");
        }
    }

    public function edit($params)
    {
        $this->check->requirePermission();
        $roleModel = new RoleModel();
        $role = $roleModel->read($params['id']);

        include 'app/views/roles/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();
        $roleModel = new RoleModel();
        $roleModel->update($_POST);

        $path = '/' . APP_BASE_PATH . 'roles';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();
        $roleModel = new RoleModel();
        $roleModel->delete($params['id']);

        $path = '/' . APP_BASE_PATH . 'roles';
        header("Location: $path");
    }
}