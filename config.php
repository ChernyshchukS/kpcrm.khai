<?php
//var_dump($_POST);
function tt($str)
{
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}

function tte($str)
{
    echo "<pre>";
    print_r($str);
    echo "</pre>";
    exit();
}

const APP_BASE_PATH = '';
const DB_HOST = 'localhost';
const DB_NAME = 'kpcrm';
const DB_USER = 'root';
const DB_PASS = '';