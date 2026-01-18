<?php
require_once __DIR__ . '/../app/controllers/StudentController.php';

$url = $_GET['url'] ?? 'student/index';
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller'; // StudentController
$action = $url[1] ?? 'index';

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else { echo "404 Action Not Found"; }
} else { echo "404 Controller Not Found"; }