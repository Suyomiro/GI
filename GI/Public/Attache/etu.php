<?php
require_once __DIR__ . '/../../classes/Src/Controllers/Attache/etu.controller.php';

$controller = new EtuController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $controller->create();
            break;
        case 'details':
            $id = $_GET['id'] ?? '';
            $controller->details($id);
            break;
        case 'inscriptions':
            $id = $_GET['id'] ?? '';
            $controller->inscriptions($id);
            break;
        default:
            $controller->index();
    }
} else {
    $controller->index();
}
?>