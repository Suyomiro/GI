<?php
require_once __DIR__ . '/../../classes/Src/Controllers/Etudiant/etudiant.controller.php';

$controller = new EtudiantController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create_demande':
            $controller->createDemande();
            break;
        default:
            $controller->dashboard();
    }
} else {
    $controller->dashboard();
}
?>