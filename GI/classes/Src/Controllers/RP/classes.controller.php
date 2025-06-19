<?php
require_once __DIR__ . '/../../Models/RP/classes.model.php';
require_once __DIR__ . '/../../Repositories/RP/classes.repository.php';
require_once __DIR__ . '/../../Services/RP/classes.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class ClassesController {
    private ClassesRepository $repository;
    private ClassesService $service;

    public function __construct() {
        $this->repository = new ClassesRepository();
        $this->service = new ClassesService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('RP');
        
        $classes = $this->service->getAllClasses();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/RP/classes.view.php';
    }

    public function create(): void {
        SessionManager::requireRole('RP');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['class_id'] ?? '';
            $libelle = $_POST['libelle'] ?? '';
            $filiere = $_POST['filiere'] ?? '';
            $niveau = $_POST['niveau'] ?? '';

            if ($this->service->createClasse($id, $libelle, $filiere, $niveau)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Classe créée avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la création de la classe'];
            }
        }
        
        header('Location: classes.php');
        exit;
    }

    public function details(string $id): void {
        SessionManager::requireRole('RP');
        
        $classe = $this->service->getClasseById($id);
        if (!$classe) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Classe non trouvée'];
            header('Location: classes.php');
            exit;
        }
        
        $modulesCount = $this->repository->getModulesCount($id);
        $professeursCount = $this->repository->getProfesseursCount($id);
        
        include __DIR__ . '/../../Views/RP/classe-details.view.php';
    }
}
?>