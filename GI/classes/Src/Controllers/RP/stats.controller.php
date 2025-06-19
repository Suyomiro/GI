<?php
require_once __DIR__ . '/../../Models/RP/stats.model.php';
require_once __DIR__ . '/../../Repositories/RP/stats.repository.php';
require_once __DIR__ . '/../../Services/RP/stats.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class StatsController {
    private StatsRepository $repository;
    private StatsService $service;

    public function __construct() {
        $this->repository = new StatsRepository();
        $this->service = new StatsService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('RP');
        
        $anneeActuelle = date('Y') . '-' . (date('Y') + 1);
        $annee = $_GET['annee'] ?? $anneeActuelle;
        
        $stats = $this->service->getStatistiques($annee);
        $anneesDisponibles = $this->service->getAnneesDisponibles();
        
        include __DIR__ . '/../../Views/RP/stats.view.php';
    }

    public function getStatsJson(): void {
        SessionManager::requireRole('RP');
        
        $annee = $_GET['annee'] ?? date('Y') . '-' . (date('Y') + 1);
        $stats = $this->service->getStatistiques($annee);
        
        header('Content-Type: application/json');
        echo json_encode($stats);
    }
}
?>