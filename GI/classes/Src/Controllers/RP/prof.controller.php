<?php
require_once __DIR__ . '/../../Models/RP/prof.model.php';
require_once __DIR__ . '/../../Repositories/RP/prof.repository.php';
require_once __DIR__ . '/../../Services/RP/prof.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class ProfController {
    private ProfesseurRepository $repository;
    private ProfService $service;

    public function __construct() {
        $this->repository = new ProfesseurRepository();
        $this->service = new ProfService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('RP');
        
        $professeurs = $this->service->getAllProfesseurs();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/RP/prof.view.php';
    }

    public function create(): void {
        SessionManager::requireRole('RP');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['prof_id'] ?? '';
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $grade = $_POST['grade'] ?? '';

            if ($this->service->createProfesseur($id, $nom, $prenom, $grade)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Professeur créé avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la création du professeur'];
            }
        }
        
        header('Location: prof.php');
        exit;
    }

    public function modules(string $profId): void {
        SessionManager::requireRole('RP');
        
        $professeur = $this->service->getProfesseurById($profId);
        if (!$professeur) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Professeur non trouvé'];
            header('Location: prof.php');
            exit;
        }

        $modules = $this->repository->getModules($profId);
        $allModules = $this->service->getAllModules();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/RP/prof-modules.view.php';
    }

    public function addModule(): void {
        SessionManager::requireRole('RP');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profId = $_POST['prof_id'] ?? '';
            $moduleId = $_POST['module_id'] ?? '';

            if ($this->repository->addModule($profId, $moduleId)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Module ajouté avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de l\'ajout du module'];
            }
        }
        
        $profId = $_POST['prof_id'] ?? $_GET['prof_id'] ?? '';
        header("Location: prof.php?action=modules&id=$profId");
        exit;
    }

    public function removeModule(): void {
        SessionManager::requireRole('RP');
        
        $profId = $_GET['prof_id'] ?? '';
        $moduleId = $_GET['module_id'] ?? '';

        if ($this->repository->removeModule($profId, $moduleId)) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Module retiré avec succès'];
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors du retrait du module'];
        }
        
        header("Location: prof.php?action=modules&id=$profId");
        exit;
    }

    public function classes(string $profId): void {
        SessionManager::requireRole('RP');
        
        $professeur = $this->service->getProfesseurById($profId);
        if (!$professeur) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Professeur non trouvé'];
            header('Location: prof.php');
            exit;
        }

        $classes = $this->repository->getClasses($profId);
        $allClasses = $this->service->getAllClasses();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/RP/prof-classes.view.php';
    }

    public function addClasse(): void {
        SessionManager::requireRole('RP');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profId = $_POST['prof_id'] ?? '';
            $classeId = $_POST['classe_id'] ?? '';

            if ($this->repository->addClasse($profId, $classeId)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Classe ajoutée avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de l\'ajout de la classe'];
            }
        }
        
        $profId = $_POST['prof_id'] ?? $_GET['prof_id'] ?? '';
        header("Location: prof.php?action=classes&id=$profId");
        exit;
    }

    public function removeClasse(): void {
        SessionManager::requireRole('RP');
        
        $profId = $_GET['prof_id'] ?? '';
        $classeId = $_GET['classe_id'] ?? '';

        if ($this->repository->removeClasse($profId, $classeId)) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Classe retirée avec succès'];
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors du retrait de la classe'];
        }
        
        header("Location: prof.php?action=classes&id=$profId");
        exit;
    }
}
?>