<?php
require_once 'app/models/roles/RoleModel.php';

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
            header("Location: index.php?page=roles");
        }
    }

    public function edit()
    {
        $roleModel = new RoleModel();
        $role = $roleModel->read($_GET['id']);

        include 'app/views/roles/edit.php';
    }

    public function update()
    {
        $roleModel = new RoleModel();
        $roleModel->update($_POST);

        header("Location: index.php?page=roles");
    }

    public function delete()
    {
        $roleModel = new RoleModel();
        $roleModel->delete($_GET['id']);
        header("Location: index.php?page=roles");
    }
}