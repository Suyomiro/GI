<?php
require_once __DIR__ . '/../../Repositories/Attache/demande-atta.repository.php';

class DemandeAttaService {
    private DemandeAttaRepository $repository;

    public function __construct(DemandeAttaRepository $repository) {
        $this->repository = $repository;
    }

    public function getDemandesByMatricule(string $matricule): array {
        if (empty($matricule)) {
            return [];
        }
        
        return $this->repository->getDemandesByMatricule($matricule);
    }
}
?>