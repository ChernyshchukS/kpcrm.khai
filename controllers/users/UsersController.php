<?php

namespace controllers\users;

use models\Check;
use models\roles\RoleModel;
use models\users\UserModel;

class UsersController
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
        $userModel = new UserModel();
        $users = $userModel->readAll();

        include 'app/views/users/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        include 'app/views/users/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
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

            $userModel = new UserModel();
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'login' => $_POST['login'],
                'password' => $_POST['password'],
            ];
            $userModel->create($data);
            $path = '/' . APP_BASE_PATH . 'users';
            header("Location: $path");
        }
    }

    public function edit($params)
    {
        $this->check->requirePermission();
        $userModel = new UserModel();
        $user = $userModel->read($params['id']);
        $roleModel = new RoleModel();
        $roles = $roleModel->readAll();

        include 'app/views/users/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();
        $userModel = new UserModel();
        $userModel->update($_POST);
        $path = '/' . APP_BASE_PATH . 'users';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();
        $userModel = new UserModel();
        $userModel->delete($params['id']);
        $path = '/' . APP_BASE_PATH . 'users';
        header("Location: $path");
    }
}