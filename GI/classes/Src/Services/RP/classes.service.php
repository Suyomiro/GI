<?php
require_once __DIR__ . '/../../Models/RP/classes.model.php';
require_once __DIR__ . '/../../Repositories/RP/classes.repository.php';

class ClassesService {
    private ClassesRepository $repository;

    public function __construct(ClassesRepository $repository) {
        $this->repository = $repository;
    }

    public function getAllClasses(): array {
        return $this->repository->getAll();
    }

    public function getClasseById(string $id): ?ClasseModel {
        return $this->repository->getById($id);
    }

    public function createClasse(string $id, string $libelle, string $filiere, string $niveau): bool {
        if (empty($id) || empty($libelle) || empty($filiere) || empty($niveau)) {
            return false;
        }

        $classe = new ClasseModel($id, $libelle, $filiere, $niveau);
        return $this->repository->create($classe);
    }

    public function updateClasse(string $id, string $libelle, string $filiere, string $niveau): bool {
        $classe = $this->repository->getById($id);
        if (!$classe) {
            return false;
        }

        $classe->setLibelle($libelle);
        $classe->setFiliere($filiere);
        $classe->setNiveau($niveau);

        return $this->repository->update($classe);
    }

    public function deleteClasse(string $id): bool {
        return $this->repository->delete($id);
    }
}
?>