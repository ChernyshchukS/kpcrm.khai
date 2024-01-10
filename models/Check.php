<?php

namespace models;

use models\pages\PageModel;

class Check
{
    private $userRole;
    public function __construct($userRole)
    {
        $this->userRole = $userRole;
    }
    public function getCurrentUrlSlug()
    {
        $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parseUrl = parse_url($url);
        $path = $parseUrl['path'];
        $path = str_replace(APP_BASE_PATH, '', $path);
        $segments = explode('/', ltrim($path, '/'));
        $twoSegments = array_slice($segments, 0, 2);
        return implode('/', $twoSegments);
    }

    public function checkPermission($slug)
    {
        $pageModel = new PageModel();
        $page = $pageModel->findSlug($slug);
        if (!$page) return false;
        $allowedRoles = explode(",", $page['role']);
        if (isset($this->userRole)
            && in_array($this->userRole, $allowedRoles)) {
            return true;
        }
        return false;
    }

    public function requirePermission()
    {
        $slug = $this->getCurrentUrlSlug();
        if (!$this->checkPermission($slug)) {
            $path = "/".APP_BASE_PATH;
            header("Location: $path");
            exit();
        }
    }
}