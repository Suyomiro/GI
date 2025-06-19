<?php
require_once __DIR__ . '/../../Models/Attache/inscriptions.model.php';
require_once __DIR__ . '/../../Repositories/Attache/inscriptions.repository.php';
require_once __DIR__ . '/../../Services/Attache/inscriptions.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class InscriptionsController {
    private InscriptionsRepository $repository;
    private InscriptionsService $service;

    public function __construct() {
        $this->repository = new InscriptionsRepository();
        $this->service = new InscriptionsService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('ATTACHE');
        
        $annee = $_GET['annee'] ?? date('Y') . '-' . (date('Y') + 1);
        $classe = $_GET['classe'] ?? '';
        $recherche = $_GET['recherche'] ?? '';
        
        $inscriptions = $this->service->getInscriptions($annee, $classe, $recherche);
        $classes = $this->service->getAllClasses();
        $anneesDisponibles = $this->service->getAnneesDisponibles();
        
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/Attache/inscriptions.view.php';
    }

    public function create(): void {
        SessionManager::requireRole('ATTACHE');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $etudiantId = $_POST['etudiant_id'] ?? '';
            $classeId = $_POST['classe_id'] ?? '';
            $anneeScolaire = $_POST['annee_scolaire'] ?? '';

            if ($this->service->createInscription($etudiantId, $classeId, $anneeScolaire)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Inscription créée avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la création de l\'inscription'];
            }
        }
        
        header('Location: inscriptions.php');
        exit;
    }

    public function details(string $id): void {
        SessionManager::requireRole('ATTACHE');
        
        $inscription = $this->service->getInscriptionById($id);
        if (!$inscription) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Inscription non trouvée'];
            header('Location: inscriptions.php');
            exit;
        }
        
        include __DIR__ . '/../../Views/Attache/inscription-details.view.php';
    }
}
?>