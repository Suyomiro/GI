<?php
class StatsModel {
    private int $effectifTotal;
    private int $nombreGarcons;
    private int $nombreFilles;
    private int $inscriptionsSuspendues;
    private int $inscriptionsAnnulees;
    private array $effectifParClasse;
    private array $repartitionSexeParClasse;

    public function __construct(
        int $effectifTotal = 0,
        int $nombreGarcons = 0,
        int $nombreFilles = 0,
        int $inscriptionsSuspendues = 0,
        int $inscriptionsAnnulees = 0,
        array $effectifParClasse = [],
        array $repartitionSexeParClasse = []
    ) {
        $this->effectifTotal = $effectifTotal;
        $this->nombreGarcons = $nombreGarcons;
        $this->nombreFilles = $nombreFilles;
        $this->inscriptionsSuspendues = $inscriptionsSuspendues;
        $this->inscriptionsAnnulees = $inscriptionsAnnulees;
        $this->effectifParClasse = $effectifParClasse;
        $this->repartitionSexeParClasse = $repartitionSexeParClasse;
    }

    // Getters
    public function getEffectifTotal(): int { return $this->effectifTotal; }
    public function getNombreGarcons(): int { return $this->nombreGarcons; }
    public function getNombreFilles(): int { return $this->nombreFilles; }
    public function getInscriptionsSuspendues(): int { return $this->inscriptionsSuspendues; }
    public function getInscriptionsAnnulees(): int { return $this->inscriptionsAnnulees; }
    public function getEffectifParClasse(): array { return $this->effectifParClasse; }
    public function getRepartitionSexeParClasse(): array { return $this->repartitionSexeParClasse; }

    public function toArray(): array {
        return [
            'effectifTotal' => $this->effectifTotal,
            'nombreGarcons' => $this->nombreGarcons,
            'nombreFilles' => $this->nombreFilles,
            'inscriptionsSuspendues' => $this->inscriptionsSuspendues,
            'inscriptionsAnnulees' => $this->inscriptionsAnnulees,
            'effectifParClasse' => $this->effectifParClasse,
            'repartitionSexeParClasse' => $this->repartitionSexeParClasse
        ];
    }
}
?>