<?php
require_once __DIR__ . '/../../Models/RP/demandes.model.php';
require_once __DIR__ . '/../../Repositories/RP/demandes.repository.php';
require_once __DIR__ . '/../../Services/RP/demandes.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class DemandesController {
    private DemandesRepository $repository;
    private DemandesService $service;

    public function __construct() {
        $this->repository = new DemandesRepository();
        $this->service = new DemandesService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('RP');
        
        $demandes = $this->service->getAllDemandes();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/RP/demandes.view.php';
    }

    public function traiter(): void {
        SessionManager::requireRole('RP');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $demandeId = $_POST['demande_id'] ?? '';
            $action = $_POST['action'] ?? '';
            $userId = SessionManager::getUser()['id'];

            if ($action === 'accepter') {
                if ($this->service->accepterDemande($demandeId, $userId)) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Demande acceptée avec succès'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de l\'acceptation de la demande'];
                }
            } elseif ($action === 'refuser') {
                if ($this->service->refuserDemande($demandeId, $userId)) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Demande refusée avec succès'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors du refus de la demande'];
                }
            }
        }
        
        header('Location: demandes.php');
        exit;
    }
}
?>