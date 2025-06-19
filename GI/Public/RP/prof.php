<?php
require_once __DIR__ . '/../../classes/Src/Controllers/RP/prof.controller.php';

$controller = new ProfController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $controller->create();
            break;
        case 'modules':
            $id = $_GET['id'] ?? '';
            $controller->modules($id);
            break;
        case 'add_module':
            $controller->addModule();
            break;
        case 'remove_module':
            $controller->removeModule();
            break;
        case 'classes':
            $id = $_GET['id'] ?? '';
            $controller->classes($id);
            break;
        case 'add_classe':
            $controller->addClasse();
            break;
        case 'remove_classe':
            $controller->removeClasse();
            break;
        default:
            $controller->index();
    }
} else {
    $controller->index();
}
?>