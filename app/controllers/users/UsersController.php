<?php
require_once 'app/models/User.php';
require_once 'app/models/Role.php';

class UsersController
{
    public function index()
    {
        $userModel = new User();
        $users = $userModel->readAll();

        include 'app/views/users/index.php';
    }

    public function create()
    {
        include 'app/views/users/create.php';
    }

    public function store()
    {
        if (isset($_POST['name'])
            && isset($_POST['email'])
            && isset($_POST['login'])
            && isset($_POST['password'])
            && isset($_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                echo "Passwords do not mach";
                return;
            }

            $userModel = new User();
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'login' => $_POST['login'],
                'password' => $_POST['password'],
            ];
            $userModel->create($data);
            header("Location: index.php?page=users");
        }
    }

    public function edit()
    {
        $userModel = new User();
        $user = $userModel->read($_GET['id']);
        $roleModel = new Role();
        $roles = $roleModel->readAll();

        include 'app/views/users/edit.php';
    }

    public function update()
    {
        $userModel = new User();
        $userModel->update($_POST);

        header("Location: index.php?page=users");
    }

    public function delete()
    {
        $userModel = new User();
        $userModel->delete($_GET['id']);
        header("Location: index.php?page=users");
    }
}