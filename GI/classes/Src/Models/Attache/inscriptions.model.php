<?php
class InscriptionModel {
    private string $id;
    private string $etudiantId;
    private string $classeId;
    private string $anneeScolaire;
    private string $dateInscription;
    private string $statut;
    private string $created_at;

    public function __construct(
        string $id,
        string $etudiantId,
        string $classeId,
        string $anneeScolaire,
        string $dateInscription,
        string $statut,
        string $created_at = ''
    ) {
        $this->id = $id;
        $this->etudiantId = $etudiantId;
        $this->classeId = $classeId;
        $this->anneeScolaire = $anneeScolaire;
        $this->dateInscription = $dateInscription;
        $this->statut = $statut;
        $this->created_at = $created_at;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getEtudiantId(): string { return $this->etudiantId; }
    public function getClasseId(): string { return $this->classeId; }
    public function getAnneeScolaire(): string { return $this->anneeScolaire; }
    public function getDateInscription(): string { return $this->dateInscription; }
    public function getStatut(): string { return $this->statut; }
    public function getCreatedAt(): string { return $this->created_at; }

    // Setters
    public function setStatut(string $statut): void { $this->statut = $statut; }
}
?>