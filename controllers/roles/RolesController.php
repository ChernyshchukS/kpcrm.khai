<?php

namespace controllers\roles;
use models\roles\RoleModel;

class RolesController
{
    public function index()
    {
        $roleModel = new RoleModel();
        $roles = $roleModel->readAll();

        include 'app/views/roles/index.php';
    }

    public function create()
    {
        include 'app/views/roles/create.php';
    }

    public function store()
    {
        if (isset($_POST['name'])
            && isset($_POST['description'])) {

            $roleModel = new RoleModel();
            $roleModel->create($_POST);

            $path = '/'.APP_BASE_PATH.'roles';
            header("Location: $path");
        }
    }

    public function edit($params)
    {
        $roleModel = new RoleModel();
        $role = $roleModel->read($params['id']);

        include 'app/views/roles/edit.php';
    }

    public function update()
    {
        $roleModel = new RoleModel();
        $roleModel->update($_POST);

        $path = '/'.APP_BASE_PATH.'roles';
        header("Location: $path");
    }

    public function delete($params)
    {
        $roleModel = new RoleModel();
        $roleModel->delete($params['id']);

        $path = '/'.APP_BASE_PATH.'roles';
        header("Location: $path");
    }
}