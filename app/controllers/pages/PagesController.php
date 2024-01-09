<?php
require_once 'app/models/pages/PageModel.php';

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
                empty(trim($_POST['slug']))){
                echo "Title and slug required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->create($_POST);
            header("Location: index.php?page=pages");
        }
    }

    public function edit()
    {
        $pageModel = new PageModel();
        $page = $pageModel->read($_GET['id']);

        include 'app/views/pages/edit.php';
    }

    public function update()
    {
        if (empty(trim($_POST['title'])) ||
            empty(trim($_POST['slug']))){
            echo "Title and slug required!";
            return;
        }

        $pageModel = new PageModel();
        $pageModel->update($_POST);
        header("Location: index.php?page=pages");
    }

    public function delete()
    {
        $pageModel = new PageModel();
        $pageModel->delete($_GET['id']);
        header("Location: index.php?page=pages");
    }
}