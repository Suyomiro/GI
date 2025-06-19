<?php
require_once __DIR__ . '/../../classes/Src/Controllers/RP/stats.controller.php';

$controller = new StatsController();

if (isset($_GET['action']) && $_GET['action'] === 'json') {
    $controller->getStatsJson();
} else {
    $controller->index();
}
?>