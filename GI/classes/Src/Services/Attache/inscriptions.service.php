<?php
require_once __DIR__ . '/../../Models/Attache/inscriptions.model.php';
require_once __DIR__ . '/../../Repositories/Attache/inscriptions.repository.php';

class InscriptionsService {
    private InscriptionsRepository $repository;

    public function __construct(InscriptionsRepository $repository) {
        $this->repository = $repository;
    }

    public function getInscriptions(string $annee = '', string $classe = '', string $recherche = ''): array {
        return $this->repository->getInscriptions($annee, $classe, $recherche);
    }

    public function getInscriptionById(string $id): ?array {
        return $this->repository->getById($id);
    }

    public function createInscription(string $etudiantId, string $classeId, string $anneeScolaire): bool {
        if (empty($etudiantId) || empty($classeId) || empty($anneeScolaire)) {
            return false;
        }

        $inscription = new InscriptionModel(
            $this->generateId(),
            $etudiantId,
            $classeId,
            $anneeScolaire,
            date('Y-m-d H:i:s'),
            'active'
        );

        return $this->repository->create($inscription);
    }

    public function getAllClasses(): array {
        return $this->repository->getAllClasses();
    }

    public function getAllEtudiants(): array {
        return $this->repository->getAllEtudiants();
    }

    public function getAnneesDisponibles(): array {
        return $this->repository->getAnneesDisponibles();
    }

    private function generateId(): string {
        return uniqid('INS_', true);
    }
}
?>