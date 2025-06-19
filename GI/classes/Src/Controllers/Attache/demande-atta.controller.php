<?php
require_once __DIR__ . '/../../Models/Attache/demande-atta.model.php';
require_once __DIR__ . '/../../Repositories/Attache/demande-atta.repository.php';
require_once __DIR__ . '/../../Services/Attache/demande-atta.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class DemandeAttaController {
    private DemandeAttaRepository $repository;
    private DemandeAttaService $service;

    public function __construct() {
        $this->repository = new DemandeAttaRepository();
        $this->service = new DemandeAttaService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('ATTACHE');
        
        $matricule = $_GET['matricule'] ?? '';
        $demandes = [];
        
        if (!empty($matricule)) {
            $demandes = $this->service->getDemandesByMatricule($matricule);
        }
        
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/Attache/demande-atta.view.php';
    }
}
?>