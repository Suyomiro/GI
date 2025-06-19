<?php
require_once __DIR__ . '/../../classes/Src/Controllers/RP/demandes.controller.php';

$controller = new DemandesController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'traiter':
            $controller->traiter();
            break;
        default:
            $controller->index();
    }
} else {
    $controller->index();
}
?>