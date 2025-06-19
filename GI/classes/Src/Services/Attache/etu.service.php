<?php
require_once __DIR__ . '/../../Models/Attache/etu.model.php';
require_once __DIR__ . '/../../Repositories/Attache/etu.repository.php';

class EtuService {
    private EtuRepository $repository;

    public function __construct(EtuRepository $repository) {
        $this->repository = $repository;
    }

    public function getEtudiants(string $sexe = '', string $recherche = ''): array {
        return $this->repository->getEtudiants($sexe, $recherche);
    }

    public function getEtudiantById(string $id): ?array {
        return $this->repository->getById($id);
    }

    public function createEtudiant(string $matricule, string $nom, string $prenom, string $sexe, string $adresse, string $email): bool {
        if (empty($matricule) || empty($nom) || empty($prenom) || empty($sexe) || empty($adresse) || empty($email)) {
            return false;
        }

        $etudiant = new EtudiantModel(
            $this->generateId(),
            $matricule,
            $nom,
            $prenom,
            $sexe,
            $adresse,
            $email
        );

        return $this->repository->create($etudiant);
    }

    private function generateId(): string {
        return uniqid('ETU_', true);
    }
}
?>