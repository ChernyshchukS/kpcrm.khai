<?php
if ($_SERVER['REQUEST_URI'] == '/index.php') {
    header('Location: /');
    exit();
}

$title = 'Home page';
ob_start();
?>
    <h4>МІНІСТЕРСТВО ОСВІТИ І НАУКИ УКРАЇНИ</h4>
    <h4>Національний аерокосмічний університет ім. М. Є. Жуковського</h4>
    <h4>«Харківський авіаційний інститут»</h4>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h1>Курсова робота</h1>
    <h2>з дисципліни "Бази даних"</h2>
    <h2>на тему "Інтернет-магазин"</h2>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h4>Виконав: студент групи 633п Чернищук С.В.</h4>
    <h4>Керівник: аспірант кафедри 603 Носиков О.С.</h4>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h4>Харків 2023р</h4>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>