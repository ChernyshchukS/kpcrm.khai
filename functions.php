<?php
// проверка активного пункта меню
function is_active($path)
{
    $currentPath = $_SERVER['REQUEST_URI'];
    if ($path == $currentPath)
        $result = 'class="nav-link aria-current="page"';
    else
        $result = 'class="nav-link text-white"';
    return  $result;
}