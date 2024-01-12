<?php

namespace controllers\todo\categories;

use models\Check;
use models\todo\categories\CategoryModel;

class CategoriesController
{
    private $check;

    public function __construct()
    {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new Check($userRole);
    }

    public function index(): void
    {
        $this->check->requirePermission();

        $categoryModel = new CategoryModel();
//        $categories = $categoryModel->readAll();
        $categories = $categoryModel->readAllForUser($_SESSION['user_id']);

        include 'app/views/todo/categories/index.php';
    }

    public function create(): void
    {
        $this->check->requirePermission();
        include 'app/views/todo/categories/create.php';
    }

    public function store(): void
    {
        $this->check->requirePermission();
        if (isset($_POST['user_id'])) {
            if (isset($_POST['title'])
                && isset($_POST['description'])) {

                $categoryModel = new CategoryModel();
                $categoryModel->create($_POST);

                $path = '/' . APP_BASE_PATH . 'todo/categories';
                header("Location: $path");
            } else {
                echo "Title and description are required";
            }
        } else {
            echo "Login first";
            $path = '/' . APP_BASE_PATH . 'auth/login';
            header("Location: $path");
        }
    }

    public function edit($params): void
    {
        $this->check->requirePermission();
        $categoryModel = new CategoryModel();
        $category = $categoryModel->read($params['id']);

        include 'app/views/todo/categories/edit.php';
    }

    public function update(): void
    {
        $this->check->requirePermission();
        $categoryModel = new CategoryModel();
        $categoryModel->update($_POST);

        $path = '/' . APP_BASE_PATH . 'todo/categories';
        header("Location: $path");
    }

    public function delete($params): void
    {
        $this->check->requirePermission();
        $categoryModel = new CategoryModel();
        $categoryModel->delete($params['id']);

        $path = '/' . APP_BASE_PATH . 'todo/categories';
        header("Location: $path");
    }
}