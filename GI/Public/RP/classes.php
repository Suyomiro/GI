<?php
require_once __DIR__ . '/../../classes/Src/Controllers/RP/classes.controller.php';

$controller = new ClassesController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $controller->create();
            break;
        case 'details':
            $id = $_GET['id'] ?? '';
            $controller->details($id);
            break;
        default:
            $controller->index();
    }
} else {
    $controller->index();
}
?>