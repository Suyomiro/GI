<?php
require_once __DIR__ . '/../../Models/Etudiant/etudiant.model.php';
require_once __DIR__ . '/../../Repositories/Etudiant/etudiant.repository.php';
require_once __DIR__ . '/../../Services/Etudiant/etudiant.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class EtudiantController {
    private EtudiantRepository $repository;
    private EtudiantService $service;

    public function __construct() {
        $this->repository = new EtudiantRepository();
        $this->service = new EtudiantService($this->repository);
    }

    public function dashboard(): void {
        SessionManager::requireRole('ETUDIANT');
        
        $user = SessionManager::getUser();
        $etudiant = $this->service->getEtudiantByUserId($user['id']);
        
        if (!$etudiant) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Profil étudiant non trouvé'];
            header('Location: /GI/Public/login.php');
            exit;
        }

        $inscriptionActuelle = $this->service->getInscriptionActuelle($etudiant['id']);
        $demandes = $this->service->getDemandesEtudiant($etudiant['id']);
        $historiqueInscriptions = $this->service->getHistoriqueInscriptions($etudiant['id']);
        
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/Etudiant/dashboard.view.php';
    }

    public function createDemande(): void {
        SessionManager::requireRole('ETUDIANT');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = SessionManager::getUser();
            $etudiant = $this->service->getEtudiantByUserId($user['id']);
            
            if (!$etudiant) {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Profil étudiant non trouvé'];
                header('Location: dashboard.php');
                exit;
            }

            $typeDemande = $_POST['type_demande'] ?? '';
            $motif = $_POST['motif'] ?? '';

            if ($this->service->createDemande($etudiant['id'], $typeDemande, $motif)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Demande créée avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la création de la demande'];
            }
        }
        
        header('Location: dashboard.php');
        exit;
    }
}
?>