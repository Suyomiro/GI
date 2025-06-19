<?php
require_once __DIR__ . '/../../Models/RP/modules.model.php';
require_once __DIR__ . '/../../Repositories/RP/modules.repository.php';

class ModulesService {
    private ModulesRepository $repository;

    public function __construct(ModulesRepository $repository) {
        $this->repository = $repository;
    }

    public function getAllModules(): array {
        return $this->repository->getAll();
    }

    public function getModuleById(string $id): ?ModuleModel {
        return $this->repository->getById($id);
    }

    public function createModule(string $id, string $nom): bool {
        if (empty($id) || empty($nom)) {
            return false;
        }

        $module = new ModuleModel($id, $nom);
        return $this->repository->create($module);
    }
}
?>