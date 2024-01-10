<?php

namespace controllers\auth;
use models\auth\AuthModel;

class AuthController
{
    public function register()
    {
        include 'app/views/auth/register.php';
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
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'login' => $_POST['login'],
                'password' => $_POST['password'],
            ];
            $authModel = new AuthModel();
            $authModel->register($data);

            $path = '/'.APP_BASE_PATH.'auth/login';
            header("Location: $path");
        }
    }

    public function login()
    {
        include 'app/views/auth/login.php';
    }

    public function authenticate()
    {
        if (isset($_POST['email'])
            && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = $_POST['remember'] ?? '';
            $authModel = new AuthModel();
            $user = $authModel->findByEmail($email);
            if ($user) {
                $user = $authModel->login($email, $password);
                if ($user) {
//                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_role'] = $user['role'];
                    if ($remember == 'on') {
                        setcookie('user_email', $email,
                            time() + (7 * 24 * 60 * 60));
                        setcookie('user_password', $password,
                            time() + (7 * 24 * 60 * 60));
                    }
                    header("Location: /");
                }
            } else echo 'Invalid email or password';
        }
    }

    public function logout()
    {
//        session_start();
        session_unset();
        session_destroy();
        header("Location: /");
    }
}