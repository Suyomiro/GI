<?php
require_once __DIR__ . '/../../classes/Src/Controllers/RP/modules.controller.php';

$controller = new ModulesController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $controller->create();
            break;
        case 'professeurs':
            $id = $_GET['id'] ?? '';
            $controller->professeurs($id);
            break;
        case 'remove_professeur':
            $controller->removeProfesseur();
            break;
        default:
            $controller->index();
    }
} else {
    $controller->index();
}
?>