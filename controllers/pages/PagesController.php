<?php

namespace controllers\pages;

use models\Check;
use models\pages\PageModel;
use models\roles\RoleModel;

class PagesController
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

        $pageModel = new PageModel();
        $pages = $pageModel->readAll();

        include 'app/views/pages/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();
        $roleModel = new RoleModel();
        $roles = $roleModel->readAll();
        include 'app/views/pages/create.php';
    }

    public function store()
    {
        $this->check->requirePermission();
        if (isset($_POST['title'])
            && isset($_POST['slug'])
            && isset($_POST['role'])) {
            if (empty(trim($_POST['title']))
                || empty(trim($_POST['slug']))
                || empty($_POST['role'])) {
                echo "Title and slug and rile fields are required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->create($_POST);

            $path = '/' . APP_BASE_PATH . 'pages';
            header("Location: $path");
        }
    }

    public function edit($params)
    {
        $this->check->requirePermission();
        $pageModel = new PageModel();
        $page = $pageModel->read($params['id']);

        $roleModel = new RoleModel();
        $roles = $roleModel->readAll();

        include 'app/views/pages/edit.php';
    }

    public function update()
    {
        $this->check->requirePermission();
        if (empty(trim($_POST['title']))
            || empty(trim($_POST['slug']))
            || empty($_POST['role'])) {
            echo "Title and slug and role are required!";
            return;
        }

        $pageModel = new PageModel();
        $pageModel->update($_POST);

        $path = '/' . APP_BASE_PATH . 'pages';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();
        $pageModel = new PageModel();
        $pageModel->delete($params['id']);
        $path = '/' . APP_BASE_PATH . 'pages';
        header("Location: $path");
    }
}