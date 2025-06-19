<?php
require_once __DIR__ . '/../../Models/RP/stats.model.php';
require_once __DIR__ . '/../../Repositories/RP/stats.repository.php';

class StatsService {
    private StatsRepository $repository;

    public function __construct(StatsRepository $repository) {
        $this->repository = $repository;
    }

    public function getStatistiques(string $annee): StatsModel {
        $effectifTotal = $this->repository->getEffectifTotal($annee);
        $repartitionSexe = $this->repository->getRepartitionSexe($annee);
        $inscriptionsSuspendues = $this->repository->getInscriptionsSuspenduesTotales($annee);
        $inscriptionsAnnulees = $this->repository->getInscriptionsAnnuleesTotales($annee);
        $effectifParClasse = $this->repository->getEffectifParClasse($annee);
        $repartitionSexeParClasse = $this->repository->getRepartitionSexeParClasse($annee);

        return new StatsModel(
            $effectifTotal,
            $repartitionSexe['M'],
            $repartitionSexe['F'],
            $inscriptionsSuspendues,
            $inscriptionsAnnulees,
            $effectifParClasse,
            $repartitionSexeParClasse
        );
    }

    public function getAnneesDisponibles(): array {
        return $this->repository->getAnneesDisponibles();
    }
}
?>