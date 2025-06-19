<?php
require_once __DIR__ . '/../../Repositories/Etudiant/etudiant.repository.php';

class EtudiantService {
    private EtudiantRepository $repository;

    public function __construct(EtudiantRepository $repository) {
        $this->repository = $repository;
    }

    public function getEtudiantByUserId(string $userId): ?array {
        return $this->repository->getEtudiantByUserId($userId);
    }

    public function getInscriptionActuelle(string $etudiantId): ?array {
        return $this->repository->getInscriptionActuelle($etudiantId);
    }

    public function getDemandesEtudiant(string $etudiantId): array {
        return $this->repository->getDemandesEtudiant($etudiantId);
    }

    public function getHistoriqueInscriptions(string $etudiantId): array {
        return $this->repository->getHistoriqueInscriptions($etudiantId);
    }

    public function createDemande(string $etudiantId, string $typeDemande, string $motif): bool {
        if (empty($typeDemande) || empty($motif)) {
            return false;
        }

        // Récupérer l'inscription actuelle
        $inscriptionActuelle = $this->getInscriptionActuelle($etudiantId);
        if (!$inscriptionActuelle) {
            return false; // Pas d'inscription active
        }

        return $this->repository->createDemande(
            $etudiantId,
            $inscriptionActuelle['id'],
            $typeDemande,
            $motif
        );
    }
}
?>