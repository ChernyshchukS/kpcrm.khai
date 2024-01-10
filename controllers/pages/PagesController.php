<?php

namespace controllers\pages;
use models\pages\PageModel;

class PagesController
{
    public function index()
    {
        $pageModel = new PageModel();
        $pages = $pageModel->readAll();

        include 'app/views/pages/index.php';
    }

    public function create()
    {
        include 'app/views/pages/create.php';
    }

    public function store()
    {
        if (isset($_POST['title'])
            && isset($_POST['slug'])) {

            if (empty(trim($_POST['title'])) ||
                empty(trim($_POST['slug']))) {
                echo "Title and slug required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->create($_POST);

            $path = '/'.APP_BASE_PATH.'pages';
            header("Location: $path");
        }
    }

    public function edit($params)
    {
        $pageModel = new PageModel();
        $page = $pageModel->read($params['id']);

        include 'app/views/pages/edit.php';
    }

    public function update()
    {
        if (empty(trim($_POST['title'])) ||
            empty(trim($_POST['slug']))) {
            echo "Title and slug required!";
            return;
        }

        $pageModel = new PageModel();
        $pageModel->update($_POST);
        $path = '/'.APP_BASE_PATH.'pages';
        header("Location: $path");
    }

    public function delete($params)
    {
        $pageModel = new PageModel();
        $pageModel->delete($params['id']);
        $path = '/'.APP_BASE_PATH.'pages';
        header("Location: $path");
    }
}