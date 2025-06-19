<?php
require_once __DIR__ . '/../../Models/RP/demandes.model.php';
require_once __DIR__ . '/../../Repositories/RP/demandes.repository.php';

class DemandesService {
    private DemandesRepository $repository;

    public function __construct(DemandesRepository $repository) {
        $this->repository = $repository;
    }

    public function getAllDemandes(): array {
        return $this->repository->getAll();
    }

    public function accepterDemande(string $demandeId, string $userId): bool {
        $demande = $this->repository->getById($demandeId);
        if (!$demande || $demande['statut'] !== 'en_attente') {
            return false;
        }

        // Mettre à jour le statut de la demande
        if (!$this->repository->updateStatut($demandeId, 'acceptee', $userId)) {
            return false;
        }

        // Mettre à jour le statut de l'inscription
        $nouveauStatut = $demande['type_demande'] === 'suspension' ? 'suspendue' : 'annulee';
        return $this->repository->updateInscriptionStatut($demande['inscription_id'], $nouveauStatut);
    }

    public function refuserDemande(string $demandeId, string $userId): bool {
        $demande = $this->repository->getById($demandeId);
        if (!$demande || $demande['statut'] !== 'en_attente') {
            return false;
        }

        return $this->repository->updateStatut($demandeId, 'refusee', $userId);
    }
}
?>