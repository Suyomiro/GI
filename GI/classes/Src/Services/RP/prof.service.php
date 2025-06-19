<?php
require_once __DIR__ . '/../../Models/RP/prof.model.php';
require_once __DIR__ . '/../../Repositories/RP/prof.repository.php';
require_once __DIR__ . '/../../Repositories/RP/modules.repository.php';
require_once __DIR__ . '/../../Repositories/RP/classes.repository.php';

class ProfService {
    private ProfesseurRepository $repository;

    public function __construct(ProfesseurRepository $repository) {
        $this->repository = $repository;
    }

    public function getAllProfesseurs(): array {
        return $this->repository->getAll();
    }

    public function getProfesseurById(string $id): ?ProfesseurModel {
        return $this->repository->getById($id);
    }

    public function createProfesseur(string $id, string $nom, string $prenom, string $grade): bool {
        if (empty($id) || empty($nom) || empty($prenom) || empty($grade)) {
            return false;
        }

        $professeur = new ProfesseurModel($id, $nom, $prenom, $grade);
        return $this->repository->create($professeur);
    }

    public function getAllModules(): array {
        $modulesRepo = new ModulesRepository();
        return $modulesRepo->getAll();
    }

    public function getAllClasses(): array {
        $classesRepo = new ClassesRepository();
        return $classesRepo->getAll();
    }
}
?>