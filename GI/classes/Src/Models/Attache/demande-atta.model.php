<?php
class DemandeAttaModel {
    private string $id;
    private string $etudiantId;
    private string $inscriptionId;
    private string $typeDemande;
    private string $motif;
    private string $dateDemande;
    private string $statut;
    private ?string $traitePar;
    private ?string $dateTraitement;

    public function __construct(
        string $id,
        string $etudiantId,
        string $inscriptionId,
        string $typeDemande,
        string $motif,
        string $dateDemande,
        string $statut,
        ?string $traitePar = null,
        ?string $dateTraitement = null
    ) {
        $this->id = $id;
        $this->etudiantId = $etudiantId;
        $this->inscriptionId = $inscriptionId;
        $this->typeDemande = $typeDemande;
        $this->motif = $motif;
        $this->dateDemande = $dateDemande;
        $this->statut = $statut;
        $this->traitePar = $traitePar;
        $this->dateTraitement = $dateTraitement;
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getEtudiantId(): string { return $this->etudiantId; }
    public function getInscriptionId(): string { return $this->inscriptionId; }
    public function getTypeDemande(): string { return $this->typeDemande; }
    public function getMotif(): string { return $this->motif; }
    public function getDateDemande(): string { return $this->dateDemande; }
    public function getStatut(): string { return $this->statut; }
    public function getTraitePar(): ?string { return $this->traitePar; }
    public function getDateTraitement(): ?string { return $this->dateTraitement; }
}
?>