<?php
require_once __DIR__ . '/../../Models/RP/modules.model.php';
require_once __DIR__ . '/../../Repositories/RP/modules.repository.php';
require_once __DIR__ . '/../../Services/RP/modules.service.php';
require_once __DIR__ . '/../../../../config/session.php';

class ModulesController {
    private ModulesRepository $repository;
    private ModulesService $service;

    public function __construct() {
        $this->repository = new ModulesRepository();
        $this->service = new ModulesService($this->repository);
    }

    public function index(): void {
        SessionManager::requireRole('RP');
        
        $modules = $this->service->getAllModules();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/RP/modules.view.php';
    }

    public function create(): void {
        SessionManager::requireRole('RP');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['module_id'] ?? '';
            $nom = $_POST['nom'] ?? '';

            if ($this->service->createModule($id, $nom)) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Module créé avec succès'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors de la création du module'];
            }
        }
        
        header('Location: modules.php');
        exit;
    }

    public function professeurs(string $moduleId): void {
        SessionManager::requireRole('RP');
        
        $module = $this->service->getModuleById($moduleId);
        if (!$module) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Module non trouvé'];
            header('Location: modules.php');
            exit;
        }

        $professeurs = $this->repository->getProfesseurs($moduleId);
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);
        
        include __DIR__ . '/../../Views/RP/module-professeurs.view.php';
    }

    public function removeProfesseur(): void {
        SessionManager::requireRole('RP');
        
        $moduleId = $_GET['module_id'] ?? '';
        $profId = $_GET['prof_id'] ?? '';

        if ($this->repository->removeProfesseur($moduleId, $profId)) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Professeur retiré avec succès'];
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Erreur lors du retrait du professeur'];
        }
        
        header("Location: modules.php?action=professeurs&id=$moduleId");
        exit;
    }
}
?>