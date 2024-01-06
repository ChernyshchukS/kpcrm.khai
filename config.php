<?php
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
return [
    'db_host' => 'localhost',
    'db_name' => 'kpcrm',
    'db_user' => 'root',
    'db_pass' => '',
];