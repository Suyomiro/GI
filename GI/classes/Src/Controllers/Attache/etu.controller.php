<?php
require_once __DIR__ . '/../../Models/Attache/etu.model.php';
require_once __DIR__ . '/../../Repositories/Attache/etu.repository.php';
require_once __DIR__ . '/../../Services/Attache/etu.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class EtuController {
    private EtuRepository $repository;
    private EtuService $service;

    public function __construct() {
        $this->repository = new EtuRepository();
        $this->service = new EtuService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('ATTACHE');
        
        $sexe = $_GET['sexe'] ?? '';
        $recherche = $_GET['recherche'] ?? '';
        
        $etudiants = $this->service->getEtudiants($sexe, $recherche);
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/Attache/etu.view.php';
    }

    public function create(): void {
        SessionManager::requireRole('ATTACHE');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $matricule = $_POST['matricule'] ?? '';
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $sexe = $_POST['sexe'] ?? '';
            $adresse = $_POST['adresse'] ?? '';
            $email = $_POST['email'] ?? '';

            if ($this->service->createEtudiant($matricule, $nom, $prenom, $sexe, $adresse, $email)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Étudiant créé avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la création de l\'étudiant'];
            }
        }
        
        header('Location: etu.php');
        exit;
    }

    public function details(string $id): void {
        SessionManager::requireRole('ATTACHE');
        
        $etudiant = $this->service->getEtudiantById($id);
        if (!$etudiant) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Étudiant non trouvé'];
            header('Location: etu.php');
            exit;
        }
        
        include __DIR__ . '/../../Views/Attache/etu-details.view.php';
    }

    public function inscriptions(string $id): void {
        SessionManager::requireRole('ATTACHE');
        
        $etudiant = $this->service->getEtudiantById($id);
        if (!$etudiant) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Étudiant non trouvé'];
            header('Location: etu.php');
            exit;
        }

        $inscriptions = $this->repository->getInscriptions($id);
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/Attache/etu-inscriptions.view.php';
    }
}
?>