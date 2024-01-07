<?php
require_once 'app/models/Role.php';

class RolesController
{
    public function index()
    {
        $roleModel = new Role();
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

            $roleModel = new Role();
            $roleModel->create($_POST);
            header("Location: index.php?page=roles");
        }
    }

    public function edit()
    {
        $roleModel = new Role();
        $role = $roleModel->read($_GET['id']);

        include 'app/views/roles/edit.php';
    }

    public function update()
    {
        $roleModel = new Role();
        $roleModel->update($_POST);

        header("Location: index.php?page=roles");
    }

    public function delete()
    {
        $roleModel = new Role();
        $roleModel->delete($_GET['id']);
        header("Location: index.php?page=roles");
    }
}